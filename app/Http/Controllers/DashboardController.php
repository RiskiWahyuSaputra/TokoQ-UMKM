<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $shop = Auth::user()->shop;
        
        // Metrics
        $todayOmzet = Transaction::where('shop_id', $shop->id)
            ->where('created_at', '>=', Carbon::today())
            ->sum('net_amount');
            
        $todayTransactions = Transaction::where('shop_id', $shop->id)
            ->where('created_at', '>=', Carbon::today())
            ->count();
            
        $criticalStockCount = Product::where('shop_id', $shop->id)
            ->where('stock', '<', 5)
            ->count();

        // Best Sellers
        $bestSellers = DB::table('transaction_items')
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->join('products', 'transaction_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(transaction_items.quantity) as total_sold'), DB::raw('SUM(transaction_items.quantity * transaction_items.price_at_sale) as total_revenue'))
            ->where('transactions.shop_id', $shop->id)
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();

        // Critical Stock List
        $criticalProducts = Product::where('shop_id', $shop->id)
            ->where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->get();

        // 7-Day Revenue Trend
        $revenueTrend = Transaction::where('shop_id', $shop->id)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(net_amount) as total'))
            ->groupBy('date')
            ->get()
            ->pluck('total', 'date');

        return view('owner.dashboard', compact(
            'todayOmzet', 
            'todayTransactions', 
            'criticalStockCount', 
            'bestSellers', 
            'criticalProducts',
            'revenueTrend'
        ));
    }
}
