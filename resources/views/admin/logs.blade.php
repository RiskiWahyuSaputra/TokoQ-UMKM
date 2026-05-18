@extends('admin.layout')

@section('title', 'Log Sistem')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Log Sistem</h1>
        <p class="text-sm text-gray-400 mt-1">50 log terakhir dari laravel.log (data sensitif telah disamarkan)</p>
    </div>
    <a href="{{ route('admin.audit-logs') }}" class="px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-bold hover:bg-primary/20 transition-colors flex items-center gap-1.5">
        <span class="material-symbols-outlined text-[16px]">manage_history</span>
        Log Audit Admin
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="p-4 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
        <span class="material-symbols-outlined text-gray-400 text-[18px]">terminal</span>
        <span class="text-xs font-mono text-gray-500">laravel.log</span>
        <span class="ml-auto text-[10px] text-gray-400 bg-gray-100 px-2 py-0.5 rounded">Sanitized</span>
    </div>
    <div class="max-h-[600px] overflow-y-auto overflow-x-auto">
        @forelse($systemLogs as $log)
        <div class="px-5 py-3 border-b border-gray-50 hover:bg-gray-50 transition-colors font-mono text-xs leading-relaxed">
            @php
                $level = $log['level'];
                $badgeClass = match($level) {
                    'error' => 'bg-red-100 text-red-700',
                    'warning' => 'bg-amber-100 text-amber-700',
                    'debug' => 'bg-gray-200 text-gray-600',
                    default => 'bg-blue-100 text-blue-700',
                };
            @endphp
            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase mr-2 {{ $badgeClass }}">{{ $level }}</span>
            <span class="text-gray-600 break-all">{{ $log['raw'] }}</span>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400">
            <span class="material-symbols-outlined text-4xl text-gray-200 block mb-2">description</span>
            <p class="text-sm">Belum ada log sistem.</p>
        </div>
        @endforelse
    </div>
</div>

<div class="mt-4 p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3">
    <span class="material-symbols-outlined text-amber-500 text-[20px] shrink-0">warning</span>
    <div>
        <p class="text-sm font-bold text-amber-700">Catatan Keamanan</p>
        <p class="text-xs text-amber-600 mt-0.5">Path lokal dan data sensitif telah otomatis disamarkan. Untuk log audit aktivitas admin, gunakan halaman <a href="{{ route('admin.audit-logs') }}" class="font-bold underline">Log Audit</a>.</p>
    </div>
</div>
@endsection
