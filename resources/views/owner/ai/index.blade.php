@extends('owner.layouts.app')

@section('title', 'Prediksi AI - TokoQ')

@section('content')
<section class="app-page p-container-padding space-y-card-gap">
    <div class="grid grid-cols-12 gap-card-gap">
        <div class="col-span-12 lg:col-span-7 bg-white rounded-3xl border border-outline-variant p-8">
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
            <div class="h-64 rounded-3xl bg-white p-6 flex items-end gap-4">
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
            <div class="bg-white rounded-3xl border border-outline-variant p-6">
                <div class="flex items-center gap-3 mb-5">
                    <span class="material-symbols-outlined text-error">warning</span>
                    <h3 class="font-h3 text-h3 text-primary">Produk Risiko Stok</h3>
                </div>
                @if ($criticalProducts->isEmpty())
                    <p class="text-body-sm text-on-surface-variant">Belum ada produk dengan stok rendah. Tidak ada peringatan kritis saat ini.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($criticalProducts->take(4) as $product)
                            <div class="rounded-2xl border border-outline-variant bg-white p-4">
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
        <div class="col-span-12 lg:col-span-5 bg-white rounded-3xl border border-outline-variant p-6">
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
                            <div class="w-full h-2 rounded-full bg-white">
                                <div class="h-2 rounded-full bg-primary" style="width: {{ $width }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-span-12 lg:col-span-7 bg-white rounded-3xl border border-outline-variant p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-h3 text-h3 text-primary">Daftar Restock Rekomendasi</h3>
                <a href="{{ route('reports.index') }}" class="text-primary font-bold">Lihat Laporan</a>
            </div>
            @if ($shoppingSuggestions->isEmpty())
                <p class="text-body-sm text-on-surface-variant">Belum ada rekomendasi restock. Data stok masih aman atau produk belum tersedia.</p>
            @else
                <div class="space-y-3">
                    @foreach ($shoppingSuggestions as $suggestion)
                        <div class="rounded-2xl border border-outline-variant bg-white p-4">
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
@endsection
