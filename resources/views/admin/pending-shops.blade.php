@extends('admin.layout')

@section('title', 'Validasi UMKM')

@section('content')
<!-- Header -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Validasi Pendaftaran UMKM</h1>
        <p class="text-sm text-gray-400 mt-1">Tinjau dan aktifkan pendaftaran toko UMKM baru</p>
    </div>
    <div class="flex items-center gap-2">
        <span class="px-3 py-1.5 bg-amber-50 text-amber-600 rounded-full text-xs font-bold flex items-center gap-1.5">
            <span class="w-2 h-2 bg-amber-400 rounded-full pulse-dot"></span>
            {{ $pendingCount }} Menunggu
        </span>
    </div>
</div>

@if(session('success'))
<div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 flex items-center gap-3 animate-fade-in">
    <span class="material-symbols-outlined text-emerald-500">check_circle</span>
    <p class="text-emerald-700 font-medium text-sm">{{ session('success') }}</p>
</div>
@endif

<!-- Validation List -->
<div class="space-y-4">
    @forelse($pendingUsers as $user)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden card-hover">
        <div class="p-5">
            <div class="flex flex-col lg:flex-row lg:items-center gap-5">
                <!-- User Info -->
                <div class="flex items-center gap-4 flex-1 min-w-0">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary/20 to-emerald-100 rounded-2xl flex items-center justify-center text-primary font-extrabold text-lg shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-gray-800 text-base">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        <p class="text-xs text-gray-300 mt-0.5">Daftar {{ $user->created_at->locale('id')->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Shop Info -->
                <div class="flex-1 min-w-0 lg:border-l lg:border-gray-100 lg:pl-5">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-primary text-[16px]">store</span>
                        <p class="font-bold text-gray-800 text-sm">{{ $user->shop->name ?? '-' }}</p>
                    </div>
                    <p class="text-xs text-gray-400 line-clamp-2">{{ $user->shop->address ?? 'Alamat tidak tersedia' }}</p>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-2 shrink-0">
                    <a href="mailto:{{ $user->email }}" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-50 transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">mail</span>
                        Email
                    </a>
                    <form method="POST" action="{{ route('admin.activate', $user->id) }}" onsubmit="return confirm('Aktifkan toko {{ $user->shop->name ?? $user->name }}?')">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl text-xs font-bold hover:shadow-lg hover:shadow-primary/25 hover:scale-[1.02] transition-all flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                            Aktifkan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Expanded Details -->
        <div class="border-t border-gray-50 bg-gray-50/50 px-5 py-3">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Owner</p>
                    <p class="text-xs font-bold text-gray-700 mt-0.5">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Email</p>
                    <p class="text-xs font-bold text-gray-700 mt-0.5 truncate">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Nama Toko</p>
                    <p class="text-xs font-bold text-gray-700 mt-0.5">{{ $user->shop->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Tanggal Daftar</p>
                    <p class="text-xs font-bold text-gray-700 mt-0.5">{{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    @empty
    <!-- Empty State -->
    <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
        <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-4xl text-emerald-400">check_circle</span>
        </div>
        <h3 class="text-lg font-bold text-gray-800 mb-2">Semua Terverifikasi! 🎉</h3>
        <p class="text-sm text-gray-400 max-w-sm mx-auto">Tidak ada pendaftaran UMKM yang menunggu validasi saat ini.</p>
    </div>
    @endforelse
</div>
@endsection
