@extends('owner.layouts.app')

@section('title', 'Penjualan - TokoQ')

@section('styles')
<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes barGrow {
    from { height: 0; }
}
.animate-fade-in { animation: fadeInUp 0.5s ease-out forwards; }
.animate-fade-in-delay-1 { animation: fadeInUp 0.5s ease-out 0.1s forwards; opacity: 0; }
.animate-fade-in-delay-2 { animation: fadeInUp 0.5s ease-out 0.2s forwards; opacity: 0; }
.animate-fade-in-delay-3 { animation: fadeInUp 0.5s ease-out 0.3s forwards; opacity: 0; }
.animate-bar-grow { animation: barGrow 0.8s ease-out forwards; }

.gradient-success { background: linear-gradient(135deg, #10B981 0%, #34D399 100%); }
.gradient-info { background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%); }
.gradient-warning { background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%); }
.gradient-purple { background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 100%); }

.card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.card-hover:hover { transform: translateY(-3px); box-shadow: 0 15px 30px -8px rgba(16, 185, 129, 0.12); }

.bar-item { transition: all 0.3s ease; }
.bar-item:hover { transform: scaleY(1.05); transform-origin: bottom; }
.chart-tooltip { opacity: 0; transition: opacity 0.2s; pointer-events: none; }
.bar-item:hover .chart-tooltip { opacity: 1; }

.scrollbar-thin::-webkit-scrollbar { width: 4px; }
.scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
.scrollbar-thin::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 10px; }
</style>
@endsection

@section('content')
@php
    $totalTransactions = $transactions->count();
    $totalOmzet = $transactions->sum('total_amount');
    $avgTransaction = $totalTransactions > 0 ? $totalOmzet / $totalTransactions : 0;
    $todayCount = $transactions->where('created_at', '>=', today())->count();
    $todayOmzet = $transactions->where('created_at', '>=', today())->sum('total_amount');
    $yesterdayCount = $transactions->where('created_at', '>=', today()->subDay()->startOfDay())->where('created_at', '<', today())->count();
    $growthPercent = $yesterdayCount > 0 ? round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100) : ($todayCount > 0 ? 100 : 0);
@endphp

<div class="p-4 lg:p-6 space-y-5">

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <!-- Total Transaksi -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover animate-fade-in">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-info rounded-xl flex items-center justify-center shadow-lg shadow-info/20">
                    <span class="material-symbols-outlined text-white text-[20px]">receipt_long</span>
                </div>
                @if($growthPercent != 0)
                    <span class="flex items-center gap-0.5 text-xs font-bold {{ $growthPercent > 0 ? 'text-emerald-500' : 'text-red-500' }}">
                        <span class="material-symbols-outlined text-[14px]">{{ $growthPercent > 0 ? 'trending_up' : 'trending_down' }}</span>
                        {{ abs($growthPercent) }}%
                    </span>
                @endif
            </div>
            <p class="text-2xl font-extrabold text-on-surface">{{ $totalTransactions }}</p>
            <p class="text-xs text-gray-400 mt-1">Total Transaksi</p>
            <p class="text-xs text-emerald-500 font-medium mt-2">{{ $todayCount }} transaksi hari ini</p>
        </div>

        <!-- Total Omzet -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover animate-fade-in-delay-1">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-success rounded-xl flex items-center justify-center shadow-lg shadow-success/20">
                    <span class="material-symbols-outlined text-white text-[20px]">payments</span>
                </div>
                <span class="text-xs text-gray-400">Keseluruhan</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Total Omzet</p>
            <p class="text-xs text-emerald-500 font-medium mt-2">Rp {{ number_format($todayOmzet, 0, ',', '.') }} hari ini</p>
        </div>

        <!-- Rata-rata -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover animate-fade-in-delay-2">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple/20">
                    <span class="material-symbols-outlined text-white text-[20px]">analytics</span>
                </div>
                <span class="text-xs text-gray-400">Per transaksi</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">Rp {{ number_format($avgTransaction, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Rata-rata Transaksi</p>
            <p class="text-xs text-purple-500 font-medium mt-2">{{ $totalTransactions }} transaksi tercatat</p>
        </div>

        <!-- Hari Ini -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover animate-fade-in-delay-3">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-warning rounded-xl flex items-center justify-center shadow-lg shadow-warning/20">
                    <span class="material-symbols-outlined text-white text-[20px]">today</span>
                </div>
                <span class="text-xs text-gray-400">{{ now()->locale('id')->format('l') }}</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">{{ $todayCount }}</p>
            <p class="text-xs text-gray-400 mt-1">Transaksi Hari Ini</p>
            <p class="text-xs text-amber-500 font-medium mt-2">Rp {{ number_format($todayOmzet, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Chart & Payment Method Row -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Sales Chart -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-2xl border border-outline-variant p-6 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-on-surface">Tren Penjualan</h3>
                        <p class="text-xs text-gray-400">7 hari terakhir</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-primary"></span>
                        <span class="text-xs text-gray-400">Jumlah Transaksi</span>
                    </div>
                </div>
                @php
                    $days = collect(range(6, 0))->map(fn($i) => now()->subDays($i));
                    $maxVal = 1;
                @endphp
                <div class="h-52 flex items-end gap-3">
                    @foreach($days as $day)
                        @php
                            $count = $transactions->where('created_at', '>=', $day->startOfDay()->copy())->where('created_at', '<=', $day->endOfDay()->copy())->count();
                            $height = $maxVal > 0 ? max(8, ($count / max($maxVal, 1)) * 100) : 8;
                            $isToday = $day->isToday();
                        @endphp
                        <div class="flex-1 flex flex-col items-center gap-2 bar-item relative group cursor-pointer">
                            <div class="chart-tooltip absolute -top-10 left-1/2 -translate-x-1/2 bg-text-dark text-white text-xs px-2.5 py-1 rounded-lg whitespace-nowrap z-10">
                                {{ $count }} transaksi
                            </div>
                            <div class="w-full rounded-t-lg animate-bar-grow {{ $isToday ? 'bg-gradient-to-t from-primary to-emerald-400' : 'bg-gradient-to-t from-emerald-100 to-emerald-50 group-hover:from-emerald-200 group-hover:to-emerald-100' }}"
                                style="height: {{ $height }}%">
                            </div>
                            <span class="text-[10px] {{ $isToday ? 'text-primary font-bold' : 'text-gray-400' }}">{{ $day->format('D') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Payment Method Breakdown -->
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white rounded-2xl border border-outline-variant p-6 h-full">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-500 text-[20px]">account_balance_wallet</span>
                    </div>
                    <h3 class="font-bold text-on-surface">Metode Pembayaran</h3>
                </div>

                @php
                    $paymentMethods = $transactions->groupBy('payment_method')->map(function($group) {
                        return [
                            'method' => $group->first()->payment_method ?? 'Tunai',
                            'count' => $group->count(),
                            'total' => $group->sum('total_amount'),
                        ];
                    })->values();
                @endphp

                @if($paymentMethods->isEmpty())
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-3xl text-gray-200 block mb-2">payments</span>
                        <p class="text-sm text-gray-400">Belum ada data pembayaran</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($paymentMethods as $payment)
                            @php
                                $icon = match(strtolower($payment['method'])) {
                                    'tunai' => 'payments',
                                    'qris' => 'qr_code',
                                    'e-wallet', 'ewallet' => 'account_balance_wallet',
                                    'dana' => 'account_balance_wallet',
                                    'gopay' => 'account_balance_wallet',
                                    'ovo' => 'account_balance_wallet',
                                    default => 'credit_card',
                                };
                                $color = match(strtolower($payment['method'])) {
                                    'tunai' => 'bg-emerald-100 text-emerald-500',
                                    'qris' => 'bg-blue-100 text-blue-500',
                                    'e-wallet', 'ewallet' => 'bg-purple-100 text-purple-500',
                                    'dana' => 'bg-blue-100 text-blue-500',
                                    'gopay' => 'bg-green-100 text-green-500',
                                    'ovo' => 'bg-purple-100 text-purple-500',
                                    default => 'bg-gray-100 text-gray-500',
                                };
                                $percent = $totalOmzet > 0 ? round(($payment['total'] / $totalOmzet) * 100) : 0;
                            @endphp
                            <div class="p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg flex items-center justify-center {{ $color }}">
                                            <span class="material-symbols-outlined text-[16px]">{{ $icon }}</span>
                                        </div>
                                        <span class="font-bold text-sm text-on-surface">{{ ucfirst($payment['method']) }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $payment['count'] }}×</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden mr-3">
                                        <div class="h-full bg-primary rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-primary">Rp {{ number_format($payment['total'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden">
        <div class="p-5 border-b border-outline-variant flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-500 text-[20px]">receipt</span>
                </div>
                <div>
                    <h3 class="font-bold text-on-surface">Riwayat Transaksi</h3>
                    <p class="text-xs text-gray-400">{{ $totalTransactions }} transaksi tercatat</p>
                </div>
            </div>
            <a href="{{ route('pos.index') }}" class="px-4 py-2 bg-primary text-white rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-primary-dark transition-colors self-start sm:self-auto">
                <span class="material-symbols-outlined text-[16px]">add</span>
                Transaksi Baru
            </a>
        </div>

        @if($transactions->isEmpty())
            <div class="p-12 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-4xl text-gray-200">receipt_long</span>
                </div>
                <h4 class="font-bold text-on-surface mb-1">Belum Ada Transaksi</h4>
                <p class="text-sm text-gray-400 mb-4">Mulai berjualan dari Kasir POS untuk melihat riwayat transaksi di sini.</p>
                <a href="{{ route('pos.index') }}" class="inline-flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-bold text-sm">
                    <span class="material-symbols-outlined text-[18px]">point_of_sale</span>
                    Buka Kasir POS
                </a>
            </div>
        @else
            <div class="overflow-x-auto scrollbar-thin">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                        <tr>
                            <th class="px-5 py-3">Waktu</th>
                            <th class="px-5 py-3">Total</th>
                            <th class="px-5 py-3">Metode</th>
                            <th class="px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transactions as $tx)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3">
                                <p class="font-medium text-sm text-on-surface">{{ $tx->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-400">{{ $tx->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-5 py-3 font-bold text-primary">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $pmIcon = match(strtolower($tx->payment_method ?? 'tunai')) {
                                        'tunai' => 'payments',
                                        'qris' => 'qr_code',
                                        default => 'account_balance_wallet',
                                    };
                                    $pmColor = match(strtolower($tx->payment_method ?? 'tunai')) {
                                        'tunai' => 'bg-emerald-100 text-emerald-600',
                                        'qris' => 'bg-blue-100 text-blue-600',
                                        default => 'bg-purple-100 text-purple-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold {{ $pmColor }}">
                                    <span class="material-symbols-outlined text-[14px]">{{ $pmIcon }}</span>
                                    {{ ucfirst($tx->payment_method ?? 'Tunai') }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Selesai
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="pb-4 flex flex-col sm:flex-row justify-between items-center gap-2 opacity-40">
        <p class="text-xs">&copy; 2025 TokoQ. All rights reserved.</p>
        <div class="flex gap-4 text-xs">
            <a class="hover:text-primary underline" href="#">Syarat & Ketentuan</a>
            <a class="hover:text-primary underline" href="#">Kebijakan Privasi</a>
        </div>
    </footer>
</div>
@endsection
