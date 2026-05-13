<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AiController extends Controller
{
    public function index()
    {
        $shop = Auth::user()->shop;
        $transactions = $shop
            ? Transaction::where('shop_id', $shop->id)->latest()->get()
            : collect();

        $recentDays = collect(range(6, 0))->map(function ($offset) use ($transactions) {
            $date = Carbon::today()->subDays($offset);
            $total = $transactions
                ->filter(fn ($transaction) => $transaction->created_at->between(
                    $date->copy()->startOfDay(),
                    $date->copy()->endOfDay()
                ))
                ->sum('net_amount');

            return [
                'label' => $date->translatedFormat('D'),
                'total' => (int) $total,
            ];
        });

        $previousDays = collect(range(13, 7))->map(function ($offset) use ($transactions) {
            $date = Carbon::today()->subDays($offset);

            return (int) $transactions
                ->filter(fn ($transaction) => $transaction->created_at->between(
                    $date->copy()->startOfDay(),
                    $date->copy()->endOfDay()
                ))
                ->sum('net_amount');
        });

        $recentAverage = $recentDays->avg('total') ?? 0;
        $previousAverage = $previousDays->avg() ?? 0;
        $forecast = (int) max(0, round($recentAverage + (($recentAverage - $previousAverage) * 0.5)));
        $trendPercent = $previousAverage > 0
            ? round((($recentAverage - $previousAverage) / $previousAverage) * 100)
            : ($recentAverage > 0 ? 100 : 0);

        $criticalProducts = $shop
            ? Product::where('shop_id', $shop->id)->with('category')->where('stock', '<=', 10)->orderBy('stock')->get()
            : collect();

        $topProducts = $shop
            ? DB::table('transaction_items')
                ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
                ->join('products', 'transaction_items.product_id', '=', 'products.id')
                ->where('transactions.shop_id', $shop->id)
                ->select(
                    'products.name',
                    DB::raw('SUM(transaction_items.quantity) as total_sold'),
                    DB::raw('SUM(transaction_items.quantity * transaction_items.price_at_sale) as revenue')
                )
                ->groupBy('products.id', 'products.name')
                ->orderByDesc('total_sold')
                ->limit(5)
                ->get()
            : collect();

        $shoppingSuggestions = $criticalProducts->take(5)->map(function ($product) {
            $recommended = max(5, 12 - $product->stock);

            return [
                'name' => $product->name,
                'stock' => $product->stock,
                'category' => $product->category?->name ?? 'Tanpa kategori',
                'recommended' => $recommended,
                'estimate' => (int) ($recommended * $product->price),
            ];
        });

        $summary = $criticalProducts->isNotEmpty()
            ? 'Fokus utama saat ini adalah menjaga stok produk kritis agar penjualan tidak terhenti.'
            : 'Stok toko dalam kondisi aman. Gunakan tren penjualan untuk menyiapkan promo atau restock berikutnya.';

        return view('owner.ai.index', compact(
            'recentDays',
            'forecast',
            'trendPercent',
            'criticalProducts',
            'topProducts',
            'shoppingSuggestions',
            'summary'
        ));
    }
}
