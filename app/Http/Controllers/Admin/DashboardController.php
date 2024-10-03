<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User menggunakan namespace yang benar
use App\Models\Transaction; // Pastikan model Transaction menggunakan namespace yang benar

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data pelanggan, pendapatan, dan transaksi
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Menghitung jumlah pelanggan
        $customer = User::count();
        
        // Menjumlahkan total pendapatan dari semua transaksi
        $revenue = Transaction::sum('total_price');
        
        // Menghitung jumlah transaksi
        $transaction = Transaction::count();

        // Mengirim data ke view pages.admin.dashboard
        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction' => $transaction
        ]); // <-- Added missing semicolon
    }
}
