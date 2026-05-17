@extends('owner.layouts.app')

@section('title', 'Penjualan - TokoQ')

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
    $totalTransactions = $transactions->count();
    $totalOmzet = $transactions->sum('total_amount');
    $avgTransaction = $totalTransactions > 0 ? $totalOmzet / $totalTransactions : 0;
    $todayCount = $transactions->where('created_at', '>=', today())->count();
    $todayOmzet = $transactions->where('created_at', '>=', today())->sum('total_amount');
    $yesterdayCount = $transactions->where('created_at', '>=', today()->subDay()->startOfDay())->where('created_at', '<', today())->count();
    $growthPercent = $yesterdayCount > 0 ? round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100) : ($todayCount > 0 ? 100 : 0);
@endphp

<div class="p-4 lg:p-6 space-y-5">

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <!-- Total Transaksi -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-info rounded-xl flex items-center justify-center shadow-lg shadow-info/20">
                    <span class="material-symbols-outlined text-white text-[20px]">receipt_long</span>
                </div>
                @if($growthPercent != 0)
                    <span class="flex items-center gap-0.5 text-xs font-bold {{ $growthPercent > 0 ? 'text-emerald-500' : 'text-red-500' }}">
                        <span class="material-symbols-outlined text-[14px]">{{ $growthPercent > 0 ? 'trending_up' : 'trending_down' }}</span>
                        {{ abs($growthPercent) }}%
                    </span>
                @endif
            </div>
            <p class="text-2xl font-extrabold text-on-surface">{{ $totalTransactions }}</p>
            <p class="text-xs text-gray-400 mt-1">Total Transaksi</p>
            <p class="text-xs text-emerald-500 font-medium mt-2">{{ $todayCount }} transaksi hari ini</p>
        </div>

        <!-- Total Omzet -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-success rounded-xl flex items-center justify-center shadow-lg shadow-success/20">
                    <span class="material-symbols-outlined text-white text-[20px]">payments</span>
                </div>
                <span class="text-xs text-gray-400">Keseluruhan</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Total Omzet</p>
            <p class="text-xs text-emerald-500 font-medium mt-2">Rp {{ number_format($todayOmzet, 0, ',', '.') }} hari ini</p>
        </div>

        <!-- Rata-rata -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple/20">
                    <span class="material-symbols-outlined text-white text-[20px]">analytics</span>
                </div>
                <span class="text-xs text-gray-400">Per transaksi</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">Rp {{ number_format($avgTransaction, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Rata-rata Transaksi</p>
            <p class="text-xs text-purple-500 font-medium mt-2">{{ $totalTransactions }} transaksi tercatat</p>
        </div>

        <!-- Hari Ini -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-warning rounded-xl flex items-center justify-center shadow-lg shadow-warning/20">
                    <span class="material-symbols-outlined text-white text-[20px]">today</span>
                </div>
                <span class="text-xs text-gray-400">{{ now()->locale('id')->format('l') }}</span>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">{{ $todayCount }}</p>
            <p class="text-xs text-gray-400 mt-1">Transaksi Hari Ini</p>
            <p class="text-xs text-amber-500 font-medium mt-2">Rp {{ number_format($todayOmzet, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Chart & Payment Method Row -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Sales Chart -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-2xl border border-outline-variant p-6 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-on-surface">Tren Penjualan</h3>
                        <p class="text-xs text-gray-400">7 hari terakhir</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-primary"></span>
                        <span class="text-xs text-gray-400">Jumlah Transaksi</span>
                    </div>
                </div>
                @php
                    $days = collect(range(6, 0))->map(fn($i) => now()->subDays($i));
                    $maxVal = 1;
                @endphp
                <div class="h-52 flex items-end gap-3">
                    @foreach($days as $day)
                        @php
                            $count = $transactions->where('created_at', '>=', $day->startOfDay()->copy())->where('created_at', '<=', $day->endOfDay()->copy())->count();
                            $height = $maxVal > 0 ? max(8, ($count / max($maxVal, 1)) * 100) : 8;
                            $isToday = $day->isToday();
                        @endphp
                        <div class="flex-1 flex flex-col items-center gap-2 bar-item relative group cursor-pointer">
                            <div class="chart-tooltip absolute -top-10 left-1/2 -translate-x-1/2 bg-text-dark text-white text-xs px-2.5 py-1 rounded-lg whitespace-nowrap z-10">
                                {{ $count }} transaksi
                            </div>
                            <div class="w-full rounded-t-lg animate-bar-grow {{ $isToday ? 'bg-gradient-to-t from-primary to-emerald-400' : 'bg-gradient-to-t from-emerald-100 to-emerald-50 group-hover:from-emerald-200 group-hover:to-emerald-100' }}"
                                style="height: {{ $height }}%">
                            </div>
                            <span class="text-[10px] {{ $isToday ? 'text-primary font-bold' : 'text-gray-400' }}">{{ $day->format('D') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Payment Method Breakdown -->
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white rounded-2xl border border-outline-variant p-6 h-full">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-500 text-[20px]">account_balance_wallet</span>
                    </div>
                    <h3 class="font-bold text-on-surface">Metode Pembayaran</h3>
                </div>

                @php
                    $paymentMethods = $transactions->groupBy('payment_method')->map(function($group) {
                        return [
                            'method' => $group->first()->payment_method ?? 'Tunai',
                            'count' => $group->count(),
                            'total' => $group->sum('total_amount'),
                        ];
                    })->values();
                @endphp

                @if($paymentMethods->isEmpty())
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-3xl text-gray-200 block mb-2">payments</span>
                        <p class="text-sm text-gray-400">Belum ada data pembayaran</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($paymentMethods as $payment)
                            @php
                                $icon = match(strtolower($payment['method'])) {
                                    'tunai' => 'payments',
                                    'qris' => 'qr_code',
                                    'e-wallet', 'ewallet' => 'account_balance_wallet',
                                    'dana' => 'account_balance_wallet',
                                    'gopay' => 'account_balance_wallet',
                                    'ovo' => 'account_balance_wallet',
                                    default => 'credit_card',
                                };
                                $color = match(strtolower($payment['method'])) {
                                    'tunai' => 'bg-emerald-100 text-emerald-500',
                                    'qris' => 'bg-blue-100 text-blue-500',
                                    'e-wallet', 'ewallet' => 'bg-purple-100 text-purple-500',
                                    'dana' => 'bg-blue-100 text-blue-500',
                                    'gopay' => 'bg-green-100 text-green-500',
                                    'ovo' => 'bg-purple-100 text-purple-500',
                                    default => 'bg-gray-100 text-gray-500',
                                };
                                $percent = $totalOmzet > 0 ? round(($payment['total'] / $totalOmzet) * 100) : 0;
                            @endphp
                            <div class="p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg flex items-center justify-center {{ $color }}">
                                            <span class="material-symbols-outlined text-[16px]">{{ $icon }}</span>
                                        </div>
                                        <span class="font-bold text-sm text-on-surface">{{ ucfirst($payment['method']) }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $payment['count'] }}×</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden mr-3">
                                        <div class="h-full bg-primary rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-primary">Rp {{ number_format($payment['total'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Filter & Export Bar -->
    <div class="bg-white rounded-2xl border border-outline-variant p-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
            <div class="flex items-center gap-2 flex-1">
                <span class="material-symbols-outlined text-gray-400 text-[18px]">filter_list</span>
                <input type="date" id="filter-date-from" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary outline-none" placeholder="Dari"/>
                <span class="text-gray-400 text-xs">—</span>
                <input type="date" id="filter-date-to" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary outline-none" placeholder="Sampai"/>
                <button onclick="filterTransactions()" class="px-3 py-2 bg-primary text-white rounded-lg text-xs font-bold">Filter</button>
                <button onclick="resetFilter()" class="px-3 py-2 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium">Reset</button>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="exportExcel()" class="inline-flex items-center gap-1.5 px-3 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-bold hover:bg-emerald-100 transition-colors">
                    <span class="material-symbols-outlined text-[14px]">download</span> Excel
                </button>
                <button onclick="exportPDF()" class="inline-flex items-center gap-1.5 px-3 py-2 bg-red-50 text-red-600 rounded-lg text-xs font-bold hover:bg-red-100 transition-colors">
                    <span class="material-symbols-outlined text-[14px]">picture_as_pdf</span> PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Payment Summary -->
    <div class="grid grid-cols-3 gap-3">
        @php
            $tunaiTotal = $transactions->where('payment_method', 'tunai')->sum('total_amount');
            $qrisTotal = $transactions->where('payment_method', 'qris')->sum('total_amount');
            $ewalletTotal = $transactions->whereNotIn('payment_method', ['tunai', 'qris'])->sum('total_amount');
        @endphp
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-emerald-500 text-[16px]">payments</span>
                <span class="text-xs text-gray-500">Tunai</span>
            </div>
            <p class="font-bold text-gray-800">Rp {{ number_format($tunaiTotal, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-blue-500 text-[16px]">qr_code</span>
                <span class="text-xs text-gray-500">QRIS</span>
            </div>
            <p class="font-bold text-gray-800">Rp {{ number_format($qrisTotal, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-purple-500 text-[16px]">account_balance_wallet</span>
                <span class="text-xs text-gray-500">E-Wallet</span>
            </div>
            <p class="font-bold text-gray-800">Rp {{ number_format($ewalletTotal, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden">
        <div class="p-5 border-b border-outline-variant flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-500 text-[20px]">receipt</span>
                </div>
                <div>
                    <h3 class="font-bold text-on-surface">Riwayat Transaksi</h3>
                    <p class="text-xs text-gray-400">{{ $totalTransactions }} transaksi tercatat</p>
                </div>
            </div>
            <a href="{{ route('pos.index') }}" class="px-4 py-2 bg-primary text-white rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-primary-dark transition-colors self-start sm:self-auto">
                <span class="material-symbols-outlined text-[16px]">add</span>
                Transaksi Baru
            </a>
        </div>

        @if($transactions->isEmpty())
            <div class="p-12 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-4xl text-gray-200">receipt_long</span>
                </div>
                <h4 class="font-bold text-on-surface mb-1">Belum Ada Transaksi</h4>
                <p class="text-sm text-gray-400 mb-4">Mulai berjualan dari Kasir POS untuk melihat riwayat transaksi di sini.</p>
                <a href="{{ route('pos.index') }}" class="inline-flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-bold text-sm">
                    <span class="material-symbols-outlined text-[18px]">point_of_sale</span>
                    Buka Kasir POS
                </a>
            </div>
        @else
            <div class="overflow-x-auto scrollbar-thin">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                        <tr>
                            <th class="px-5 py-3">Waktu</th>
                            <th class="px-5 py-3 hidden sm:table-cell">Pelanggan</th>
                            <th class="px-5 py-3">Total</th>
                            <th class="px-5 py-3">Metode</th>
                            <th class="px-5 py-3 hidden sm:table-cell">Kasir</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transactions as $tx)
                        <tr class="hover:bg-gray-50 transition-colors transaction-row" data-date="{{ $tx->created_at->format('Y-m-d') }}">
                            <td class="px-5 py-3">
                                <p class="font-medium text-sm text-on-surface">{{ $tx->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-400">{{ $tx->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-600 hidden sm:table-cell">{{ $tx->customer_name ?? '-' }}</td>
                            <td class="px-5 py-3 font-bold text-primary">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $pmIcon = match(strtolower($tx->payment_method ?? 'tunai')) {
                                        'tunai' => 'payments',
                                        'qris' => 'qr_code',
                                        default => 'account_balance_wallet',
                                    };
                                    $pmColor = match(strtolower($tx->payment_method ?? 'tunai')) {
                                        'tunai' => 'bg-emerald-100 text-emerald-600',
                                        'qris' => 'bg-blue-100 text-blue-600',
                                        default => 'bg-purple-100 text-purple-600',
                                    };
                                    $statusClass = ($tx->status ?? 'completed') === 'refunded' ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600';
                                    $statusLabel = ($tx->status ?? 'completed') === 'refunded' ? 'Refund' : 'Selesai';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold {{ $pmColor }}">
                                    <span class="material-symbols-outlined text-[14px]">{{ $pmIcon }}</span>
                                    {{ ucfirst($tx->payment_method ?? 'Tunai') }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-500 hidden sm:table-cell">{{ $tx->user?->name ?? 'Kasir' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ ($tx->status ?? 'completed') === 'refunded' ? 'bg-red-500' : 'bg-emerald-500' }}"></span>
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button onclick="showTxDetail({{ $tx->id }}, '{{ $tx->created_at->format('d M Y H:i') }}', {{ $tx->total_amount }}, '{{ $tx->payment_method }}', '{{ $tx->customer_name ?? '' }}')" class="px-2 py-1 rounded-lg bg-gray-100 text-gray-600 text-xs font-bold hover:bg-gray-200" title="Detail">
                                        <span class="material-symbols-outlined text-[14px]">visibility</span>
                                    </button>
                                    @if(($tx->status ?? 'completed') !== 'refunded')
                                    <button onclick="refundTx({{ $tx->id }}, '{{ $tx->name ?? 'Transaksi' }}')" class="px-2 py-1 rounded-lg bg-red-50 text-red-500 text-xs font-bold hover:bg-red-100" title="Refund">
                                        <span class="material-symbols-outlined text-[14px]">undo</span>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="pb-4 flex flex-col sm:flex-row justify-between items-center gap-2">
        <p class="text-xs text-gray-500">&copy; 2025 TokoQ. All rights reserved.</p>
    </footer>
</div>

<!-- Transaction Detail Modal -->
<div id="tx-detail-modal" class="hidden fixed inset-0 z-[80]">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeTxDetail()"></div>
    <div class="relative min-h-full flex items-end sm:items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl p-6 animate-bounce-in">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-800">Detail Transaksi</h3>
                <button onclick="closeTxDetail()" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center"><span class="material-symbols-outlined text-gray-500 text-[18px]">close</span></button>
            </div>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Waktu</span><span class="font-medium" id="detail-time">-</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Pelanggan</span><span class="font-medium" id="detail-customer">-</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Metode</span><span class="font-medium" id="detail-method">-</span></div>
                <div class="flex justify-between border-t border-gray-100 pt-3"><span class="font-bold text-gray-800">Total</span><span class="font-bold text-primary" id="detail-total">-</span></div>
            </div>
            <button onclick="closeTxDetail()" class="w-full mt-4 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl text-sm">Tutup</button>
        </div>
    </div>
</div>

<script>
function filterTransactions() {
    const from = document.getElementById('filter-date-from').value;
    const to = document.getElementById('filter-date-to').value;
    document.querySelectorAll('.transaction-row').forEach(row => {
        const date = row.dataset.date;
        let show = true;
        if (from && date < from) show = false;
        if (to && date > to) show = false;
        row.style.display = show ? '' : 'none';
    });
}
function resetFilter() {
    document.getElementById('filter-date-from').value = '';
    document.getElementById('filter-date-to').value = '';
    document.querySelectorAll('.transaction-row').forEach(row => row.style.display = '');
}
function exportExcel() {
    alert('Export Excel akan segera tersedia. Data: {{ $totalTransactions }} transaksi.');
}
function exportPDF() {
    alert('Export PDF akan segera tersedia. Data: {{ $totalTransactions }} transaksi.');
}
function showTxDetail(id, time, total, method, customer) {
    document.getElementById('detail-time').textContent = time;
    document.getElementById('detail-customer').textContent = customer || '-';
    document.getElementById('detail-method').textContent = method;
    document.getElementById('detail-total').textContent = 'Rp ' + Number(total).toLocaleString('id-ID');
    document.getElementById('tx-detail-modal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}
function closeTxDetail() {
    document.getElementById('tx-detail-modal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}
function refundTx(id, name) {
    if (confirm('Refund transaksi "' + name + '"? Stok akan dikembalikan.')) {
        alert('Refund untuk transaksi #' + id + ' akan segera diproses.');
    }
}
</script>
@endsection
