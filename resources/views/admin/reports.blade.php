@extends('admin.layout')

@section('title', 'Laporan')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Laporan Platform</h1>
        <p class="text-sm text-gray-400 mt-1">Analisis menyeluruh performa platform TokoQ</p>
    </div>
    <div class="flex items-center gap-2">
        <span class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold">
            {{ now()->locale('id')->format('F Y') }}
        </span>
    </div>
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
        <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center mb-3">
            <span class="material-symbols-outlined text-red-500 text-[20px]">block</span>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ number_format($suspendedShops) }}</p>
        <p class="text-xs text-gray-400">Toko Nonaktif</p>
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
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Daily Revenue Chart -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[18px]">trending_up</span>
            Omzet Harian (14 Hari)
        </h3>
        @php
            $maxRev = collect($dailyRevenue)->max('revenue') ?: 1;
        @endphp
        <div class="flex items-end gap-1.5 h-48">
            @foreach($dailyRevenue as $d)
                <div class="flex-1 flex flex-col items-center gap-1">
                    <span class="text-[8px] text-gray-500 font-bold">{{ $d['count'] > 0 ? number_format($d['revenue'] / 1000, 0) . 'k' : '-' }}</span>
                    <div class="w-full bg-gradient-to-t from-primary to-emerald-400 rounded-t transition-all {{ $d['revenue'] > 0 ? '' : 'opacity-20' }}" style="height: {{ max(4, ($d['revenue'] / $maxRev) * 100) }}%"></div>
                    <span class="text-[8px] text-gray-400">{{ $d['date'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Distribusi Status Toko -->
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
                        @if($totalShops > 0)
                            <circle cx="50" cy="50" r="40" fill="none" stroke="#10B981" stroke-width="12"
                                stroke-dasharray="{{ ($activeShops / $totalShops) * 251.2 }} 251.2"
                                stroke-linecap="round"/>
                        @endif
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-extrabold text-gray-800">{{ $totalShops > 0 ? round(($activeShops / $totalShops) * 100) : 0 }}%</span>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-4 text-xs">
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></span> Aktif ({{ $activeShops }})</span>
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-red-500 rounded-full"></span> Nonaktif ({{ $suspendedShops }})</span>
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-gray-300 rounded-full"></span> Lainnya ({{ $totalShops - $activeShops - $suspendedShops }})</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top Shops + Top Products -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Top Shops by Revenue -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[18px]">emoji_events</span>
                Top Toko by Omzet
            </h3>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($topShops as $i => $shop)
            <div class="px-5 py-3 flex items-center gap-3">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold {{ $i === 0 ? 'bg-amber-100 text-amber-600' : ($i === 1 ? 'bg-gray-100 text-gray-600' : ($i === 2 ? 'bg-orange-100 text-orange-600' : 'bg-gray-50 text-gray-400')) }}">
                    {{ $i + 1 }}
                </span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-800 truncate">{{ $shop->name }}</p>
                    <p class="text-[10px] text-gray-400">{{ $shop->owner?->name ?? '-' }}</p>
                </div>
                <span class="text-sm font-bold text-primary">Rp {{ number_format($shop->transactions_sum_total_amount ?? 0, 0, ',', '.') }}</span>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-gray-400">
                <span class="material-symbols-outlined text-3xl text-gray-200 block mb-1">store</span>
                <p class="text-sm">Belum ada data toko.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Top Products -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[18px]">inventory_2</span>
                Produk Terlaris
            </h3>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($topProducts as $i => $product)
            <div class="px-5 py-3 flex items-center gap-3">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold {{ $i === 0 ? 'bg-amber-100 text-amber-600' : ($i === 1 ? 'bg-gray-100 text-gray-600' : ($i === 2 ? 'bg-orange-100 text-orange-600' : 'bg-gray-50 text-gray-400')) }}">
                    {{ $i + 1 }}
                </span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-800 truncate">{{ $product->name }}</p>
                    <p class="text-[10px] text-gray-400">{{ $product->shop?->name ?? '-' }}</p>
                </div>
                <span class="text-sm font-bold text-gray-600">{{ $product->transaction_items_count }}x</span>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-gray-400">
                <span class="material-symbols-outlined text-3xl text-gray-200 block mb-1">inventory_2</span>
                <p class="text-sm">Belum ada data produk.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
