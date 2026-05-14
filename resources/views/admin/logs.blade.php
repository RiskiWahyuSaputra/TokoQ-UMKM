@extends('admin.layout')

@section('title', 'Log Aktivitas')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Log Aktivitas</h1>
        <p class="text-sm text-gray-400 mt-1">100 log terakhir dari sistem</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="p-4 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
        <span class="material-symbols-outlined text-gray-400 text-[18px]">terminal</span>
        <span class="text-xs font-mono text-gray-500">laravel.log</span>
    </div>
    <div class="max-h-[600px] overflow-y-auto">
        @forelse($logs as $log)
        <div class="px-5 py-3 border-b border-gray-50 hover:bg-gray-50 transition-colors font-mono text-xs text-gray-600 leading-relaxed">
            {{ $log }}
        </div>
        @empty
        <div class="p-8 text-center text-gray-400">
            <span class="material-symbols-outlined text-4xl text-gray-200 block mb-2">description</span>
            <p class="text-sm">Belum ada log aktivitas.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
