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

        // Today's profit: sum of (price_at_sale - cost_price) * quantity for each item
        $todayProfit = DB::table('transaction_items')
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->join('products', 'transaction_items.product_id', '=', 'products.id')
            ->where('transactions.shop_id', $shop->id)
            ->where('transactions.created_at', '>=', Carbon::today())
            ->select(DB::raw('SUM((transaction_items.price_at_sale - products.cost_price) * transaction_items.quantity) as total_profit'))
            ->value('total_profit') ?? 0;
            
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

        $dailyRevenue = collect(range(6, 0))->map(function ($offset) use ($revenueTrend) {
            $date = Carbon::today()->subDays($offset)->format('Y-m-d');

            return [
                'label' => Carbon::parse($date)->translatedFormat('D'),
                'total' => (int) ($revenueTrend[$date] ?? 0),
            ];
        });

        $predictionTomorrow = (int) round($dailyRevenue->avg('total') ?? 0);
        $healthScore = min(100, max(0, 100 - ($criticalStockCount * 8) + min($todayTransactions * 2, 20)));
        $insights = collect();

        if ($bestSellers->isNotEmpty()) {
            $top = $bestSellers->first();
            $insights->push("Produk terlaris saat ini adalah {$top->name} dengan {$top->total_sold} unit terjual.");
        }

        if ($criticalProducts->isNotEmpty()) {
            $critical = $criticalProducts->first();
            $insights->push("Stok {$critical->name} tinggal {$critical->stock} unit dan perlu diprioritaskan.");
        }

        if ($todayTransactions > 0) {
            $insights->push("Hari ini tercatat {$todayTransactions} transaksi dengan omzet Rp " . number_format($todayOmzet, 0, ',', '.') . '.');
        }

        return view('owner.dashboard', compact(
            'todayOmzet',
            'todayProfit',
            'todayTransactions', 
            'criticalStockCount', 
            'bestSellers', 
            'criticalProducts',
            'revenueTrend',
            'dailyRevenue',
            'predictionTomorrow',
            'healthScore',
            'insights'
        ));
    }
}
