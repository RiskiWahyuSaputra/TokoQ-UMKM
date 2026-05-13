<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Laporan - TokoQ</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="/template/tokoq_design_system/responsive.css" rel="stylesheet"/>
<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<script src="/js/tailwind-config.js"></script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="app-shell bg-background text-on-surface font-body-md">

@include('owner.layouts.sidebar', ['activeMenu' => 'reports'])

<main class="app-main ml-64 min-h-screen">
    <header class="app-header h-20 w-full sticky top-0 z-40 bg-surface border-b border-outline-variant flex justify-between items-center px-container-padding">
        <div class="flex items-center gap-4">
            <button class="mobile-nav-trigger lg:hidden" data-sidebar-toggle="" type="button"><span class="material-symbols-outlined">menu</span></button>
            <div>
                <h2 class="font-h3 text-h3 font-bold text-primary">Laporan</h2>
                <p class="text-body-sm text-on-surface-variant">Ringkasan performa usaha 7 hari terakhir</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('sales.index') }}" class="bg-primary text-on-primary px-6 py-2 rounded-full font-bold">Lihat Penjualan</a>
            <span class="font-bold text-primary">{{ Auth::user()->name }}</span>
        </div>
    </header>

    <section class="app-page p-container-padding space-y-card-gap">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-card-gap">
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <p class="font-label-caps text-secondary uppercase tracking-widest">Total Omzet</p>
                <h3 class="font-h2 text-h2 text-primary mt-2">Rp {{ number_format($transactions->sum('net_amount'), 0, ',', '.') }}</h3>
                <p class="text-body-sm text-on-surface-variant mt-2">Akumulasi transaksi tersimpan</p>
            </div>
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <p class="font-label-caps text-secondary uppercase tracking-widest">Total Transaksi</p>
                <h3 class="font-h2 text-h2 text-primary mt-2">{{ $transactions->count() }}</h3>
                <p class="text-body-sm text-on-surface-variant mt-2">Jumlah seluruh penjualan</p>
            </div>
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <p class="font-label-caps text-secondary uppercase tracking-widest">Rata-rata</p>
                <h3 class="font-h2 text-h2 text-primary mt-2">Rp {{ $transactions->count() ? number_format($transactions->avg('net_amount'), 0, ',', '.') : 0 }}</h3>
                <p class="text-body-sm text-on-surface-variant mt-2">Nilai per transaksi</p>
            </div>
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <p class="font-label-caps text-secondary uppercase tracking-widest">Hari Ini</p>
                <h3 class="font-h2 text-h2 text-primary mt-2">{{ $transactions->where('created_at', '>=', today())->count() }}</h3>
                <p class="text-body-sm text-on-surface-variant mt-2">Transaksi pada hari ini</p>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-card-gap">
            <div class="col-span-12 lg:col-span-7 bg-white rounded-2xl border border-outline-variant p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-h3 text-h3 text-primary">Tren Omzet 7 Hari</h3>
                        <p class="text-body-sm text-on-surface-variant">Pantau naik turun pemasukan harian</p>
                    </div>
                </div>
                @php $maxRevenue = max($dailyRevenue->max('total') ?? 0, 1); @endphp
                <div class="h-64 flex items-end gap-4">
                    @foreach ($dailyRevenue as $day)
                        @php
                            $height = max(12, ($day['total'] / $maxRevenue) * 100);
                        @endphp
                        <div class="flex-1 flex flex-col items-center gap-3">
                            <div class="w-full rounded-t-2xl bg-primary/15 overflow-hidden">
                                <div class="w-full rounded-t-2xl bg-primary" style="height: {{ $height }}px; min-height: 12px;"></div>
                            </div>
                            <div class="text-center">
                                <p class="text-body-sm font-bold text-primary">{{ $day['label'] }}</p>
                                <p class="text-[12px] text-on-surface-variant">{{ $day['full_date'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-12 lg:col-span-5 bg-white rounded-2xl border border-outline-variant p-8">
                <h3 class="font-h3 text-h3 text-primary mb-6">Metode Pembayaran</h3>
                @forelse ($paymentSummary as $payment)
                    <div class="flex items-center justify-between py-4 border-b border-outline-variant/60 last:border-b-0">
                        <div>
                            <p class="font-bold text-on-surface">{{ $payment['method'] }}</p>
                            <p class="text-body-sm text-on-surface-variant">{{ $payment['count'] }} transaksi</p>
                        </div>
                        <p class="font-bold text-primary">Rp {{ number_format($payment['total'], 0, ',', '.') }}</p>
                    </div>
                @empty
                    <div class="text-center py-16 text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl mb-3 block">payments</span>
                        <p>Belum ada data pembayaran yang bisa ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="grid grid-cols-12 gap-card-gap">
            <div class="col-span-12 lg:col-span-5 bg-white rounded-2xl border border-outline-variant p-8">
                <h3 class="font-h3 text-h3 text-primary mb-6">Produk Terlaris</h3>
                @forelse ($topProducts as $product)
                    <div class="flex items-center justify-between py-4 border-b border-outline-variant/60 last:border-b-0">
                        <div>
                            <p class="font-bold text-on-surface">{{ $product->name }}</p>
                            <p class="text-body-sm text-on-surface-variant">{{ number_format($product->total_sold) }} item terjual</p>
                        </div>
                        <p class="font-bold text-primary">Rp {{ number_format($product->revenue, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <div class="text-center py-16 text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl mb-3 block">inventory</span>
                        <p>Belum ada produk terjual yang bisa dirangkum.</p>
                    </div>
                @endforelse
            </div>

            <div class="col-span-12 lg:col-span-7 bg-white rounded-2xl border border-outline-variant overflow-hidden">
                <div class="p-6 border-b border-outline-variant">
                    <h3 class="font-h3 text-h3 text-primary">Transaksi Terbaru</h3>
                </div>
                @if ($transactions->isEmpty())
                    <div class="text-center py-16 text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl mb-3 block">receipt_long</span>
                        <p>Belum ada transaksi untuk dibuatkan laporan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-white border-b border-outline-variant">
                                    <th class="px-6 py-4 font-label-caps text-secondary">Tanggal</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary">Metode</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary">Diskon</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary">Net</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @foreach ($transactions->take(12) as $transaction)
                                    <tr class="hover:bg-white transition-colors">
                                        <td class="px-6 py-4 text-body-sm">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                                        <td class="px-6 py-4 font-medium">{{ strtoupper($transaction->payment_method ?? 'Tunai') }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($transaction->discount_amount ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 font-bold text-primary">Rp {{ number_format($transaction->net_amount ?? $transaction->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>

<script src="/template/tokoq_design_system/responsive.js"></script>
</body>
</html>
