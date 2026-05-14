@extends('admin.layout')

@section('title', 'Pengguna')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Pengguna</h1>
        <p class="text-sm text-gray-400 mt-1">Daftar seluruh pengguna platform</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-5 py-3">Pengguna</th>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3">Role</th>
                    <th class="px-5 py-3">Toko</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Tanggal</th>
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
                    <td class="px-5 py-3 text-xs text-gray-400">{{ $u->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-8 text-center text-gray-400">Belum ada pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
