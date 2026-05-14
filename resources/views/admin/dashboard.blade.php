@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
@php
    $totalProducts = \App\Models\Product::count();
    $totalTransactions = \App\Models\Transaction::count();
    $totalRevenue = \App\Models\Transaction::sum('total_amount');
@endphp

<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-primary via-emerald-500 to-teal-500 rounded-2xl p-6 mb-6 text-white relative overflow-hidden">
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-0 left-1/3 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>
    <div class="relative z-10">
        <p class="text-white/70 text-sm mb-1">Selamat datang kembali,</p>
        <h1 class="text-2xl font-extrabold mb-2">{{ auth()->user()->name }} 👋</h1>
        <p class="text-white/80 text-sm">Kelola validasi UMKM dan pantau performa platform TokoQ.</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
    <!-- Pending -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-amber-500 text-[22px]">pending_actions</span>
            </div>
            @if($pendingCount > 0)
                <span class="w-2.5 h-2.5 bg-red-500 rounded-full pulse-dot"></span>
            @endif
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ $pendingCount }}</p>
        <p class="text-xs text-gray-400 mt-0.5">Menunggu Validasi</p>
    </div>

    <!-- Active Shops -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-emerald-500 text-[22px]">store</span>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ $activeCount }}</p>
        <p class="text-xs text-gray-400 mt-0.5">Toko Aktif</p>
    </div>

    <!-- Total Shops -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-500 text-[22px]">domain</span>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ $totalShops }}</p>
        <p class="text-xs text-gray-400 mt-0.5">Total Toko</p>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-purple-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-purple-500 text-[22px]">account_balance_wallet</span>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p class="text-xs text-gray-400 mt-0.5">Total Omzet Platform</p>
    </div>
</div>

<!-- Quick Actions + Recent -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <!-- Recent Pending Shops -->
    <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-amber-50 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-amber-500 text-[18px]">hourglass_top</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Pendaftaran Terbaru</h3>
                    <p class="text-xs text-gray-400">UMKM menunggu validasi</p>
                </div>
            </div>
            <a href="{{ route('admin.validate') }}" class="text-xs text-primary font-bold hover:underline">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-5 py-3">Owner</th>
                        <th class="px-5 py-3">Toko</th>
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentShops as $user)
                    <tr>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-primary/20 to-emerald-100 rounded-lg flex items-center justify-center text-primary font-bold text-xs">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-800">{{ $user->name }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-600">{{ $user->shop->name ?? '-' }}</td>
                        <td class="px-5 py-3 text-xs text-gray-400">{{ $user->created_at->locale('id')->diffForHumans() }}</td>
                        <td class="px-5 py-3 text-right">
                            <form method="POST" action="{{ route('admin.activate', $user->id) }}">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-bold hover:bg-primary-dark transition-colors">
                                    Aktifkan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center">
                            <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="material-symbols-outlined text-emerald-400 text-[24px]">check_circle</span>
                            </div>
                            <p class="text-sm text-gray-400">Tidak ada pendaftaran tertunda</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="space-y-4">
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[18px]">bolt</span>
                Aksi Cepat
            </h3>
            <div class="space-y-2">
                <a href="{{ route('admin.validate') }}" class="flex items-center gap-3 p-3 rounded-xl bg-amber-50 hover:bg-amber-100 transition-colors group">
                    <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center group-hover:bg-amber-200 transition-colors">
                        <span class="material-symbols-outlined text-amber-500 text-[18px]">how_to_reg</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-sm text-gray-800">Validasi UMKM</p>
                        <p class="text-[10px] text-gray-400">{{ $pendingCount }} menunggu</p>
                    </div>
                    <span class="material-symbols-outlined text-gray-300 group-hover:text-amber-500 transition-colors">arrow_forward</span>
                </a>
                <a href="{{ route('admin.shops') }}" class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors group">
                    <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                        <span class="material-symbols-outlined text-blue-500 text-[18px]">store</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-sm text-gray-800">Semua Toko</p>
                        <p class="text-[10px] text-gray-400">{{ $totalShops }} toko terdaftar</p>
                    </div>
                    <span class="material-symbols-outlined text-gray-300 group-hover:text-blue-500 transition-colors">arrow_forward</span>
                </a>
                <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 p-3 rounded-xl bg-purple-50 hover:bg-purple-100 transition-colors group">
                    <div class="w-9 h-9 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                        <span class="material-symbols-outlined text-purple-500 text-[18px]">bar_chart</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-sm text-gray-800">Laporan</p>
                        <p class="text-[10px] text-gray-400">Analisis platform</p>
                    </div>
                    <span class="material-symbols-outlined text-gray-300 group-hover:text-purple-500 transition-colors">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- Platform Stats -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[18px]">insights</span>
                Statistik Platform
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Total Produk</span>
                    <span class="font-bold text-sm text-gray-800">{{ number_format($totalProducts) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Total Transaksi</span>
                    <span class="font-bold text-sm text-gray-800">{{ number_format($totalTransactions) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Toko Aktif</span>
                    <span class="font-bold text-sm text-emerald-500">{{ $activeCount }} / {{ $totalShops }}</span>
                </div>
                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-primary to-emerald-400 rounded-full" style="width: {{ $totalShops > 0 ? ($activeCount / $totalShops) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
