@extends('admin.layout')

@section('title', 'Transaksi')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Transaksi</h1>
        <p class="text-sm text-gray-400 mt-1">Riwayat seluruh transaksi di platform</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-5 py-3">ID</th>
                    <th class="px-5 py-3">Toko</th>
                    <th class="px-5 py-3">Total</th>
                    <th class="px-5 py-3">Metode</th>
                    <th class="px-5 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($transactions as $tx)
                <tr>
                    <td class="px-5 py-3 text-sm text-gray-400 font-mono">#{{ $tx->id }}</td>
                    <td class="px-5 py-3">
                        <p class="text-sm font-bold text-gray-800">{{ $tx->shop?->name ?? '-' }}</p>
                        <p class="text-[10px] text-gray-400">{{ $tx->user?->name ?? '' }}</p>
                    </td>
                    <td class="px-5 py-3 font-bold text-sm text-primary">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
                    <td class="px-5 py-3">
                        <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">{{ ucfirst($tx->payment_method ?? 'Tunai') }}</span>
                    </td>
                    <td class="px-5 py-3 text-xs text-gray-400">{{ $tx->created_at?->format('d M Y H:i') ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-8 text-center text-gray-400">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($transactions->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $transactions->links() }}
    </div>
    @endif
</div>
@endsection
