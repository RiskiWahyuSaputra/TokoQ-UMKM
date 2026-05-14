@extends('owner.layouts.app')

@section('title', 'Dashboard - TokoQ')

@section('styles')
<style>
    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse-ring {
        0% { transform: scale(0.9); opacity: 1; }
        80%, 100% { transform: scale(1.3); opacity: 0; }
    }
    @keyframes countUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    @keyframes barGrow {
        from { height: 0; }
    }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
    .animate-fade-in-up-delay-1 { animation: fadeInUp 0.6s ease-out 0.1s forwards; opacity: 0; }
    .animate-fade-in-up-delay-2 { animation: fadeInUp 0.6s ease-out 0.2s forwards; opacity: 0; }
    .animate-fade-in-up-delay-3 { animation: fadeInUp 0.6s ease-out 0.3s forwards; opacity: 0; }
    .animate-fade-in-up-delay-4 { animation: fadeInUp 0.6s ease-out 0.4s forwards; opacity: 0; }
    .animate-bar-grow { animation: barGrow 0.8s ease-out forwards; }

    /* Gradient backgrounds */
    .gradient-success { background: linear-gradient(135deg, #10B981 0%, #34D399 100%); }
    .gradient-warning { background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%); }
    .gradient-danger { background: linear-gradient(135deg, #EF4444 0%, #F87171 100%); }
    .gradient-info { background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%); }
    .gradient-purple { background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 100%); }
    .gradient-mint { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); }
    .gradient-sunset { background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%); }

    /* Card hover effects */
    .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -12px rgba(16, 185, 129, 0.15); }

    /* Progress ring */
    .progress-ring__circle { transition: stroke-dashoffset 1s ease-in-out; transform: rotate(-90deg); transform-origin: 50% 50%; }

    /* Bar chart hover */
    .bar-item { transition: all 0.3s ease; }
    .bar-item:hover { transform: scaleY(1.05); transform-origin: bottom; }

    /* Notification dot */
    .notification-dot { animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }

    /* Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 10px; }

    /* Tooltip */
    .chart-tooltip { opacity: 0; transition: opacity 0.2s; pointer-events: none; }
    .bar-item:hover .chart-tooltip { opacity: 1; }

    /* Streak flame */
    .streak-flame { filter: drop-shadow(0 0 8px rgba(245, 158, 11, 0.4)); }

    /* Quick action ripple */
    .quick-action { position: relative; overflow: hidden; }
    .quick-action::after { content: ''; position: absolute; inset: 0; background: radial-gradient(circle at center, rgba(255,255,255,0.3) 0%, transparent 70%); opacity: 0; transition: opacity 0.3s; }
    .quick-action:active::after { opacity: 1; }
</style>
@endsection

@section('content')
@php
    $user = Auth::user();
    $hour = now()->hour;
    $greeting = $hour < 12 ? 'Selamat Pagi' : ($hour < 17 ? 'Selamat Siang' : ($hour < 21 ? 'Selamat Sore' : 'Selamat Malam'));
    $dayName = now()->locale('id')->dayName;
    $dateFormatted = now()->locale('id')->format('j F Y');
    $maxRevenue = max($dailyRevenue->max('total') ?? 0, 1);
    $healthScore = $healthScore ?? 75;
    $healthColor = $healthScore >= 80 ? '#10B981' : ($healthScore >= 60 ? '#F59E0B' : '#EF4444');
    $healthLabel = $healthScore >= 80 ? 'Sehat' : ($healthScore >= 60 ? 'Stabil' : 'Perlu Perhatian');
    $circumference = 2 * M_PI * 70;
    $strokeOffset = $circumference - ($healthScore / 100) * $circumference;
@endphp

<!-- Welcome Hero Section -->
<div class="p-4 lg:p-8 pb-0">
    <div class="relative bg-gradient-to-br from-primary via-primary-dark to-emerald-700 rounded-3xl p-6 lg:p-8 text-white overflow-hidden animate-fade-in-up">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>
        <div class="absolute top-1/2 right-1/4 w-3 h-3 bg-white/20 rounded-full"></div>
        <div class="absolute top-1/3 right-1/3 w-2 h-2 bg-white/30 rounded-full"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-2xl">
                        @if($hour < 12) 🌅 @elseif($hour < 17) ☀️ @elseif($hour < 21) 🌇 @else 🌙 @endif
                    </span>
                    <span class="text-white/80 text-body-sm font-medium">{{ $dayName }}, {{ $dateFormatted }}</span>
                </div>
                <h1 class="text-2xl lg:text-3xl font-bold mb-2">{{ $greeting }}, {{ explode(' ', $user->name)[0] }}! 👋</h1>
                <p class="text-white/80 text-body-md max-w-lg">
                    @if($criticalStockCount > 0)
                        ⚠️ Ada <strong>{{ $criticalStockCount }}</strong> produk stok kritis yang perlu segera direstock.
                    @elseif($todayTransactions > 0)
                        🎉 Hari ini sudah ada <strong>{{ $todayTransactions }}</strong> transaksi. Terus semangat!
                    @else
                        💡 Belum ada transaksi hari ini. Yuk mulai berjualan!
                    @endif
                </p>
            </div>

            <!-- Quick Stats in Hero -->
            <div class="flex gap-4">
                <div class="bg-white/15 backdrop-blur-sm rounded-2xl px-5 py-4 text-center min-w-[100px]">
                    <p class="text-white/70 text-body-sm mb-1">Omzet Hari Ini</p>
                    <p class="text-xl font-bold">Rp {{ number_format($todayOmzet, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white/15 backdrop-blur-sm rounded-2xl px-5 py-4 text-center min-w-[100px]">
                    <p class="text-white/70 text-body-sm mb-1">Transaksi</p>
                    <p class="text-xl font-bold">{{ $todayTransactions }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="p-4 lg:p-8 space-y-6">

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 animate-fade-in-up-delay-1">
        <a href="{{ route('pos.index') }}" class="quick-action bg-white rounded-2xl p-4 border border-outline-variant card-hover flex items-center gap-3 group">
            <div class="w-11 h-11 gradient-success rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-success/30">
                <span class="material-symbols-outlined text-white">point_of_sale</span>
            </div>
            <div class="min-w-0">
                <p class="font-bold text-on-surface text-sm">Buka Kasir</p>
                <p class="text-body-sm text-on-surface-variant">Transaksi baru</p>
            </div>
        </a>
        <a href="{{ route('products.create') }}" class="quick-action bg-white rounded-2xl p-4 border border-outline-variant card-hover flex items-center gap-3 group">
            <div class="w-11 h-11 gradient-info rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-info/30">
                <span class="material-symbols-outlined text-white">add_box</span>
            </div>
            <div class="min-w-0">
                <p class="font-bold text-on-surface text-sm">Tambah Produk</p>
                <p class="text-body-sm text-on-surface-variant">Produk baru</p>
            </div>
        </a>
        <a href="{{ route('products.index') }}" class="quick-action bg-white rounded-2xl p-4 border border-outline-variant card-hover flex items-center gap-3 group">
            <div class="w-11 h-11 gradient-purple rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-purple/30">
                <span class="material-symbols-outlined text-white">inventory_2</span>
            </div>
            <div class="min-w-0">
                <p class="font-bold text-on-surface text-sm">Cek Stok</p>
                <p class="text-body-sm text-on-surface-variant">Lihat inventori</p>
            </div>
        </a>
        <a href="{{ route('reports.index') }}" class="quick-action bg-white rounded-2xl p-4 border border-outline-variant card-hover flex items-center gap-3 group">
            <div class="w-11 h-11 gradient-warning rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-warning/30">
                <span class="material-symbols-outlined text-white">bar_chart</span>
            </div>
            <div class="min-w-0">
                <p class="font-bold text-on-surface text-sm">Laporan</p>
                <p class="text-body-sm text-on-surface-variant">Analisis bisnis</p>
            </div>
        </a>
    </div>

    <!-- Alert Banner (if critical stock) -->
    @if($criticalStockCount > 0)
    <div class="bg-gradient-to-r from-red-50 to-orange-50 border border-red-200 rounded-2xl p-4 flex items-center gap-4 animate-fade-in-up-delay-1">
        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-red-500">error</span>
        </div>
        <div class="flex-1 min-w-0">
            <p class="font-bold text-red-700 text-sm">Stok Kritis!</p>
            <p class="text-body-sm text-red-600">{{ $criticalStockCount }} produk hampir habis dan perlu segera direstock.</p>
        </div>
        <a href="{{ route('products.index') }}" class="shrink-0 px-4 py-2 bg-red-500 text-white rounded-xl font-bold text-sm hover:bg-red-600 transition-colors">
            Lihat
        </a>
    </div>
    @endif

    <!-- Main Metrics Row -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Health Score Card -->
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white rounded-3xl border border-outline-variant p-6 card-hover h-full relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 rounded-full -mr-16 -mt-16 opacity-20" style="background: {{ $healthColor }}"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <p class="font-label-caps text-text-light uppercase tracking-widest">Health Score</p>
                        <span class="px-3 py-1 rounded-full text-xs font-bold" style="background: {{ $healthColor }}15; color: {{ $healthColor }}">{{ $healthLabel }}</span>
                    </div>
                    <div class="flex items-center justify-center my-4">
                        <div class="relative w-36 h-36">
                            <svg class="w-full h-full transform -rotate-90">
                                <circle cx="72" cy="72" r="70" fill="transparent" stroke="#E5E7EB" stroke-width="10"/>
                                <circle cx="72" cy="72" r="70" fill="transparent" stroke="{{ $healthColor }}" stroke-width="10"
                                    stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $strokeOffset }}"
                                    stroke-linecap="round" class="progress-ring__circle"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-3xl font-extrabold" style="color: {{ $healthColor }}">{{ $healthScore }}</span>
                                <span class="text-body-sm text-text-light">/ 100</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-center text-body-sm text-on-surface-variant">
                        {{ $criticalStockCount > 0 ? 'Ada stok yang perlu diprioritaskan.' : 'Operasional berjalan baik.' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="col-span-12 lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Omzet Card -->
            <div class="bg-white rounded-3xl border border-outline-variant p-6 card-hover relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-50 rounded-full -mr-10 -mt-10"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 gradient-success rounded-xl flex items-center justify-center shadow-lg shadow-success/20">
                            <span class="material-symbols-outlined text-white">payments</span>
                        </div>
                        <div class="flex items-center gap-1 px-2.5 py-1 bg-emerald-50 rounded-full">
                            <span class="material-symbols-outlined text-emerald-500 text-sm">trending_up</span>
                            <span class="text-emerald-600 text-xs font-bold">+12%</span>
                        </div>
                    </div>
                    <p class="text-body-sm text-on-surface-variant mb-1">Omzet Hari Ini</p>
                    <h3 class="text-2xl font-bold text-on-surface">Rp {{ number_format($todayOmzet, 0, ',', '.') }}</h3>
                    <div class="mt-3 flex items-end gap-1 h-8">
                        @foreach($dailyRevenue->take(7) as $i => $day)
                            @php $h = max(20, ($day['total'] / $maxRevenue) * 100); @endphp
                            <div class="flex-1 rounded-t bg-emerald-100" style="height: {{ $h }}%"></div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Transaksi Card -->
            <div class="bg-white rounded-3xl border border-outline-variant p-6 card-hover relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-full -mr-10 -mt-10"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 gradient-info rounded-xl flex items-center justify-center shadow-lg shadow-info/20">
                            <span class="material-symbols-outlined text-white">receipt_long</span>
                        </div>
                        <span class="text-body-sm text-text-light">Hari ini</span>
                    </div>
                    <p class="text-body-sm text-on-surface-variant mb-1">Total Transaksi</p>
                    <h3 class="text-2xl font-bold text-on-surface">{{ $todayTransactions }}</h3>
                    <p class="text-body-sm text-on-surface-variant mt-3">
                        @if($todayTransactions > 0)
                            <span class="text-emerald-500 font-medium">↑ Rata-rata Rp {{ number_format($todayOmzet / max($todayTransactions, 1), 0, ',', '.') }}/transaksi</span>
                        @else>
                            <span class="text-text-light">Belum ada transaksi</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Stok Kritis Card -->
            <div class="bg-white rounded-3xl border border-outline-variant p-6 card-hover relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-red-50 rounded-full -mr-10 -mt-10"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 gradient-danger rounded-xl flex items-center justify-center shadow-lg shadow-danger/20">
                            <span class="material-symbols-outlined text-white">warning</span>
                        </div>
                        @if($criticalStockCount > 0)
                            <span class="relative flex h-3 w-3">
                                <span class="notification-dot absolute inline-flex h-full w-full rounded-full bg-red-400"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                            </span>
                        @endif
                    </div>
                    <p class="text-body-sm text-on-surface-variant mb-1">Stok Kritis</p>
                    <h3 class="text-2xl font-bold {{ $criticalStockCount > 0 ? 'text-error' : 'text-on-surface' }}">{{ $criticalStockCount }}</h3>
                    <p class="text-body-sm mt-3 {{ $criticalStockCount > 0 ? 'text-error' : 'text-emerald-500' }} font-medium">
                        {{ $criticalStockCount > 0 ? 'Perlu direstock segera' : 'Semua stok aman ✓' }}
                    </p>
                </div>
            </div>

            <!-- Prediksi Card -->
            <div class="bg-white rounded-3xl border border-outline-variant p-6 card-hover relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-purple-50 rounded-full -mr-10 -mt-10"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 gradient-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple/20">
                            <span class="material-symbols-outlined text-white">auto_awesome</span>
                        </div>
                        <span class="text-body-sm text-text-light">AI Prediksi</span>
                    </div>
                    <p class="text-body-sm text-on-surface-variant mb-1">Prediksi Omzet Besok</p>
                    <h3 class="text-2xl font-bold text-on-surface">Rp {{ number_format($predictionTomorrow, 0, ',', '.') }}</h3>
                    <p class="text-body-sm text-purple-500 mt-3 font-medium">🤖 Berdasarkan pola penjualan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart & Insights Row -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Revenue Chart -->
        <div class="col-span-12 xl:col-span-8">
            <div class="bg-white rounded-3xl border border-outline-variant p-6 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-h3 font-bold text-on-surface">Omzet 7 Hari Terakhir</h3>
                        <p class="text-body-sm text-on-surface-variant">Visualisasi performa mingguan</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1.5 bg-primary/10 text-primary rounded-full text-xs font-bold">Minggu Ini</span>
                    </div>
                </div>
                <div class="h-64 flex items-end gap-3">
                    @foreach($dailyRevenue as $day)
                        @php
                            $height = max(12, round(($day['total'] / $maxRevenue) * 100));
                            $isToday = $day['label'] === now()->locale('id')->dayName;
                        @endphp
                        <div class="flex-1 flex flex-col items-center gap-2 bar-item relative group cursor-pointer">
                            <!-- Tooltip -->
                            <div class="chart-tooltip absolute -top-12 left-1/2 -translate-x-1/2 bg-text-dark text-white text-xs px-3 py-1.5 rounded-lg whitespace-nowrap z-10">
                                Rp {{ number_format($day['total'], 0, ',', '.') }}
                            </div>
                            <div class="w-full rounded-t-xl transition-all duration-300 animate-bar-grow {{ $isToday ? 'bg-gradient-to-t from-primary to-emerald-400' : 'bg-gradient-to-t from-emerald-100 to-emerald-50 group-hover:from-emerald-200 group-hover:to-emerald-100' }}"
                                style="height: {{ $height }}%">
                            </div>
                            <span class="text-label-caps {{ $isToday ? 'text-primary font-bold' : 'text-on-surface-variant' }}">{{ $day['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- AI Insights -->
        <div class="col-span-12 xl:col-span-4 flex flex-col gap-4">
            <div class="bg-white rounded-3xl border border-outline-variant border-t-4 border-t-purple-500 p-6 flex-1">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 gradient-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple/20">
                        <span class="material-symbols-outlined text-white text-[20px]">psychology</span>
                    </div>
                    <h3 class="font-bold text-on-surface">AI Insights</h3>
                </div>
                <div class="space-y-3">
                    @forelse($insights as $insight)
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-purple-50/50 border border-purple-100">
                            <span class="material-symbols-outlined text-purple-500 text-[18px] mt-0.5">lightbulb</span>
                            <p class="text-body-sm text-on-surface">{{ $insight }}</p>
                        </div>
                    @empty
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                            <span class="material-symbols-outlined text-gray-400 text-[18px] mt-0.5">insights</span>
                            <p class="text-body-sm text-on-surface-variant">Belum cukup data transaksi untuk membentuk insight otomatis.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- CTA Card -->
            <a href="{{ route('ai.index') }}" class="block bg-gradient-to-br from-purple-500 to-indigo-600 rounded-3xl p-6 text-white relative overflow-hidden group hover:scale-[1.02] transition-transform">
                <div class="absolute -bottom-4 -right-4 text-[100px] text-white/10 pointer-events-none">
                    <span class="material-symbols-outlined">smart_toy</span>
                </div>
                <div class="relative z-10">
                    <h4 class="font-bold mb-1">Butuh Bantuan?</h4>
                    <p class="text-white/80 text-body-sm mb-3">Konsultasikan strategi penjualan dengan AI TokoQ.</p>
                    <span class="inline-flex items-center gap-2 font-bold text-sm">
                        Mulai Chat <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </span>
                </div>
            </a>
        </div>
    </div>

    <!-- Bottom Row: Stock Table & Best Sellers -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Critical Stock Table -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-3xl border border-outline-variant overflow-hidden">
                <div class="p-5 border-b border-outline-variant flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-red-500 text-[20px]">inventory</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface">Stok Kritis</h3>
                            <p class="text-body-sm text-on-surface-variant">Barang yang hampir habis</p>
                        </div>
                    </div>
                    <button class="bg-primary text-on-primary px-4 py-2 rounded-xl font-bold text-sm active:scale-95 transition-transform flex items-center gap-2 self-start sm:self-auto">
                        <span class="material-symbols-outlined text-[18px]">list_alt</span>
                        Daftar Belanja
                    </button>
                </div>

                @if($criticalProducts->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="material-symbols-outlined text-3xl text-emerald-500">check_circle</span>
                        </div>
                        <h4 class="font-bold text-on-surface mb-1">Semua Stok Aman!</h4>
                        <p class="text-body-sm text-on-surface-variant">Tidak ada produk dengan stok kritis saat ini.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-text-light font-label-caps text-xs uppercase">
                                <tr>
                                    <th class="px-5 py-3">Produk</th>
                                    <th class="px-5 py-3">Sisa Stok</th>
                                    <th class="px-5 py-3">Status</th>
                                    <th class="px-5 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse($criticalProducts as $product)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-3 font-bold text-on-surface">{{ $product->name }}</td>
                                    <td class="px-5 py-3">
                                        <span class="font-bold {{ $product->stock < 5 ? 'text-error' : 'text-amber-500' }}">{{ $product->stock }}</span>
                                        <span class="text-on-surface-variant text-sm"> unit</span>
                                    </td>
                                    <td class="px-5 py-3">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $product->status === 'kritis' ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-600' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-right">
                                        <a href="{{ route('products.edit', $product) }}" class="text-primary font-bold text-sm hover:underline">Restock</a>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Best Sellers -->
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white rounded-3xl border border-outline-variant p-6 h-full">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-500 text-[20px]">emoji_events</span>
                    </div>
                    <h3 class="font-bold text-on-surface">Produk Terlaris</h3>
                </div>

                @if($bestSellers->isEmpty())
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="material-symbols-outlined text-3xl text-gray-300">inventory_2</span>
                        </div>
                        <p class="text-body-sm text-on-surface-variant">Belum ada data penjualan.</p>
                        <a href="{{ route('pos.index') }}" class="inline-block mt-3 text-primary font-bold text-sm">Mulai berjualan →</a>
                    </div>
                @else
                    <div class="space-y-4">
                        @forelse($bestSellers as $index => $item)
                        <div class="flex items-center gap-3 p-3 rounded-xl {{ $index === 0 ? 'bg-amber-50 border border-amber-100' : 'bg-gray-50' }}">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm shrink-0
                                {{ $index === 0 ? 'bg-amber-400 text-white' : ($index === 1 ? 'bg-gray-300 text-white' : ($index === 2 ? 'bg-orange-300 text-white' : 'bg-gray-200 text-gray-600')) }}">
                                @if($index === 0) 👑 @elseif($index === 1) 🥈 @elseif($index === 2) 🥉 @else {{ $index + 1 }} @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-on-surface text-sm truncate">{{ $item->name }}</p>
                                <p class="text-body-sm text-on-surface-variant">{{ $item->total_sold }} terjual</p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="font-bold text-primary text-sm">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                    <a href="{{ route('sales.index') }}" class="block w-full mt-4 py-2.5 text-center text-primary font-bold text-sm border border-primary/20 rounded-xl hover:bg-primary/5 transition-colors">
                        Lihat Semua Penjualan
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="pb-8 flex flex-col sm:flex-row justify-between items-center gap-2 opacity-40">
        <p class="text-body-sm">&copy; 2025 TokoQ. All rights reserved.</p>
        <div class="flex gap-4 text-body-sm">
            <a class="hover:text-primary underline" href="#">Syarat & Ketentuan</a>
            <a class="hover:text-primary underline" href="#">Kebijakan Privasi</a>
        </div>
    </footer>
</div>
@endsection

@section('scripts')
<!-- FAB -->
<button onclick="window.location.href='{{ route('pos.index') }}'" class="fixed bottom-6 right-6 w-14 h-14 bg-primary text-white rounded-2xl shadow-2xl shadow-primary/30 flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 group">
    <span class="material-symbols-outlined text-[28px] group-hover:rotate-90 transition-transform">add</span>
</button>
@endsection
