@extends('admin.layout')

@section('title', 'Pengaturan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-gray-800">Pengaturan Admin</h1>
    <p class="text-sm text-gray-400 mt-1">Konfigurasi sistem platform</p>
</div>

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
                    <input type="checkbox" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </label>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div>
                    <p class="font-bold text-sm text-gray-800">Notifikasi Email</p>
                    <p class="text-xs text-gray-400">Kirim email saat ada pendaftaran baru</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </label>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div>
                    <p class="font-bold text-sm text-gray-800">Mode Maintenance</p>
                    <p class="text-xs text-gray-400">Aktifkan mode perawatan website</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
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
                <label class="block text-sm font-bold text-gray-700 mb-2">Password Admin</label>
                <input type="password" placeholder="Ubah password admin" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none"/>
            </div>
            <button class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary-dark transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
@endsection
