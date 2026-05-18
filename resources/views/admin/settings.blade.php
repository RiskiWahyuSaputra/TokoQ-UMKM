@extends('admin.layout')

@section('title', 'Pengaturan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-gray-800">Pengaturan Admin</h1>
    <p class="text-sm text-gray-400 mt-1">Konfigurasi sistem platform</p>
</div>

@if(session('success'))
<div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 flex items-center gap-3 animate-fade-in">
    <span class="material-symbols-outlined text-emerald-500">check_circle</span>
    <p class="text-emerald-700 font-medium text-sm">{{ session('success') }}</p>
</div>
@endif

<form method="POST" action="{{ route('admin.settings.save') }}">
    @csrf
    <div class="max-w-2xl space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[18px]">tune</span>
                Pengaturan Umum
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <p class="font-bold text-sm text-gray-800">Auto-approve UMKM</p>
                        <p class="text-xs text-gray-400">Aktifkan toko otomatis tanpa validasi manual</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="auto_approve" value="1" {{ ($settings['auto_approve'] ?? '0') === '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <p class="font-bold text-sm text-gray-800">Notifikasi Email</p>
                        <p class="text-xs text-gray-400">Kirim email saat ada pendaftaran baru</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="email_notification" value="1" {{ ($settings['email_notification'] ?? '0') === '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <p class="font-bold text-sm text-gray-800">Mode Maintenance</p>
                        <p class="text-xs text-gray-400">Aktifkan mode perawatan website</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="maintenance_mode" value="1" {{ ($settings['maintenance_mode'] ?? '0') === '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[18px]">security</span>
                Keamanan
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Admin Baru</label>
                    <input type="password" name="admin_password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none"/>
                    <p class="text-[10px] text-gray-400 mt-1">Minimal 8 karakter. Biarkan kosong jika tidak ingin mengubah.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[18px]">info</span>
                Info Sistem
            </h3>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="p-3 bg-gray-50 rounded-xl">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Laravel</p>
                    <p class="font-bold text-gray-700">{{ app()->version() }}</p>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">PHP</p>
                    <p class="font-bold text-gray-700">{{ phpversion() }}</p>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Environment</p>
                    <p class="font-bold text-gray-700">{{ app()->environment() }}</p>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Debug Mode</p>
                    <p class="font-bold {{ config('app.debug') ? 'text-amber-600' : 'text-emerald-600' }}">{{ config('app.debug') ? 'ON' : 'OFF' }}</p>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl text-sm font-bold hover:shadow-lg hover:shadow-primary/25 transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
