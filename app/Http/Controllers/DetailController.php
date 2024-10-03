<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $products = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();

        return view('pages.details', [
            'products' => $products
        ]);
    }

    public function add(Request $request, $id)
    {
        // Validasi request
        $product = Product::findOrFail($id);

        $data = [
            'products_id' => $product->id,
            'users_id' => Auth::id()
        ];

        // Tambahkan produk ke keranjang belanja
        Cart::create($data);

        // Redirect ke halaman keranjang belanja
        return redirect()->route('cart');
}
}