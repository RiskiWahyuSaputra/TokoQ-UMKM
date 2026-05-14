@extends('owner.layouts.app')

@section('title', 'Penjualan - TokoQ')

@section('styles')
<style>
    .paper-card { background-color: #ffffff; border: 1px solid #D1D5DB; box-shadow: 0 4px 20px -2px rgba(16,185,129,0.08); }
    .ai-border { border-top: 4px solid #10B981; }
</style>
@endsection

@section('content')
<section class="app-page p-container-padding space-y-gutter">
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
                        <tr class="bg-white border-b border-outline-variant">
                            <th class="px-6 py-4 font-label-caps text-secondary">WAKTU</th>
                            <th class="px-6 py-4 font-label-caps text-secondary">TOTAL</th>
                            <th class="px-6 py-4 font-label-caps text-secondary">METODE</th>
                            <th class="px-6 py-4 font-label-caps text-secondary">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($transactions as $tx)
                        <tr class="hover:bg-white transition-colors">
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
</section>
@endsection
