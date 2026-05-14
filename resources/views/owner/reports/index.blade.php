@extends('owner.layouts.app')

@section('title', 'Laporan - TokoQ')

@section('content')
<section class="app-page p-4 lg:p-8 space-y-card-gap">
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
@endsection
