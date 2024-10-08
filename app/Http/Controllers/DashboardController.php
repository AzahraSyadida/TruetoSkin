<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                            ->whereHas('product', function ($query) {
                                $query->where('users_id', Auth::user()->id);
                            })
                            ->get();

        $revenue = $transactions->sum('price');

        $customerCount = User::count();

        return view('pages.dashboard', [
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions,
            'revenue' => $revenue,
            'customer' => $customerCount,
        ]);
    }
}
