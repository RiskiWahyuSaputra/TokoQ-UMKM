<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $shop = Auth::user()->shop;
        $transactions = $shop
            ? Transaction::where('shop_id', $shop->id)->latest()->take(20)->get()
            : collect();

        return view('owner.sales.index', compact('transactions'));
    }
}
