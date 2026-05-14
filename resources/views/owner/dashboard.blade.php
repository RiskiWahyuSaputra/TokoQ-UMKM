<!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="../tokoq_design_system/responsive.css" rel="stylesheet"/>
<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<script src="/js/tailwind-config.js"></script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-nav-border {
            box-shadow: inset 4px 0 0 0 #10B981;
        }
        .digital-twin-gradient {
            background: radial-gradient(circle at center, #ffffff 0%, #ECFDF5 100%);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #D1D5DB;
            border-radius: 10px;
        }
    </style>
</head>
<body class="app-shell bg-secondary text-text font-body-md overflow-x-hidden">
<!-- SideNavBar Shell -->
@include('owner.layouts.sidebar', ['activeMenu' => 'dashboard'])
@php
    $user = Auth::user();
    $initials = collect(explode(' ', trim($user->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
    $maxRevenue = max($dailyRevenue->max('total') ?? 0, 1);
@endphp
<!-- Main Content Area -->
<main class="app-main lg:ml-64 min-h-screen">
<!-- TopNavBar Shell -->
@include('owner.layouts.header', ['pageTitle' => 'Dashboard Utama'])
<section class="app-page p-container-padding">
<!-- Welcome Header -->
<div class="mb-8">
<h2 class="font-h2 text-h2 text-primary mb-1">Selamat Datang, {{ $user->name }}</h2>
<p class="text-on-surface-variant">Berikut ringkasan performa toko Anda hari ini.</p>
</div>
<!-- Metric Cards & Digital Twin Grid -->
<div class="grid grid-cols-12 gap-card-gap mb-section-margin">
<!-- Digital Twin Score Widget -->
<div class="col-span-12 lg:col-span-4 bg-white p-8 rounded-[24px] border border-outline-variant shadow-md shadow-[#49592A]/10 digital-twin-gradient relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-primary-fixed/20 rounded-full -mr-16 -mt-16 blur-3xl"></div>
<div class="flex flex-col items-center text-center relative z-10">
<p class="font-label-caps text-secondary mb-6">Digital Twin Score</p>
<div class="relative w-40 h-40 mb-6">
<svg class="w-full h-full transform -rotate-90">
<circle cx="80" cy="80" fill="transparent" r="70" stroke="#edefdf" stroke-width="12"></circle>
<circle cx="80" cy="80" fill="transparent" r="70" stroke="#576B33" stroke-dasharray="440" stroke-dashoffset="79.2" stroke-linecap="round" stroke-width="12"></circle>
</svg>
<div class="absolute inset-0 flex flex-col items-center justify-center">
<span class="text-[42px] font-extrabold text-primary">{{ $healthScore }}</span>
<span class="text-on-surface-variant font-medium">/ 100</span>
</div>
</div>
<div class="flex items-center gap-2 bg-secondary-container px-4 py-2 rounded-full mb-2">
<span class="material-symbols-outlined text-secondary text-sm" data-icon="check_circle" data-weight="fill" style="font-variation-settings: 'FILL' 1;">check_circle</span>
<span class="font-bold text-on-secondary-fixed-variant text-body-sm">{{ $healthScore >= 80 ? 'Toko dalam kondisi sehat' : ($healthScore >= 60 ? 'Performa toko cukup stabil' : 'Perlu perhatian pada stok dan penjualan') }}</span>
</div>
<p class="text-body-sm text-on-surface-variant max-w-[220px]">{{ $criticalStockCount > 0 ? 'Masih ada stok yang perlu diprioritaskan untuk direstock.' : 'Tidak ada stok kritis dan operasional utama berjalan baik.' }}</p>
</div>
</div>
<!-- Main Metrics Grid -->
<div class="col-span-12 lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-card-gap">
<!-- Omzet Card -->
<div class="bg-white p-6 rounded-[24px] border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex justify-between items-start mb-4">
<div class="p-3 bg-secondary-container rounded-xl text-on-secondary-container">
<span class="material-symbols-outlined" data-icon="payments">payments</span>
</div>
<span class="flex items-center gap-1 text-on-primary-container bg-primary-container px-2 py-1 rounded-lg text-body-sm font-bold">
<span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span>
                                +0%
                            </span>
</div>
<p class="text-on-surface-variant font-medium">Omzet Hari Ini</p>
<h3 class="text-h2 font-bold text-on-surface">Rp {{ number_format($todayOmzet, 0, ',', '.') }}</h3>
</div>
<!-- Transaksi Card -->
<div class="bg-white p-6 rounded-[24px] border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex justify-between items-start mb-4">
<div class="p-3 bg-tertiary-fixed rounded-xl text-on-tertiary-fixed-variant">
<span class="material-symbols-outlined" data-icon="receipt_long">receipt_long</span>
</div>
</div>
<p class="text-on-surface-variant font-medium">Transaksi Hari Ini</p>
<h3 class="text-h2 font-bold text-on-surface">{{ $todayTransactions }}</h3>
</div>
<!-- Stok Kritis Card -->
<div class="bg-white p-6 rounded-[24px] border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex justify-between items-start mb-4">
<div class="p-3 bg-error-container rounded-xl text-on-error-container">
<span class="material-symbols-outlined" data-icon="warning">warning</span>
</div>
</div>
<p class="text-on-surface-variant font-medium">Produk Stok Kritis</p>
<h3 class="text-h2 font-bold text-error">{{ $criticalStockCount }}</h3>
</div>
<!-- Prediksi Card -->
<div class="bg-white p-6 rounded-[24px] border border-outline-variant shadow-sm hover:shadow-md transition-shadow border-t-4 border-t-tertiary">
<div class="flex justify-between items-start mb-4">
<div class="p-3 bg-tertiary-container rounded-xl text-on-tertiary-container">
<span class="material-symbols-outlined" data-icon="auto_awesome">auto_awesome</span>
</div>
</div>
<p class="text-on-surface-variant font-medium">Prediksi Omzet Besok</p>
<h3 class="text-h2 font-bold text-primary">Rp {{ number_format($predictionTomorrow, 0, ',', '.') }}</h3>
</div>
</div>
</div>
<!-- Middle Section: Graph & Insights -->
<div class="grid grid-cols-12 gap-card-gap mb-section-margin">
<!-- Revenue Chart -->
<div class="col-span-12 xl:col-span-8 bg-white p-8 rounded-[24px] border border-outline-variant shadow-sm">
<div class="flex justify-between items-center mb-8">
<div>
<h3 class="text-h3 font-bold text-on-surface">Omzet 7 Hari Terakhir</h3>
<p class="text-body-sm text-on-surface-variant">Visualisasi performa mingguan</p>
</div>
<button class="flex items-center gap-2 text-on-surface-variant font-medium hover:text-primary">
<span class="material-symbols-outlined text-[20px]" data-icon="calendar_today">calendar_today</span>
                            Minggu Ini
                        </button>
</div>
<!-- Dynamic Graph Area -->
<div class="h-64 flex items-end gap-4">
@foreach($dailyRevenue as $day)
@php $height = max(12, round(($day['total'] / $maxRevenue) * 100)); @endphp
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-white rounded-t-xl group-hover:bg-primary-container transition-colors" style="height: {{ $height }}%"></div>
<span class="text-label-caps text-on-surface-variant">{{ $day['label'] }}</span>
</div>
@endforeach
</div>
</div>
<!-- AI Insights Sidebar -->
<div class="col-span-12 xl:col-span-4 flex flex-col gap-card-gap">
<div class="bg-white p-6 rounded-[24px] border border-outline-variant border-t-4 border-t-tertiary shadow-sm relative overflow-hidden">
<div class="flex items-center gap-3 mb-6">
<div class="w-10 h-10 rounded-full bg-tertiary-container flex items-center justify-center text-on-tertiary-container">
<span class="material-symbols-outlined text-[20px]" data-icon="psychology">psychology</span>
</div>
<h3 class="text-body-lg font-bold text-primary">AI Business Insights</h3>
</div>
<ul class="space-y-4">
@forelse($insights as $insight)
<li class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-outline-variant/30">
<span class="material-symbols-outlined text-tertiary text-[20px] mt-1" data-icon="insights">insights</span>
<p class="text-body-md text-on-surface">{{ $insight }}</p>
</li>
@empty
<li class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-outline-variant/30">
<span class="material-symbols-outlined text-tertiary text-[20px] mt-1" data-icon="insights">insights</span>
<p class="text-body-md text-on-surface">Belum cukup data transaksi untuk membentuk insight otomatis.</p>
</li>
@endforelse
</ul>
</div>
<div class="bg-primary-container p-6 rounded-[24px] shadow-lg relative group cursor-pointer hover:scale-[1.02] transition-transform">
<div class="relative z-10">
<h4 class="text-on-primary-container font-bold mb-2">Butuh Bantuan?</h4>
<p class="text-on-primary-container/80 text-body-sm mb-4">Konsultasikan strategi penjualan Anda dengan asisten AI TokoQ.</p>
<span class="flex items-center gap-2 font-bold text-on-primary-container">
                                Mulai Chat <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
</span>
</div>
<span class="material-symbols-outlined absolute -bottom-4 -right-4 text-[120px] text-white/5 pointer-events-none" data-icon="smart_toy">smart_toy</span>
</div>
</div>
</div>
<!-- Final Row: Stock Table & Best Sellers -->
<div class="grid grid-cols-12 gap-card-gap">
<!-- Critical Stock Table -->
<div class="col-span-12 lg:col-span-8 bg-white rounded-[24px] border border-outline-variant shadow-sm overflow-hidden">
<div class="p-4 lg:p-8 pt-20 lg:pt-8 border-b border-outline-variant flex justify-between items-center">
<div>
<h3 class="text-h3 font-bold text-on-surface">Daftar Stok Kritis</h3>
<p class="text-body-sm text-on-surface-variant">Barang-barang yang hampir habis</p>
</div>
<button class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-bold active:scale-95 transition-transform flex items-center gap-2">
<span class="material-symbols-outlined text-[20px]" data-icon="list_alt">list_alt</span>
                            Buat Daftar Belanja Otomatis
                        </button>
</div>
<div class="table-responsive overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-white text-on-surface-variant font-label-caps uppercase">
<tr>
<th class="px-4 lg:px-8 py-4">Produk</th>
<th class="px-4 lg:px-8 py-4">Sisa Stok</th>
<th class="px-4 lg:px-8 py-4">Status</th>
<th class="px-4 lg:px-8 py-4">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
                    @forelse($criticalProducts as $product)
                    <tr>
                        <td class="px-4 lg:px-8 py-4 font-bold text-on-surface">{{ $product->name }}</td>
                        <td class="px-4 lg:px-8 py-4 text-on-surface-variant">{{ $product->stock }} Unit</td>
                        <td class="px-4 lg:px-8 py-4">
                            <span class="px-3 py-1 rounded-full {{ $product->status === 'kritis' ? 'bg-error-container text-on-error-container' : 'bg-[#ffdad6]/50 text-error' }} text-body-sm font-bold">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td class="px-4 lg:px-8 py-4">
                            <button class="text-primary font-bold hover:underline">Detail</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 lg:px-8 py-8 text-center text-gray-500 italic">Semua stok aman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
<!-- Best Sellers List -->
<div class="col-span-12 lg:col-span-4 bg-white p-8 rounded-[24px] border border-outline-variant shadow-sm">
<h3 class="text-h3 font-bold text-on-surface mb-6">Produk Terlaris</h3>
<div class="space-y-6">
    @forelse($bestSellers as $index => $item)
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center font-bold text-primary">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
        <div class="flex-1">
            <p class="font-bold text-on-surface">{{ $item->name }}</p>
            <p class="text-body-sm text-on-surface-variant">{{ $item->total_sold }} Terjual</p>
        </div>
        <div class="text-right">
            <p class="font-bold text-primary">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</p>
        </div>
    </div>
    @empty
    <p class="text-gray-500 italic">Belum ada data penjualan.</p>
    @endforelse
<button class="w-full py-3 text-primary font-bold border border-primary/20 rounded-xl hover:bg-primary/5 transition-colors mt-2">
                            Lihat Semua Produk
                        </button>
</div>
</div>
</div>
</section>
<!-- Footer / Feedback -->
<footer class="app-footer p-container-padding pb-12 opacity-50 flex justify-between items-center">
<p class="text-body-sm">© 2024 TokoQ Digital Twin Management. All rights reserved.</p>
<div class="flex gap-6 text-body-sm">
<a class="hover:text-primary underline" href="#">Syarat &amp; Ketentuan</a>
<a class="hover:text-primary underline" href="#">Kebijakan Privasi</a>
</div>
</footer>
</main>
<!-- FAB for Quick Transaction -->
<button class="app-fab fixed bottom-10 right-10 w-16 h-16 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50">
<span class="material-symbols-outlined text-[32px]" data-icon="add">add</span>
</button>
<script src="../tokoq_design_system/responsive.js"></script>
</body></html>
