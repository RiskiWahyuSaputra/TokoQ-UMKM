<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $shop = Auth::user()->shop;
        $transactions = $shop
            ? Transaction::where('shop_id', $shop->id)->latest()->get()
            : collect();

        $dateRange = collect(range(6, 0))->map(fn ($days) => Carbon::today()->subDays($days));
        $dailyRevenue = $dateRange->map(function (Carbon $date) use ($transactions) {
            $total = $transactions
                ->filter(fn ($transaction) => $transaction->created_at->between(
                    $date->copy()->startOfDay(),
                    $date->copy()->endOfDay()
                ))
                ->sum('net_amount');

            return [
                'label' => $date->translatedFormat('D'),
                'full_date' => $date->translatedFormat('d M'),
                'total' => (int) $total,
            ];
        });

        $paymentSummary = $transactions
            ->groupBy(fn ($transaction) => strtoupper($transaction->payment_method ?? 'TUNAI'))
            ->map(fn ($group, $method) => [
                'method' => $method,
                'count' => $group->count(),
                'total' => (int) $group->sum('net_amount'),
            ])
            ->sortByDesc('total')
            ->values();

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

        return view('owner.reports.index', [
            'transactions' => $transactions,
            'dailyRevenue' => $dailyRevenue,
            'paymentSummary' => $paymentSummary,
            'topProducts' => $topProducts,
        ]);
    }
}
