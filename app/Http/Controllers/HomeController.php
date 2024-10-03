<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Models\Category; 
use App\Models\Product; 
 
class HomeController extends Controller 
{ 
    /** 
     * Show the application dashboard. 
     * 
     * @return \Illuminate\Contracts\Support\Renderable 
     */ 
    public function index() 
    { 
        // Ambil 6 kategori terbaru 
        $categories = Category::latest()->take(6)->get(); 
         
        // Ambil 8 produk terbaru dengan galeri 
        $products = Product::with('galleries')->latest()->take(8)->get(); 
 
        return view('pages.home', [ 
            'categories' => $categories, 
            'products' => $products 
        ]); 
    } 
}