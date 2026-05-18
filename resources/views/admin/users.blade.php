@extends('admin.layout')

@section('title', 'Pengguna')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Pengguna</h1>
        <p class="text-sm text-gray-400 mt-1">Daftar seluruh pengguna platform</p>
    </div>
    <span class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-full text-xs font-bold">{{ $users->total() }} pengguna</span>
</div>

<!-- Search & Filter Bar -->
<div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
    <form method="GET" action="{{ route('admin.users') }}" class="flex flex-col lg:flex-row gap-3">
        <div class="flex-1 relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
        </div>
        <div class="flex gap-3 flex-wrap">
            <select name="role" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ request('role') === 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
            <select name="status" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl text-sm font-bold hover:shadow-lg hover:shadow-primary/25 transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                Filter
            </button>
            @if(request()->has('search') || request()->has('role') || request()->has('status'))
            <a href="{{ route('admin.users') }}" class="px-4 py-2.5 border border-gray-200 text-gray-500 rounded-xl text-sm font-bold hover:bg-gray-50 transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">close</span>
                Reset
            </a>
            @endif
        </div>
    </form>
</div>

<!-- Desktop Table (hidden on mobile) -->
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-5 py-3">Pengguna</th>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3">Role</th>
                    <th class="px-5 py-3">Toko</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 hidden lg:table-cell">Login Terakhir</th>
                    <th class="px-5 py-3">Tanggal</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($users as $u)
                <tr>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-gradient-to-br from-primary/20 to-emerald-100 rounded-lg flex items-center justify-center text-primary font-bold text-xs">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <span class="font-bold text-sm text-gray-800">{{ $u->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-sm text-gray-500">{{ $u->email }}</td>
                    <td class="px-5 py-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $u->role === 'admin' ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                            {{ ucfirst($u->role) }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-sm text-gray-500">{{ $u->shop?->name ?? '-' }}</td>
                    <td class="px-5 py-3">
                        @if($u->status === 'active')
                            <span class="px-2.5 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs font-bold">Aktif</span>
                        @elseif($u->status === 'pending')
                            <span class="px-2.5 py-1 bg-amber-100 text-amber-600 rounded-full text-xs font-bold">Pending</span>
                        @else
                            <span class="px-2.5 py-1 bg-red-100 text-red-600 rounded-full text-xs font-bold">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-xs text-gray-400 hidden lg:table-cell">{{ $u->last_login_at?->locale('id')->diffForHumans() ?? 'Belum login' }}</td>
                    <td class="px-5 py-3 text-xs text-gray-400">{{ $u->created_at->format('d M Y') }}</td>
                    <td class="px-5 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="mailto:{{ $u->email }}" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/30 transition-all" title="Email">
                                <span class="material-symbols-outlined text-[16px]">mail</span>
                            </a>
                            @if($u->status === 'active')
                            <form method="POST" action="{{ route('admin.users.suspend', $u->id) }}" onsubmit="return confirm('Nonaktifkan {{ $u->name }}?')">
                                @csrf
                                <button type="submit" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-200 transition-all" title="Nonaktifkan">
                                    <span class="material-symbols-outlined text-[16px]">block</span>
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('admin.users.activate', $u->id) }}" onsubmit="return confirm('Aktifkan {{ $u->name }}?')">
                                @csrf
                                <button type="submit" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-emerald-500 hover:border-emerald-200 transition-all" title="Aktifkan">
                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-8 text-center text-gray-400">Belum ada pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Mobile Cards (visible only on mobile) -->
<div class="md:hidden space-y-3">
    @forelse($users as $u)
    <div class="bg-white rounded-2xl border border-gray-100 p-4 card-hover">
        <div class="flex items-start justify-between mb-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-primary/20 to-emerald-100 rounded-lg flex items-center justify-center text-primary font-bold text-sm">
                    {{ strtoupper(substr($u->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-bold text-sm text-gray-800">{{ $u->name }}</h3>
                    <p class="text-[10px] text-gray-400">{{ $u->email }}</p>
                </div>
            </div>
            @if($u->status === 'active')
                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs font-bold">Aktif</span>
            @elseif($u->status === 'pending')
                <span class="px-2.5 py-1 bg-amber-100 text-amber-600 rounded-full text-xs font-bold">Pending</span>
            @else
                <span class="px-2.5 py-1 bg-red-100 text-red-600 rounded-full text-xs font-bold">Nonaktif</span>
            @endif
        </div>
        <div class="flex items-center gap-2 mb-3 flex-wrap">
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $u->role === 'admin' ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                {{ ucfirst($u->role) }}
            </span>
            @if($u->shop)
            <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full text-[10px] font-bold flex items-center gap-1">
                <span class="material-symbols-outlined text-[10px]">store</span>
                {{ $u->shop->name }}
            </span>
            @endif
            <span class="text-[10px] text-gray-400 ml-auto">{{ $u->created_at->format('d M Y') }}</span>
        </div>
        @if($u->last_login_at)
        <div class="flex items-center gap-1 mb-2">
            <span class="material-symbols-outlined text-gray-300 text-[12px]">login</span>
            <span class="text-[10px] text-gray-400">Login terakhir: {{ $u->last_login_at->locale('id')->diffForHumans() }}</span>
        </div>
        @endif
        <div class="flex items-center gap-2 pt-3 border-t border-gray-50">
            <a href="mailto:{{ $u->email }}" class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 border border-gray-200 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-50 transition-colors">
                <span class="material-symbols-outlined text-[14px]">mail</span>
                Email
            </a>
            @if($u->status === 'active')
            <form method="POST" action="{{ route('admin.users.suspend', $u->id) }}" onsubmit="return confirm('Nonaktifkan {{ $u->name }}?')" class="flex-1">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-1.5 px-3 py-2 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 transition-colors">
                    <span class="material-symbols-outlined text-[14px]">block</span>
                    Nonaktifkan
                </button>
            </form>
            @else
            <form method="POST" action="{{ route('admin.users.activate', $u->id) }}" onsubmit="return confirm('Aktifkan {{ $u->name }}?')" class="flex-1">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-1.5 px-3 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-xs font-bold hover:bg-emerald-100 transition-colors">
                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                    Aktifkan
                </button>
            </form>
            @endif
        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center">
        <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">group</span>
        <p class="text-gray-400 text-sm">Belum ada pengguna.</p>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($users->hasPages())
<div class="mt-6">
    {{ $users->links() }}
</div>
@endif
@endsection
