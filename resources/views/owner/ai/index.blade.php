<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Prediksi AI - TokoQ</title>
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
</style>
</head>
<body class="app-shell bg-background text-on-surface font-body-md">
@include('owner.layouts.sidebar', ['activeMenu' => 'ai'])

<main class="app-main ml-64 min-h-screen">
    <header class="app-header h-20 w-full sticky top-0 z-40 bg-surface border-b border-outline-variant flex justify-between items-center px-container-padding">
        <div class="flex items-center gap-4">
            <button class="mobile-nav-trigger lg:hidden" data-sidebar-toggle type="button"><span class="material-symbols-outlined">menu</span></button>
            <div>
                <h2 class="font-h3 text-h3 font-bold text-primary">Prediksi AI</h2>
                <p class="text-body-sm text-on-surface-variant">Ringkasan dihitung dari penjualan dan stok toko Anda yang tersimpan saat ini.</p>
            </div>
        </div>
        <span class="font-bold text-primary">{{ Auth::user()->name }}</span>
    </header>

    <section class="app-page p-container-padding space-y-card-gap">
        <div class="grid grid-cols-12 gap-card-gap">
            <div class="col-span-12 lg:col-span-7 bg-surface-container-lowest rounded-3xl border border-outline-variant p-8">
                <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between mb-8">
                    <div>
                        <p class="text-label-caps text-secondary uppercase tracking-widest mb-2">Estimasi Besok</p>
                        <h3 class="font-h2 text-h2 text-primary">Prediksi Omzet</h3>
                    </div>
                    <span class="px-4 py-2 rounded-full bg-primary-container text-on-primary-container font-bold text-body-sm">
                        {{ $trendPercent >= 0 ? '+' : '' }}{{ $trendPercent }}% vs periode sebelumnya
                    </span>
                </div>

                <div class="mb-8">
                    <p class="font-h1 text-h1 text-primary">Rp {{ number_format($forecast, 0, ',', '.') }}</p>
                    <p class="text-body-sm text-on-surface-variant mt-2">{{ $summary }}</p>
                </div>

                @php $maxTotal = max($recentDays->max('total') ?? 0, 1); @endphp
                <div class="h-64 rounded-3xl bg-surface-container-low p-6 flex items-end gap-4">
                    @foreach ($recentDays as $day)
                        @php $height = max(16, ($day['total'] / $maxTotal) * 180); @endphp
                        <div class="flex-1 flex flex-col justify-end items-center gap-3">
                            <div class="w-full rounded-t-2xl bg-primary/15">
                                <div class="w-full rounded-t-2xl bg-primary" style="height: {{ $height }}px;"></div>
                            </div>
                            <span class="text-body-sm font-bold text-on-surface-variant">{{ $day['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-12 lg:col-span-5 space-y-card-gap">
                <div class="bg-surface-container-lowest rounded-3xl border border-outline-variant p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="material-symbols-outlined text-error">warning</span>
                        <h3 class="font-h3 text-h3 text-primary">Produk Risiko Stok</h3>
                    </div>
                    @if ($criticalProducts->isEmpty())
                        <p class="text-body-sm text-on-surface-variant">Belum ada produk dengan stok rendah. Tidak ada peringatan kritis saat ini.</p>
                    @else
                        <div class="space-y-3">
                            @foreach ($criticalProducts->take(4) as $product)
                                <div class="rounded-2xl border border-outline-variant bg-surface-container-low p-4">
                                    <div class="flex items-center justify-between gap-4">
                                        <div>
                                            <p class="font-bold text-on-surface">{{ $product->name }}</p>
                                            <p class="text-body-sm text-on-surface-variant">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold {{ $product->stock < 5 ? 'text-error' : 'text-amber-600' }}">{{ $product->stock }} unit</p>
                                            <p class="text-body-sm text-on-surface-variant">{{ ucfirst($product->status) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="bg-primary text-on-primary rounded-3xl p-6">
                    <p class="text-label-caps uppercase tracking-widest opacity-80 mb-2">Aksi Disarankan</p>
                    <p class="font-h3 text-h3 mb-4">
                        {{ $shoppingSuggestions->isNotEmpty() ? 'Prioritaskan restock produk dengan stok terendah terlebih dahulu.' : 'Fokus ke peningkatan penjualan karena stok masih aman.' }}
                    </p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-primary-fixed text-primary px-5 py-3 rounded-xl font-bold">
                        <span class="material-symbols-outlined">inventory</span>
                        Buka Inventori
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-card-gap">
            <div class="col-span-12 lg:col-span-5 bg-surface-container-lowest rounded-3xl border border-outline-variant p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-h3 text-h3 text-primary">Produk Terlaris</h3>
                    <span class="material-symbols-outlined text-primary">auto_graph</span>
                </div>
                @if ($topProducts->isEmpty())
                    <p class="text-body-sm text-on-surface-variant">Belum ada transaksi untuk dianalisis.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($topProducts as $product)
                            @php $width = max(10, min(100, ($product->total_sold / max($topProducts->max('total_sold'), 1)) * 100)); @endphp
                            <div>
                                <div class="flex items-center justify-between gap-4 mb-2">
                                    <div>
                                        <p class="font-bold text-on-surface">{{ $product->name }}</p>
                                        <p class="text-body-sm text-on-surface-variant">{{ number_format($product->total_sold) }} item</p>
                                    </div>
                                    <p class="font-bold text-primary">Rp {{ number_format($product->revenue, 0, ',', '.') }}</p>
                                </div>
                                <div class="w-full h-2 rounded-full bg-surface-container">
                                    <div class="h-2 rounded-full bg-primary" style="width: {{ $width }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-span-12 lg:col-span-7 bg-surface-container-lowest rounded-3xl border border-outline-variant p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-h3 text-h3 text-primary">Daftar Restock Rekomendasi</h3>
                    <a href="{{ route('reports.index') }}" class="text-primary font-bold">Lihat Laporan</a>
                </div>
                @if ($shoppingSuggestions->isEmpty())
                    <p class="text-body-sm text-on-surface-variant">Belum ada rekomendasi restock. Data stok masih aman atau produk belum tersedia.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($shoppingSuggestions as $suggestion)
                            <div class="rounded-2xl border border-outline-variant bg-surface-container-low p-4">
                                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <p class="font-bold text-on-surface">{{ $suggestion['name'] }}</p>
                                        <p class="text-body-sm text-on-surface-variant">{{ $suggestion['category'] }} • Stok saat ini {{ $suggestion['stock'] }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-primary">Tambah {{ $suggestion['recommended'] }} unit</p>
                                        <p class="text-body-sm text-on-surface-variant">Estimasi Rp {{ number_format($suggestion['estimate'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>

<script src="/template/tokoq_design_system/responsive.js"></script>
</body>
</html>
