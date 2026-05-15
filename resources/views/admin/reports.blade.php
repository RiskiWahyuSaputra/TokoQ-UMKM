@extends('admin.layout')

@section('title', 'Laporan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-gray-800">Laporan Platform</h1>
    <p class="text-sm text-gray-400 mt-1">Analisis menyeluruh performa platform TokoQ</p>
</div>

<!-- Overview Stats -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
            <span class="material-symbols-outlined text-blue-500 text-[20px]">domain</span>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalShops) }}</p>
        <p class="text-xs text-gray-400">Total Toko</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center mb-3">
            <span class="material-symbols-outlined text-emerald-500 text-[20px]">check_circle</span>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ number_format($activeShops) }}</p>
        <p class="text-xs text-gray-400">Toko Aktif</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center mb-3">
            <span class="material-symbols-outlined text-purple-500 text-[20px]">receipt_long</span>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalTransactions) }}</p>
        <p class="text-xs text-gray-400">Total Transaksi</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center mb-3">
            <span class="material-symbols-outlined text-amber-500 text-[20px]">account_balance_wallet</span>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p class="text-xs text-gray-400">Total Omzet</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="w-10 h-10 bg-teal-50 rounded-xl flex items-center justify-center mb-3">
            <span class="material-symbols-outlined text-teal-500 text-[20px]">inventory_2</span>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalProducts) }}</p>
        <p class="text-xs text-gray-400">Total Produk</p>
    </div>
</div>

<!-- Charts placeholder -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[18px]">trending_up</span>
            Aktivitas Platform
        </h3>
        <div class="h-48 flex items-end gap-2">
            @php
                $days = collect(range(6, 0))->map(fn($i) => now()->subDays($i));
                $maxTx = 1;
            @endphp
            @foreach($days as $day)
                @php
                    $count = rand(5, 50);
                    $height = max(10, ($count / 50) * 100);
                @endphp
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full bg-gradient-to-t from-primary to-emerald-400 rounded-t-lg transition-all" style="height: {{ $height }}%"></div>
                    <span class="text-[9px] text-gray-400">{{ $day->format('D') }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[18px]">pie_chart</span>
            Distribusi Status Toko
        </h3>
        <div class="flex items-center justify-center h-48">
            <div class="text-center">
                <div class="w-32 h-32 mx-auto mb-4 relative">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" fill="none" stroke="#E5E7EB" stroke-width="12"/>
                        <circle cx="50" cy="50" r="40" fill="none" stroke="#10B981" stroke-width="12"
                            stroke-dasharray="{{ $totalShops > 0 ? ($activeShops / $totalShops) * 251.2 : 0 }} 251.2"
                            stroke-linecap="round"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-extrabold text-gray-800">{{ $totalShops > 0 ? round(($activeShops / $totalShops) * 100) : 0 }}%</span>
                    </div>
                </div>
                <p class="text-sm text-gray-500">Toko Aktif</p>
            </div>
        </div>
    </div>
</div>
@endsection
