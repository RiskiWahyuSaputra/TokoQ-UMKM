@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-primary via-emerald-500 to-teal-500 rounded-2xl p-4 sm:p-6 mb-6 text-white relative overflow-hidden">
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-0 left-1/3 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>
    <div class="relative z-10">
        <p class="text-white/70 text-sm mb-1">Selamat datang kembali,</p>
        <h1 class="text-2xl font-extrabold mb-2">{{ auth()->user()->name }} 👋</h1>
        <p class="text-white/80 text-sm">Kelola validasi UMKM dan pantau performa platform TokoQ.</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
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

    <!-- Suspended -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-red-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-red-500 text-[22px]">block</span>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-gray-800">{{ $suspendedCount }}</p>
        <p class="text-xs text-gray-400 mt-0.5">Toko Nonaktif</p>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 card-hover">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-purple-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-purple-500 text-[22px]">account_balance_wallet</span>
            </div>
            @if($revTrend != 0)
                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded {{ $revTrend > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }}">
                    {{ $revTrend > 0 ? '↑' : '↓' }} {{ abs($revTrend) }}%
                </span>
            @endif
        </div>
        <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p class="text-xs text-gray-400 mt-0.5">Total Omzet</p>
    </div>
</div>

<!-- Charts + Recent -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
    <!-- Transaction Chart -->
    <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-500 text-[18px]">bar_chart</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Transaksi 7 Hari Terakhir</h3>
                    <p class="text-xs text-gray-400">
                        @if($txTrend != 0)
                            <span class="{{ $txTrend > 0 ? 'text-emerald-500' : 'text-red-500' }} font-bold">
                                {{ $txTrend > 0 ? '↑' : '↓' }} {{ abs($txTrend) }}%
                            </span>
                        @else
                            <span class="text-gray-400">0%</span>
                        @endif
                        vs minggu sebelumnya
                    </p>
                </div>
            </div>
        </div>
        @php
            $maxCount = collect($dailyTx)->max('count') ?: 1;
        @endphp
        <div class="flex items-end gap-2 h-40">
            @foreach($dailyTx as $d)
                <div class="flex-1 flex flex-col items-center gap-1">
                    <span class="text-[10px] text-gray-500 font-bold">{{ $d['count'] }}</span>
                    <div class="w-full bg-gradient-to-t from-primary to-emerald-400 rounded-t-lg transition-all" style="height: {{ max(8, ($d['count'] / $maxCount) * 100) }}%"></div>
                    <span class="text-[10px] text-gray-400">{{ $d['day'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Actions -->
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
</div>

<!-- Recent Pending Shops + Audit Activity -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    <!-- Recent Pending Shops -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
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
                        <th class="px-5 py-3 hidden sm:table-cell">Toko</th>
                        <th class="px-5 py-3 hidden md:table-cell">Tanggal</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentShops as $user)
                    <tr>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-primary/20 to-emerald-100 rounded-lg flex items-center justify-center text-primary font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-sm text-gray-800 truncate">{{ $user->name }}</p>
                                    <p class="text-[10px] text-gray-400 truncate">{{ $user->email }}</p>
                                    <p class="text-[10px] text-gray-400 sm:hidden">{{ $user->shop->name ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-600 hidden sm:table-cell">{{ $user->shop->name ?? '-' }}</td>
                        <td class="px-5 py-3 text-xs text-gray-400 hidden md:table-cell">{{ $user->created_at->locale('id')->diffForHumans() }}</td>
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

    <!-- Recent Audit Activity -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-500 text-[18px]">manage_history</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Aktivitas Admin</h3>
                    <p class="text-xs text-gray-400">Log audit terbaru</p>
                </div>
            </div>
            <a href="{{ route('admin.audit-logs') }}" class="text-xs text-primary font-bold hover:underline">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentAudit as $log)
            <div class="px-5 py-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-primary to-emerald-400 rounded-lg flex items-center justify-center text-white font-bold text-[10px] shrink-0">
                        {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-800 truncate">{{ $log->description ?? $log->action }}</p>
                        <p class="text-[10px] text-gray-400">{{ $log->user->name ?? 'System' }} · {{ $log->created_at->locale('id')->diffForHumans() }}</p>
                    </div>
                    @php
                        $actionColors = [
                            'activate' => 'bg-emerald-50 text-emerald-600',
                            'suspend' => 'bg-red-50 text-red-600',
                            'create' => 'bg-blue-50 text-blue-600',
                            'update' => 'bg-amber-50 text-amber-600',
                            'delete' => 'bg-red-50 text-red-600',
                        ];
                        $ac = $actionColors[$log->action] ?? 'bg-gray-50 text-gray-600';
                    @endphp
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $ac }}">{{ ucfirst($log->action) }}</span>
                </div>
            </div>
            @empty
            <div class="px-5 py-8 text-center">
                <span class="material-symbols-outlined text-3xl text-gray-200 block mb-2">history</span>
                <p class="text-sm text-gray-400">Belum ada aktivitas admin.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Platform Stats -->
<div class="mt-6 bg-white rounded-2xl border border-gray-100 p-5">
    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
        <span class="material-symbols-outlined text-primary text-[18px]">insights</span>
        Statistik Platform
    </h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="text-center p-3 bg-gray-50 rounded-xl">
            <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalProducts) }}</p>
            <p class="text-xs text-gray-400">Total Produk</p>
        </div>
        <div class="text-center p-3 bg-gray-50 rounded-xl">
            <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalTransactions) }}</p>
            <p class="text-xs text-gray-400">Total Transaksi</p>
        </div>
        <div class="text-center p-3 bg-gray-50 rounded-xl">
            <p class="text-2xl font-extrabold text-emerald-500">{{ $activeCount }}</p>
            <p class="text-xs text-gray-400">Toko Aktif</p>
        </div>
        <div class="text-center p-3 bg-gray-50 rounded-xl">
            <p class="text-2xl font-extrabold text-gray-800">{{ $totalShops > 0 ? round(($activeCount / $totalShops) * 100) : 0 }}%</p>
            <p class="text-xs text-gray-400">Rate Aktif</p>
        </div>
    </div>
    <div class="mt-3 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
        <div class="h-full bg-gradient-to-r from-primary to-emerald-400 rounded-full transition-all" style="width: {{ $totalShops > 0 ? ($activeCount / $totalShops) * 100 : 0 }}%"></div>
    </div>
</div>
@endsection
