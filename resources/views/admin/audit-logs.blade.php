@extends('admin.layout')

@section('title', 'Log Audit')

@section('content')
<div class="mb-6">
    <h1 class="text-xl font-bold text-gray-800">Log Audit</h1>
    <p class="text-sm text-gray-500">Riwayat aktivitas admin pada sistem</p>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
    <form method="GET" action="{{ route('admin.audit-logs') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Aksi</label>
            <select name="action" class="w-full rounded-xl border-gray-200 text-sm focus:ring-primary focus:border-primary">
                <option value="">Semua</option>
                <option value="create" {{ request('action') === 'create' ? 'selected' : '' }}>Create</option>
                <option value="update" {{ request('action') === 'update' ? 'selected' : '' }}>Update</option>
                <option value="delete" {{ request('action') === 'delete' ? 'selected' : '' }}>Delete</option>
                <option value="activate" {{ request('action') === 'activate' ? 'selected' : '' }}>Activate</option>
                <option value="suspend" {{ request('action') === 'suspend' ? 'selected' : '' }}>Suspend</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Dari Tanggal</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full rounded-xl border-gray-200 text-sm focus:ring-primary focus:border-primary"/>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Sampai Tanggal</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full rounded-xl border-gray-200 text-sm focus:ring-primary focus:border-primary"/>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Cari</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Deskripsi..." class="w-full rounded-xl border-gray-200 text-sm focus:ring-primary focus:border-primary"/>
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="flex-1 px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-emerald-600 transition-colors">
                <span class="material-symbols-outlined text-[16px] align-middle">filter_alt</span>
                Filter
            </button>
            <a href="{{ route('admin.audit-logs') }}" class="px-3 py-2 bg-gray-100 text-gray-600 text-sm rounded-xl hover:bg-gray-200 transition-colors">
                <span class="material-symbols-outlined text-[16px]">refresh</span>
            </a>
        </div>
    </form>
</div>

<!-- Desktop Table -->
<div class="hidden md:block bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Tanggal</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Admin</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Aksi</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Model</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Deskripsi</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">IP</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                        {{ $log->created_at->locale('id')->format('d M Y') }}
                        <span class="text-xs text-gray-400 block">{{ $log->created_at->format('H:i') }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-gradient-to-br from-primary to-emerald-400 rounded-lg flex items-center justify-center text-white font-bold text-[10px]">
                                {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                            </div>
                            <span class="font-medium text-gray-800">{{ $log->user->name ?? 'System' }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        @php
                            $actionColors = [
                                'create' => 'bg-emerald-50 text-emerald-700',
                                'update' => 'bg-blue-50 text-blue-700',
                                'delete' => 'bg-red-50 text-red-700',
                                'activate' => 'bg-green-50 text-green-700',
                                'suspend' => 'bg-orange-50 text-orange-700',
                            ];
                            $actionColor = $actionColors[$log->action] ?? 'bg-gray-50 text-gray-700';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $actionColor }}">
                            {{ ucfirst($log->action) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        @if($log->model_type)
                            <span class="font-mono text-xs bg-gray-100 px-2 py-0.5 rounded">{{ class_basename($log->model_type) }} #{{ $log->model_id }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600 max-w-xs truncate">
                        {{ $log->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-gray-400 font-mono text-xs">
                        {{ $log->ip_address ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-12 text-center">
                        <span class="material-symbols-outlined text-4xl text-gray-300 mb-2 block">search_off</span>
                        <p class="text-gray-400 text-sm">Tidak ada log audit ditemukan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Mobile Cards -->
<div class="md:hidden space-y-3">
    @forelse($logs as $log)
    <div class="bg-white rounded-2xl border border-gray-100 p-4">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-primary to-emerald-400 rounded-lg flex items-center justify-center text-white font-bold text-xs">
                    {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ $log->user->name ?? 'System' }}</p>
                    <p class="text-[10px] text-gray-400">{{ $log->created_at->locale('id')->format('d M Y H:i') }}</p>
                </div>
            </div>
            @php
                $actionColors = [
                    'create' => 'bg-emerald-50 text-emerald-700',
                    'update' => 'bg-blue-50 text-blue-700',
                    'delete' => 'bg-red-50 text-red-700',
                    'activate' => 'bg-green-50 text-green-700',
                    'suspend' => 'bg-orange-50 text-orange-700',
                ];
                $actionColor = $actionColors[$log->action] ?? 'bg-gray-50 text-gray-700';
            @endphp
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $actionColor }}">
                {{ ucfirst($log->action) }}
            </span>
        </div>
        <p class="text-sm text-gray-600 mb-2">{{ $log->description ?? '-' }}</p>
        <div class="flex items-center justify-between text-xs text-gray-400">
            @if($log->model_type)
                <span class="font-mono bg-gray-100 px-2 py-0.5 rounded">{{ class_basename($log->model_type) }} #{{ $log->model_id }}</span>
            @else
                <span>-</span>
            @endif
            <span class="font-mono">{{ $log->ip_address ?? '-' }}</span>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
        <span class="material-symbols-outlined text-4xl text-gray-300 mb-2 block">search_off</span>
        <p class="text-gray-400 text-sm">Tidak ada log audit ditemukan</p>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($logs->hasPages())
<div class="mt-6">
    {{ $logs->links() }}
</div>
@endif
@endsection
