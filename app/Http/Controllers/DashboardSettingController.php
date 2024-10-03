<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\Category; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
 
class DashboardSettingController extends Controller 
{ 
    public function store() 
    { 
        $user = Auth::user(); 
        $categories = Category::all(); 
 
        return view('pages.dashboard-settings', [ 
            'user' => $user, 
            'categories' => $categories 
        ]); 
    } 
 
    public function account() 
    { 
        $user = Auth::user(); 
 
        return view('pages.dashboard-account', [ 
            'user' => $user 
        ]); 
    } 
 
    public function update(Request $request, $redirect) 
    { 
        $data = $request->validate([ 
            'name' => 'required|string|max:255', 
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id, 
            'password' => 'nullable|string|min:8|confirmed', 
        ]); 
 
        $user = Auth::user(); 
        $user->update($data); 
        return redirect()->route($redirect); 
    } 
}