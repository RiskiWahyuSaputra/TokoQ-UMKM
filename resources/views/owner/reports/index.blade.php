@extends('owner.layouts.app')

@section('title', 'Laporan - TokoQ')

@section('styles')
<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes barGrow {
    from { height: 0; }
}
. { animation: fadeInUp 0.5s ease-out forwards; }
. { animation: fadeInUp 0.5s ease-out 0.1s forwards; opacity: 0; }
. { animation: fadeInUp 0.5s ease-out 0.2s forwards; opacity: 0; }
. { animation: fadeInUp 0.5s ease-out 0.3s forwards; opacity: 0; }
.animate-bar-grow { animation: barGrow 0.8s ease-out forwards; }

.gradient-success { background: linear-gradient(135deg, #10B981 0%, #34D399 100%); }
.gradient-info { background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%); }
.gradient-warning { background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%); }
.gradient-purple { background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 100%); }

.card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.card-hover:hover { transform: translateY(-3px); box-shadow: 0 15px 30px -8px rgba(16, 185, 129, 0.12); }

.bar-item { transition: all 0.3s ease; }
.bar-item:hover { transform: scaleY(1.05); transform-origin: bottom; }
.chart-tooltip { opacity: 0; transition: opacity 0.2s; pointer-events: none; }
.bar-item:hover .chart-tooltip { opacity: 1; }

.scrollbar-thin::-webkit-scrollbar { width: 4px; }
.scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
.scrollbar-thin::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 10px; }
</style>
@endsection

@section('content')
@php
    $totalOmzet = $transactions->sum('net_amount');
    $totalTx = $transactions->count();
    $avgTx = $totalTx > 0 ? $totalOmzet / $totalTx : 0;
    $todayTx = $transactions->where('created_at', '>=', today())->count();
    $todayOmzet = $transactions->where('created_at', '>=', today())->sum('net_amount');
@endphp

<div class="p-4 lg:p-6 space-y-5">

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-success rounded-xl flex items-center justify-center shadow-lg shadow-success/20">
                    <span class="material-symbols-outlined text-white text-[20px]">account_balance_wallet</span>
                </div>
                <span class="text-xs text-gray-400">Keseluruhan</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Total Omzet</p>
        </div>
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-info rounded-xl flex items-center justify-center shadow-lg shadow-info/20">
                    <span class="material-symbols-outlined text-white text-[20px]">receipt_long</span>
                </div>
                <span class="text-xs text-gray-400">{{ $totalTx }} transaksi</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">{{ $totalTx }}</p>
            <p class="text-xs text-gray-400 mt-1">Total Transaksi</p>
        </div>
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple/20">
                    <span class="material-symbols-outlined text-white text-[20px]">analytics</span>
                </div>
                <span class="text-xs text-gray-400">Per transaksi</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">Rp {{ number_format($avgTx, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Rata-rata</p>
        </div>
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-warning rounded-xl flex items-center justify-center shadow-lg shadow-warning/20">
                    <span class="material-symbols-outlined text-white text-[20px]">today</span>
                </div>
                <span class="text-xs text-gray-400">{{ now()->locale('id')->format('l') }}</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">{{ $todayTx }}</p>
            <p class="text-xs text-gray-400 mt-1">Transaksi Hari Ini</p>
            <p class="text-xs text-emerald-500 font-medium mt-1">Rp {{ number_format($todayOmzet, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Period Filter & Export -->
    <div class="bg-white rounded-2xl border border-gray-200 p-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
            <div class="flex items-center gap-2 flex-1">
                <span class="material-symbols-outlined text-gray-400 text-[18px]">date_range</span>
                <select id="report-period" onchange="filterReport()" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary outline-none">
                    <option value="today">Hari Ini</option>
                    <option value="week" selected>Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="custom">Custom</option>
                </select>
                <input type="date" id="report-date-from" class="hidden px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary outline-none"/>
                <input type="date" id="report-date-to" class="hidden px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary outline-none"/>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="exportReportPDF()" class="inline-flex items-center gap-1.5 px-3 py-2 bg-red-50 text-red-600 rounded-lg text-xs font-bold hover:bg-red-100">
                    <span class="material-symbols-outlined text-[14px]">picture_as_pdf</span> PDF
                </button>
                <button onclick="exportReportExcel()" class="inline-flex items-center gap-1.5 px-3 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-bold hover:bg-emerald-100">
                    <span class="material-symbols-outlined text-[14px]">download</span> Excel
                </button>
                <button onclick="printDailyCash()" class="inline-flex items-center gap-1.5 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold hover:bg-blue-100">
                    <span class="material-symbols-outlined text-[14px]">print</span> Kas Harian
                </button>
            </div>
        </div>
    </div>

    <!-- Profit Summary -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 mb-1">Omzet (Kotor)</p>
            <p class="font-bold text-gray-800">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 mb-1">HPP / Modal</p>
            <p class="font-bold text-gray-800">Rp {{ number_format($totalHPP ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 mb-1">Laba Kotor</p>
            <p class="font-bold {{ ($totalOmzet - ($totalHPP ?? 0)) > 0 ? 'text-emerald-600' : 'text-red-600' }}">Rp {{ number_format($totalOmzet - ($totalHPP ?? 0), 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 mb-1">Margin</p>
            <p class="font-bold text-gray-800">{{ $totalOmzet > 0 ? round((($totalOmzet - ($totalHPP ?? 0)) / $totalOmzet) * 100, 1) : 0 }}%</p>
        </div>
    </div>

    <!-- Chart & Payment Method -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Revenue Chart -->
        <div class="col-span-12 lg:col-span-7">
            <div class="bg-white rounded-2xl border border-outline-variant p-6 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-on-surface">Tren Omzet 7 Hari</h3>
                        <p class="text-xs text-gray-400">Pantau naik turun pemasukan harian</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-primary"></span>
                        <span class="text-xs text-gray-400">Omzet</span>
                    </div>
                </div>
                @php $maxRevenue = max($dailyRevenue->max('total') ?? 0, 1); @endphp
                <div class="h-52 flex items-end gap-3">
                    @foreach ($dailyRevenue as $day)
                        @php
                            $height = max(12, ($day['total'] / $maxRevenue) * 100);
                            $isToday = $day['label'] === now()->locale('id')->dayName;
                        @endphp
                        <div class="flex-1 flex flex-col items-center gap-2 bar-item relative group cursor-pointer">
                            <div class="chart-tooltip absolute -top-10 left-1/2 -translate-x-1/2 bg-text-dark text-white text-xs px-2.5 py-1 rounded-lg whitespace-nowrap z-10">
                                Rp {{ number_format($day['total'], 0, ',', '.') }}
                            </div>
                            <div class="w-full rounded-t-xl animate-bar-grow overflow-hidden {{ $isToday ? 'bg-gradient-to-t from-primary to-emerald-400' : 'bg-gradient-to-t from-emerald-100 to-emerald-50 group-hover:from-emerald-200 group-hover:to-emerald-100' }}"
                                style="height: {{ $height }}%; min-height: 8px;">
                            </div>
                            <div class="text-center">
                                <p class="text-[10px] {{ $isToday ? 'text-primary font-bold' : 'text-gray-400' }}">{{ $day['label'] }}</p>
                                <p class="text-[9px] text-gray-300">{{ $day['full_date'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="col-span-12 lg:col-span-5">
            <div class="bg-white rounded-2xl border border-outline-variant p-5 h-full">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-500 text-[20px]">account_balance_wallet</span>
                    </div>
                    <h3 class="font-bold text-on-surface">Metode Pembayaran</h3>
                </div>
                @forelse ($paymentSummary as $payment)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                        <div class="flex items-center gap-3">
                            @php
                                $pmIcon = match(strtolower($payment['method'])) {
                                    'tunai' => 'payments',
                                    'qris' => 'qr_code',
                                    default => 'credit_card',
                                };
                                $pmColor = match(strtolower($payment['method'])) {
                                    'tunai' => 'bg-emerald-100 text-emerald-500',
                                    'qris' => 'bg-blue-100 text-blue-500',
                                    default => 'bg-purple-100 text-purple-500',
                                };
                            @endphp
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $pmColor }}">
                                <span class="material-symbols-outlined text-[16px]">{{ $pmIcon }}</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm text-on-surface">{{ $payment['method'] }}</p>
                                <p class="text-xs text-gray-400">{{ $payment['count'] }} transaksi</p>
                            </div>
                        </div>
                        <p class="font-bold text-sm text-primary">Rp {{ number_format($payment['total'], 0, ',', '.') }}</p>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="material-symbols-outlined text-3xl text-gray-200">payments</span>
                        </div>
                        <p class="text-sm text-gray-400">Belum ada data pembayaran</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Top Products & Transactions -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Top Products -->
        <div class="col-span-12 lg:col-span-5">
            <div class="bg-white rounded-2xl border border-outline-variant p-5 h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-amber-500 text-[20px]">emoji_events</span>
                        </div>
                        <h3 class="font-bold text-on-surface">Produk Terlaris</h3>
                    </div>
                    <div class="flex bg-gray-100 rounded-lg p-0.5">
                        <button onclick="toggleTopView('sold')" id="btn-view-sold" class="px-2 py-1 rounded-md text-[10px] font-bold bg-white text-gray-800 shadow-sm">Terlaris</button>
                        <button onclick="toggleTopView('profit')" id="btn-view-profit" class="px-2 py-1 rounded-md text-[10px] font-bold text-gray-500">Tertinggi Laba</button>
                    </div>
                </div>
                @forelse ($topProducts as $product)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="w-7 h-7 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-xs font-bold shrink-0">★</span>
                            <div class="min-w-0">
                                <p class="font-bold text-sm text-on-surface truncate">{{ $product->name }}</p>
                                <p class="text-xs text-gray-400">{{ number_format($product->total_sold) }} item</p>
                            </div>
                        </div>
                        <p class="font-bold text-primary text-sm shrink-0">Rp {{ number_format($product->revenue, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <span class="material-symbols-outlined text-3xl text-gray-200 block mb-2">inventory</span>
                        <p class="text-sm text-gray-400">Belum ada produk terjual</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="col-span-12 lg:col-span-7">
            <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden">
                <div class="p-5 border-b border-outline-variant flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-500 text-[20px]">receipt</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface">Transaksi Terbaru</h3>
                            <p class="text-xs text-gray-400">{{ $totalTx }} transaksi tercatat</p>
                        </div>
                    </div>
                    <a href="{{ route('sales.index') }}" class="text-primary font-bold text-xs hover:underline">Lihat Semua →</a>
                </div>
                @if ($transactions->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="material-symbols-outlined text-3xl text-gray-200">receipt_long</span>
                        </div>
                        <p class="font-bold text-on-surface mb-1">Belum Ada Transaksi</p>
                        <p class="text-sm text-gray-400 mb-3">Mulai berjualan dari Kasir POS.</p>
                        <a href="{{ route('pos.index') }}" class="inline-flex items-center gap-1.5 text-primary font-bold text-sm">
                            <span class="material-symbols-outlined text-[16px]">point_of_sale</span>
                            Buka Kasir
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto scrollbar-thin">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                                <tr>
                                    <th class="px-5 py-3">Tanggal</th>
                                    <th class="px-5 py-3">Metode</th>
                                    <th class="px-5 py-3">Diskon</th>
                                    <th class="px-5 py-3 text-right">Net</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($transactions->take(12) as $transaction)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-5 py-3">
                                            <p class="font-medium text-sm text-on-surface">{{ $transaction->created_at->format('d M Y') }}</p>
                                            <p class="text-xs text-gray-400">{{ $transaction->created_at->format('H:i') }}</p>
                                        </td>
                                        <td class="px-5 py-3">
                                            @php
                                                $pmIcon = match(strtolower($transaction->payment_method ?? 'tunai')) {
                                                    'tunai' => 'payments',
                                                    'qris' => 'qr_code',
                                                    default => 'credit_card',
                                                };
                                            @endphp
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-gray-100 text-xs font-bold">
                                                <span class="material-symbols-outlined text-[12px]">{{ $pmIcon }}</span>
                                                {{ strtoupper($transaction->payment_method ?? 'Tunai') }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3 text-sm text-gray-400">Rp {{ number_format($transaction->discount_amount ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-5 py-3 text-right font-bold text-primary text-sm">Rp {{ number_format($transaction->net_amount ?? $transaction->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="pb-4 flex flex-col sm:flex-row justify-between items-center gap-2">
        <p class="text-xs text-gray-500">&copy; 2025 TokoQ. All rights reserved.</p>
    </footer>
</div>

<script>
function filterReport() {
    const period = document.getElementById('report-period').value;
    const fromEl = document.getElementById('report-date-from');
    const toEl = document.getElementById('report-date-to');
    if (period === 'custom') {
        fromEl.classList.remove('hidden');
        toEl.classList.remove('hidden');
    } else {
        fromEl.classList.add('hidden');
        toEl.classList.add('hidden');
    }
    alert('Filter ' + period + ' akan segera tersedia.');
}
function exportReportPDF() { alert('Export PDF laporan akan segera tersedia.'); }
function exportReportExcel() { alert('Export Excel laporan akan segera tersedia.'); }
function printDailyCash() { alert('Laporan kas harian akan segera tersedia.'); }
function toggleTopView(view) {
    const soldBtn = document.getElementById('btn-view-sold');
    const profitBtn = document.getElementById('btn-view-profit');
    if (view === 'sold') {
        soldBtn.className = 'px-2 py-1 rounded-md text-[10px] font-bold bg-white text-gray-800 shadow-sm';
        profitBtn.className = 'px-2 py-1 rounded-md text-[10px] font-bold text-gray-500';
    } else {
        profitBtn.className = 'px-2 py-1 rounded-md text-[10px] font-bold bg-white text-gray-800 shadow-sm';
        soldBtn.className = 'px-2 py-1 rounded-md text-[10px] font-bold text-gray-500';
    }
}
</script>
@endsection
