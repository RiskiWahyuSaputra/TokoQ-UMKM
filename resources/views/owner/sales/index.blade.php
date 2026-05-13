<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Penjualan - TokoQ</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="/template/tokoq_design_system/responsive.css" rel="stylesheet"/>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: { extend: { "colors": { "inverse-primary": "#b8cf8c","tertiary-fixed": "#dae9ac","surface-bright": "#f8fbea","primary-fixed-dim": "#b8cf8c","primary-fixed": "#d3eba6","on-surface": "#191d13","inverse-on-surface": "#f0f2e2","surface-tint": "#51652e","outline": "#75786b","background": "#f8fbea","surface-variant": "#e1e4d4","on-secondary-container": "#596841","on-tertiary": "#ffffff","secondary-fixed-dim": "#bccd9e","on-error-container": "#93000a","inverse-surface": "#2e3227","secondary": "#55633d","surface-dim": "#d9dccb","secondary-fixed": "#d8e9b9","error-container": "#ffdad6","surface-container-highest": "#e1e4d4","on-tertiary-fixed": "#161f00","primary-container": "#576b33","surface-container-high": "#e7ead9","on-background": "#191d13","on-error": "#ffffff","surface-container-low": "#f2f5e4","tertiary": "#445122","secondary-container": "#d5e6b6","on-primary-container": "#d3eba5","tertiary-container": "#5c6938","on-secondary-fixed": "#131f02","outline-variant": "#c5c8b9","on-secondary": "#ffffff","on-primary-fixed": "#131f00","on-secondary-fixed-variant": "#3d4b28","surface": "#f8fbea","tertiary-fixed-dim": "#becd92","surface-container-lowest": "#ffffff","on-tertiary-container": "#d9e8aa","on-surface-variant": "#45483d","surface-container": "#edefdf","on-primary": "#ffffff","primary": "#40521d","on-primary-fixed-variant": "#3a4d18","error": "#ba1a1a","on-tertiary-fixed-variant": "#3f4b1d" }, "borderRadius": { "DEFAULT": "0.25rem","lg": "0.5rem","xl": "0.75rem","full": "9999px" }, "spacing": { "container-padding": "32px","section-margin": "48px","gutter": "24px","unit": "8px","card-gap": "24px" }, "fontSize": { "h2-mobile": ["24px", {"lineHeight": "1.3","fontWeight": "700"}],"h1-mobile": ["28px", {"lineHeight": "1.2","fontWeight": "700"}],"body-md": ["16px", {"lineHeight": "1.6","fontWeight": "400"}],"body-lg": ["18px", {"lineHeight": "1.6","fontWeight": "400"}],"body-sm": ["14px", {"lineHeight": "1.5","fontWeight": "400"}],"h1": ["40px", {"lineHeight": "1.2","letterSpacing": "-0.02em","fontWeight": "700"}],"h3": ["24px", {"lineHeight": "1.4","fontWeight": "600"}],"label-caps": ["12px", {"lineHeight": "1.2","letterSpacing": "0.05em","fontWeight": "700"}],"h2": ["32px", {"lineHeight": "1.3","letterSpacing": "-0.01em","fontWeight": "700"}] } } }
}
</script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
.paper-card { background-color: #ffffff; border: 1px solid #DDE3D2; box-shadow: 0 4px 20px -2px rgba(73,89,42,0.08); }
.ai-border { border-top: 4px solid #86945E; }
</style>
</head>
<body class="app-shell bg-background text-on-surface">

<!-- Sidebar -->
@include('owner.layouts.sidebar', ['activeMenu' => 'sales'])

<!-- Header -->
<header class="app-header h-20 w-full sticky top-0 z-40 bg-surface border-b border-outline-variant flex justify-between items-center px-container-padding ml-64 max-w-[calc(100%-16rem)]">
    <div class="flex items-center gap-6">
        <button class="mobile-nav-trigger lg:hidden" data-sidebar-toggle="" type="button"><span class="material-symbols-outlined">menu</span></button>
        <h2 class="font-h3 text-h3 font-bold text-primary">Penjualan</h2>
    </div>
    <div class="flex items-center gap-4">
        <a href="{{ route('pos.index') }}" class="bg-primary text-on-primary px-6 py-2 rounded-full font-bold">Buka Kasir</a>
        <span class="font-bold text-primary">{{ Auth::user()->name }}</span>
    </div>
</header>

<!-- Main Content -->
<main class="app-main app-page ml-64 p-container-padding space-y-gutter">

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-card-gap">
        <div class="paper-card rounded-xl p-6">
            <p class="font-label-caps text-secondary uppercase tracking-widest">Total Transaksi</p>
            <h3 class="font-h2 text-h2 text-primary mt-2">{{ $transactions->count() }}</h3>
            <p class="text-body-sm text-on-surface-variant mt-2">Transaksi tercatat</p>
        </div>
        <div class="paper-card rounded-xl p-6">
            <p class="font-label-caps text-secondary uppercase tracking-widest">Total Omzet</p>
            <h3 class="font-h2 text-h2 text-primary mt-2">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</h3>
            <p class="text-body-sm text-on-surface-variant mt-2">Semua transaksi</p>
        </div>
        <div class="paper-card rounded-xl p-6">
            <p class="font-label-caps text-secondary uppercase tracking-widest">Rata-rata Transaksi</p>
            <h3 class="font-h2 text-h2 text-primary mt-2">Rp {{ $transactions->count() > 0 ? number_format($transactions->avg('total_amount'), 0, ',', '.') : 0 }}</h3>
            <p class="text-body-sm text-on-surface-variant mt-2">Per transaksi</p>
        </div>
        <div class="paper-card rounded-xl p-6">
            <p class="font-label-caps text-secondary uppercase tracking-widest">Hari Ini</p>
            <h3 class="font-h2 text-h2 text-primary mt-2">{{ $transactions->where('created_at', '>=', today())->count() }}</h3>
            <p class="text-body-sm text-on-surface-variant mt-2">Transaksi hari ini</p>
        </div>
    </div>

    <!-- Chart Bar -->
    <div class="paper-card rounded-xl p-8">
        <h4 class="font-h3 text-h3 text-primary mb-6">Tren Penjualan (7 Hari Terakhir)</h4>
        <div class="h-48 flex items-end justify-between gap-4">
            @php
                $days = collect(range(6, 0))->map(fn($i) => now()->subDays($i));
                $maxVal = 1;
            @endphp
            @foreach($days as $day)
                @php
                    $count = $transactions->where('created_at', '>=', $day->startOfDay()->copy())->where('created_at', '<=', $day->endOfDay()->copy())->count();
                    $height = $maxVal > 0 ? max(10, ($count / max($maxVal, 1)) * 100) : 10;
                @endphp
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full rounded-t-lg {{ $day->isToday() ? 'bg-primary' : 'bg-secondary-container' }}" style="height: {{ $height }}%"></div>
                    <span class="text-body-sm {{ $day->isToday() ? 'font-bold text-primary' : 'text-on-surface-variant' }}">{{ $day->format('D') }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="paper-card rounded-xl overflow-hidden">
        <div class="p-6 border-b border-outline-variant flex justify-between items-center">
            <h4 class="font-h3 text-h3 text-primary">Transaksi Terbaru</h4>
        </div>
        @if($transactions->isEmpty())
            <div class="p-12 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl mb-4 block">receipt_long</span>
                <p>Belum ada transaksi. <a href="{{ route('pos.index') }}" class="text-primary font-bold">Mulai dari Kasir POS</a></p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-surface-container-low border-b border-outline-variant">
                            <th class="px-6 py-4 font-label-caps text-secondary">WAKTU</th>
                            <th class="px-6 py-4 font-label-caps text-secondary">TOTAL</th>
                            <th class="px-6 py-4 font-label-caps text-secondary">METODE</th>
                            <th class="px-6 py-4 font-label-caps text-secondary">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($transactions as $tx)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="px-6 py-4 text-body-sm">{{ $tx->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 font-bold text-primary">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-secondary-fixed text-on-secondary-fixed text-xs px-3 py-1 rounded-full font-bold">{{ ucfirst($tx->payment_method ?? 'Tunai') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-secondary-container text-on-secondary-container text-xs px-3 py-1 rounded-full font-bold">Selesai</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</main>

<script src="/template/tokoq_design_system/responsive.js"></script>
</body>
</html>
