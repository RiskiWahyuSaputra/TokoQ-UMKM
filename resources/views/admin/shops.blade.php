@extends('admin.layout')

@section('title', 'Semua Toko')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Semua Toko</h1>
        <p class="text-sm text-gray-400 mt-1">Daftar seluruh toko yang terdaftar di platform</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-5 py-3">Toko</th>
                    <th class="px-5 py-3">Owner</th>
                    <th class="px-5 py-3">Alamat</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($shops as $shop)
                <tr>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-gradient-to-br from-primary/20 to-emerald-100 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-[16px]">store</span>
                            </div>
                            <span class="font-bold text-sm text-gray-800">{{ $shop->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3">
                        <p class="text-sm text-gray-700">{{ $shop->owner?->name ?? '-' }}</p>
                        <p class="text-[10px] text-gray-400">{{ $shop->owner?->email ?? '' }}</p>
                    </td>
                    <td class="px-5 py-3 text-sm text-gray-500 max-w-[200px] truncate">{{ $shop->address ?? '-' }}</td>
                    <td class="px-5 py-3">
                        @if($shop->owner?->status === 'active')
                            <span class="px-2.5 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs font-bold">Aktif</span>
                        @else
                            <span class="px-2.5 py-1 bg-amber-100 text-amber-600 rounded-full text-xs font-bold">Pending</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-xs text-gray-400">{{ $shop->created_at?->format('d M Y') ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-8 text-center text-gray-400">Belum ada toko terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($shops->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $shops->links() }}
    </div>
    @endif
</div>
@endsection
