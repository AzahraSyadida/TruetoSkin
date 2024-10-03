<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Validasi dan update data pengguna
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            // tambahkan validasi untuk kolom lain yang perlu divalidasi
        ]);

        // Pastikan user adalah instance dari model User
        if ($user) {
            $user->update($validatedData);
        }

        // Proses checkout
        $code = 'STORE-' . mt_rand(0000,9999);
        $carts = Cart::with(['product','user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();

        $totalPrice = 0;

        foreach ($carts as $cart) {
            $totalPrice += $cart->product->price;
        }

        // Simpan transaksi
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'incurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $totalPrice,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(0000,9999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // Hapus cart setelah checkout
        Cart::where('users_id', Auth::user()->id)->delete();

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat array untuk dikirim ke Midtrans
        $midtransParams = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => [],
        ];

        try {
            // Ambil halaman pembayaran dari Midtrans
            $paymentUrl = Snap::createTransaction($midtransParams)->redirect_url;

            // Redirect ke halaman pembayaran Midtrans
            return redirect($paymentUrl);
        } catch (Exception $e) {
            return back()->withError('Error: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance notifikasi dari Midtrans
        $notification = new Notification();

        // Ambil data dari notifikasi
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan order_id
        $transaction = Transaction::where('code', $order_id)->firstOrFail();

        // Update status transaksi sesuai dengan notifikasi dari Midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'PENDING';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        } elseif ($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        } elseif ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
            $transaction->transaction_status = 'CANCELLED';
        }

        // Simpan perubahan status transaksi
        $transaction->save();

        // Kirimkan response sesuai dengan status transaksi
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success',
            ],
]);
}
}