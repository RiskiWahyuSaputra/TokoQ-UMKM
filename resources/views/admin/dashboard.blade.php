@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#40521d]">Dashboard Admin</h1>
    <p class="text-gray-600 mt-2">Kelola validasi UMKM dan laporan toko</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-3xl shadow-lg p-6 border border-[#dde3d2]">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Pending Validasi</p>
                <p class="text-3xl font-bold text-[#576b33] mt-2">{{ $pendingCount }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-2xl">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-6 border border-[#dde3d2]">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Toko Aktif</p>
                <p class="text-3xl font-bold text-[#576b33] mt-2">{{ $activeCount }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-2xl">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-6 border border-[#dde3d2]">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Total Toko</p>
                <p class="text-3xl font-bold text-[#576b33] mt-2">{{ $totalShops }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-2xl">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Pending Shops -->
<div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-[#dde3d2]">
    <div class="px-8 py-6 border-b border-[#dde3d2]">
        <h2 class="text-xl font-bold text-[#40521d]">Pendaftaran Terbaru</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#f2f5e4] text-[#45483d] font-bold uppercase text-sm">
                <tr>
                    <th class="px-8 py-4">Nama Owner</th>
                    <th class="px-8 py-4">Email</th>
                    <th class="px-8 py-4">Nama Toko</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#dde3d2]">
                @forelse($recentShops as $user)
                <tr>
                    <td class="px-8 py-4">{{ $user->name }}</td>
                    <td class="px-8 py-4">{{ $user->email }}</td>
                    <td class="px-8 py-4">{{ $user->shop->name ?? '-' }}</td>
                    <td class="px-8 py-4">
                        @if($user->status === 'pending')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Pending</span>
                        @else
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Aktif</span>
                        @endif
                    </td>
                    <td class="px-8 py-4">
                        @if($user->status === 'pending')
                            <form method="POST" action="{{ route('admin.activate', $user->id) }}">
                                @csrf
                                <button type="submit" class="bg-[#576b33] text-white px-4 py-2 rounded-xl font-bold hover:bg-[#40521d] transition-colors">
                                    Aktifkan
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm">Sudah aktif</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-8 text-center text-gray-500 italic">Tidak ada data toko.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
