@extends('admin.layout')

@section('title', 'Transaksi')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Transaksi</h1>
        <p class="text-sm text-gray-400 mt-1">Riwayat seluruh transaksi di platform</p>
    </div>
    <span class="px-3 py-1.5 bg-purple-50 text-purple-600 rounded-full text-xs font-bold">{{ $transactions->total() }} transaksi</span>
</div>

<!-- Search & Filter Bar -->
<div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
    <form method="GET" action="{{ route('admin.transactions') }}" class="flex flex-col gap-3">
        <div class="flex flex-col md:flex-row gap-3">
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama toko..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            </div>
            <select name="payment_method" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                <option value="">Semua Metode</option>
                <option value="tunai" {{ request('payment_method') === 'tunai' ? 'selected' : '' }}>Tunai</option>
                <option value="transfer" {{ request('payment_method') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}>QRIS</option>
                <option value="debit" {{ request('payment_method') === 'debit' ? 'selected' : '' }}>Debit</option>
            </select>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="flex items-center gap-2 flex-1">
                <span class="text-xs text-gray-400 shrink-0">Dari:</span>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                    class="flex-1 px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>
            <div class="flex items-center gap-2 flex-1">
                <span class="text-xs text-gray-400 shrink-0">Sampai:</span>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                    class="flex-1 px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl text-sm font-bold hover:shadow-lg hover:shadow-primary/25 transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->has('search') || request()->has('payment_method') || request()->has('date_from') || request()->has('date_to'))
                <a href="{{ route('admin.transactions') }}" class="px-4 py-2.5 border border-gray-200 text-gray-500 rounded-xl text-sm font-bold hover:bg-gray-50 transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                    Reset
                </a>
                @endif
            </div>
        </div>
    </form>
</div>

<!-- Desktop Table (hidden on mobile) -->
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-5 py-3">ID</th>
                    <th class="px-5 py-3">Toko</th>
                    <th class="px-5 py-3">Total</th>
                    <th class="px-5 py-3">Metode</th>
                    <th class="px-5 py-3">Tanggal</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($transactions as $tx)
                <tr>
                    <td class="px-5 py-3 text-sm text-gray-400 font-mono">#{{ $tx->id }}</td>
                    <td class="px-5 py-3">
                        <p class="text-sm font-bold text-gray-800">{{ $tx->shop?->name ?? '-' }}</p>
                        <p class="text-[10px] text-gray-400">{{ $tx->shop?->owner?->name ?? '' }}</p>
                    </td>
                    <td class="px-5 py-3 font-bold text-sm text-primary">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
                    <td class="px-5 py-3">
                        <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">{{ ucfirst($tx->payment_method ?? 'Tunai') }}</span>
                    </td>
                    <td class="px-5 py-3 text-xs text-gray-400">{{ $tx->created_at?->format('d M Y H:i') ?? '-' }}</td>
                    <td class="px-5 py-3 text-right">
                        <button class="w-8 h-8 rounded-lg border border-gray-200 inline-flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/30 transition-all" title="Detail" onclick="showTxDetail({{ $tx->id }}, '{{ $tx->shop?->name ?? '-' }}', '{{ number_format($tx->total_amount, 0, ',', '.') }}', '{{ ucfirst($tx->payment_method ?? 'Tunai') }}', '{{ $tx->created_at?->format('d M Y H:i') ?? '-' }}')">
                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-8 text-center text-gray-400">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Mobile Cards (visible only on mobile) -->
<div class="md:hidden space-y-3">
    @forelse($transactions as $tx)
    <div class="bg-white rounded-2xl border border-gray-100 p-4 card-hover">
        <div class="flex items-start justify-between mb-3">
            <div>
                <p class="text-xs text-gray-400 font-mono mb-0.5">#{{ $tx->id }}</p>
                <h3 class="font-bold text-sm text-gray-800">{{ $tx->shop?->name ?? '-' }}</h3>
                <p class="text-[10px] text-gray-400">{{ $tx->shop?->owner?->name ?? '' }}</p>
            </div>
            <div class="text-right">
                <p class="font-bold text-sm text-primary">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</p>
                <p class="text-[10px] text-gray-400 mt-0.5">{{ $tx->created_at?->format('d M Y H:i') ?? '-' }}</p>
            </div>
        </div>
        <div class="flex items-center justify-between pt-3 border-t border-gray-50">
            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">{{ ucfirst($tx->payment_method ?? 'Tunai') }}</span>
            <button class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 text-gray-600 rounded-lg text-xs font-bold hover:bg-gray-50 transition-colors"
                onclick="showTxDetail({{ $tx->id }}, '{{ $tx->shop?->name ?? '-' }}', '{{ number_format($tx->total_amount, 0, ',', '.') }}', '{{ ucfirst($tx->payment_method ?? 'Tunai') }}', '{{ $tx->created_at?->format('d M Y H:i') ?? '-' }}')">
                <span class="material-symbols-outlined text-[14px]">visibility</span>
                Detail
            </button>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center">
        <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">receipt_long</span>
        <p class="text-gray-400 text-sm">Belum ada transaksi.</p>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($transactions->hasPages())
<div class="mt-6">
    {{ $transactions->links() }}
</div>
@endif

<!-- Transaction Detail Modal -->
<div id="txModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/50 transition-opacity" onclick="closeTxModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 mx-4 animate-fade-in">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-extrabold text-gray-800">Detail Transaksi</h3>
            <button onclick="closeTxModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <div class="space-y-4">
            <div class="flex items-center justify-between py-2 border-b border-gray-50">
                <span class="text-xs text-gray-400 uppercase tracking-wider">ID Transaksi</span>
                <span class="text-sm font-mono font-bold text-gray-700" id="modalTxId">-</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-50">
                <span class="text-xs text-gray-400 uppercase tracking-wider">Toko</span>
                <span class="text-sm font-bold text-gray-700" id="modalTxShop">-</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-50">
                <span class="text-xs text-gray-400 uppercase tracking-wider">Total</span>
                <span class="text-sm font-bold text-primary" id="modalTxTotal">-</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-50">
                <span class="text-xs text-gray-400 uppercase tracking-wider">Metode Bayar</span>
                <span class="text-sm font-bold text-gray-700" id="modalTxMethod">-</span>
            </div>
            <div class="flex items-center justify-between py-2">
                <span class="text-xs text-gray-400 uppercase tracking-wider">Tanggal</span>
                <span class="text-sm font-bold text-gray-700" id="modalTxDate">-</span>
            </div>
        </div>
        <button onclick="closeTxModal()" class="w-full mt-5 px-4 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200 transition-colors">
            Tutup
        </button>
    </div>
</div>

<script>
function showTxDetail(id, shop, total, method, date) {
    document.getElementById('modalTxId').textContent = '#' + id;
    document.getElementById('modalTxShop').textContent = shop;
    document.getElementById('modalTxTotal').textContent = 'Rp ' + total;
    document.getElementById('modalTxMethod').textContent = method;
    document.getElementById('modalTxDate').textContent = date;
    document.getElementById('txModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeTxModal() {
    document.getElementById('txModal').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>
@endsection
