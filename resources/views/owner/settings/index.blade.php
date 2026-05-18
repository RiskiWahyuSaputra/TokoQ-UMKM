@extends('owner.layouts.app')

@section('title', 'Pengaturan - TokoQ')

@section('styles')
<style>
.gradient-success { background: linear-gradient(135deg, #10B981 0%, #34D399 100%); }

.input-focus {
    transition: all 0.2s ease;
}
.input-focus:focus {
    border-color: #10B981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.avatar-upload {
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}
.avatar-upload:hover .avatar-overlay {
    opacity: 1;
}
.avatar-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}
</style>
@endsection

@section('content')
@php
    $user = Auth::user();
    $shop = $user->shop;
    $initials = collect(explode(' ', trim($user->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
    $shopInitials = $shop ? collect(explode(' ', trim($shop->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('') : 'TK';
@endphp

<div class="p-4 lg:p-6 max-w-3xl mx-auto">

    <!-- Profile Card -->
    <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden mb-5">
        <!-- Cover -->
        <div class="h-28 bg-gradient-to-r from-primary via-emerald-500 to-teal-500 relative">
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-4 left-8 w-16 h-16 border-2 border-white/30 rounded-full"></div>
                <div class="absolute top-12 right-12 w-8 h-8 border-2 border-white/20 rounded-full"></div>
                <div class="absolute bottom-4 left-1/3 w-12 h-12 border-2 border-white/25 rounded-full"></div>
            </div>
        </div>

        <!-- Profile Info -->
        <div class="px-6 pb-6 -mt-12 relative">
            <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                <!-- Avatar -->
                <div class="avatar-upload shrink-0" onclick="document.getElementById('profile_photo').click()">
                    @if ($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                    @else
                        <div class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold border-4 border-white shadow-lg">
                            {{ $initials }}
                        </div>
                    @endif
                    <div class="avatar-overlay">
                        <span class="material-symbols-outlined text-white text-[28px]">camera_alt</span>
                    </div>
                </div>

                <div class="flex-1 pt-2 sm:pt-0">
                    <h2 class="text-xl font-bold text-on-surface">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-400">{{ $user->email }}</p>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-600 text-xs font-bold">✓ Terverifikasi</span>
                        <span class="text-xs text-gray-400">Bergabung {{ $user->created_at->locale('id')->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SHOP PROFILE SECTION ===== -->
    <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden mb-5">
        <!-- Section Header -->
        <div class="p-5 border-b border-outline-variant flex items-center gap-3">
            <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-emerald-600 text-[20px]">storefront</span>
            </div>
            <div>
                <h3 class="font-bold text-on-surface">Profil Toko</h3>
                <p class="text-xs text-gray-400">Kelola informasi toko Anda</p>
            </div>
        </div>

        <!-- Shop Form -->
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-5">
            @csrf

            <!-- Hidden file inputs -->
            <input id="profile_photo" name="profile_photo" type="file" accept=".jpg,.jpeg,.png,.webp" class="hidden" onchange="previewAvatar(this)"/>
            <input id="shop_logo" name="shop_logo" type="file" accept=".jpg,.jpeg,.png,.webp" class="hidden" onchange="previewShopLogo(this)"/>

            <!-- Shop Logo & Name Row -->
            <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                <!-- Shop Logo -->
                <div class="shrink-0">
                    <label class="text-xs font-bold text-gray-500 mb-2 block">Logo Toko</label>
                    <div class="avatar-upload" onclick="document.getElementById('shop_logo').click()">
                        @if ($shop && $shop->logo_path)
                            <img src="{{ Storage::url($shop->logo_path) }}" alt="{{ $shop->name }}" class="w-20 h-20 rounded-2xl object-cover border-2 border-gray-100 shadow-sm">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary/10 to-emerald-100 flex items-center justify-center border-2 border-dashed border-primary/30">
                                <span class="material-symbols-outlined text-primary text-[28px]">storefront</span>
                            </div>
                        @endif
                        <div class="avatar-overlay rounded-2xl">
                            <span class="material-symbols-outlined text-white text-[24px]">camera_alt</span>
                        </div>
                    </div>
                </div>

                <!-- Shop Name -->
                <div class="flex-1">
                    <label class="flex items-center gap-2 text-sm font-bold text-on-surface mb-2" for="shop_name">
                        <span class="material-symbols-outlined text-[16px] text-gray-400">badge</span>
                        Nama Toko
                    </label>
                    <input id="shop_name" name="shop_name" type="text" value="{{ old('shop_name', $shop->name ?? '') }}"
                        class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none"
                        placeholder="Masukkan nama toko Anda"/>
                </div>
            </div>

            <!-- Deskripsi Toko -->
            <div>
                <label class="flex items-center gap-2 text-sm font-bold text-on-surface mb-2" for="shop_description">
                    <span class="material-symbols-outlined text-[16px] text-gray-400">description</span>
                    Deskripsi Toko
                </label>
                <textarea id="shop_description" name="shop_description" rows="3"
                    class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none resize-none"
                    placeholder="Ceritakan tentang toko Anda...">{{ old('shop_description', $shop->description ?? '') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Maks. 1000 karakter</p>
            </div>

            <!-- Alamat Toko -->
            <div>
                <label class="flex items-center gap-2 text-sm font-bold text-on-surface mb-2" for="shop_address">
                    <span class="material-symbols-outlined text-[16px] text-gray-400">location_on</span>
                    Alamat Toko
                </label>
                <textarea id="shop_address" name="shop_address" rows="2"
                    class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none resize-none"
                    placeholder="Alamat lengkap toko Anda">{{ old('shop_address', $shop->address ?? '') }}</textarea>
            </div>

            <!-- Shop Info Preview (if shop exists) -->
            @if ($shop)
            <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-emerald-600 text-[16px]">info</span>
                    <p class="text-xs font-bold text-emerald-700">Info Toko Aktif</p>
                </div>
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div>
                        <p class="text-gray-400">Slug</p>
                        <p class="font-mono text-emerald-600 font-medium">{{ $shop->slug }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Dibuat</p>
                        <p class="text-gray-600 font-medium">{{ $shop->created_at->locale('id')->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Submit for Shop -->
            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-400">Perubahan akan langsung tersimpan.</p>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 transition-all active:scale-[0.98] flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Profil Toko
                </button>
            </div>
        </form>
    </div>

    <!-- Store Settings: Pajak, Printer, Pembayaran -->
    <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden mb-5">
        <div class="p-5 border-b border-outline-variant flex items-center gap-3">
            <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-600 text-[20px]">store</span>
            </div>
            <div>
                <h3 class="font-bold text-on-surface">Pengaturan Toko</h3>
                <p class="text-xs text-gray-400">Pajak, printer, metode pembayaran</p>
            </div>
        </div>
        <div class="p-5 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold text-gray-500 mb-1.5 block">Pajak (%)</label>
                    <input type="number" name="tax_rate" value="0" min="0" max="100" step="0.1"
                        class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none"
                        placeholder="Contoh: 11"/>
                    <p class="text-[10px] text-gray-400 mt-1">Biaya pajak yang ditambahkan ke transaksi</p>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-500 mb-1.5 block">Biaya Layanan (Rp)</label>
                    <input type="number" name="service_fee" value="0" min="0"
                        class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none"
                        placeholder="Contoh: 2000"/>
                </div>
            </div>
            <div>
                <label class="text-xs font-bold text-gray-500 mb-1.5 block">Printer Struk</label>
                <select name="printer_type" class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none">
                    <option value="">Pilih printer...</option>
                    <option value="thermal_usb">Thermal USB</option>
                    <option value="thermal_network">Thermal Network</option>
                    <option value="bluetooth">Bluetooth</option>
                </select>
            </div>
            <div>
                <label class="text-xs font-bold text-gray-500 mb-2 block">Metode Pembayaran Aktif</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    <label class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer"><input type="checkbox" name="payment_methods[]" value="tunai" checked class="rounded text-primary"/><span class="text-xs font-medium">Tunai</span></label>
                    <label class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer"><input type="checkbox" name="payment_methods[]" value="qris" checked class="rounded text-primary"/><span class="text-xs font-medium">QRIS</span></label>
                    <label class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer"><input type="checkbox" name="payment_methods[]" value="dana" class="rounded text-primary"/><span class="text-xs font-medium">DANA</span></label>
                    <label class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer"><input type="checkbox" name="payment_methods[]" value="gopay" class="rounded text-primary"/><span class="text-xs font-medium">GoPay</span></label>
                </div>
            </div>
            <div class="flex justify-end pt-3 border-t border-gray-100">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-xl transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span> Simpan Pengaturan Toko
                </button>
            </div>
        </div>
    </div>

    <!-- Keamanan & Backup -->
    <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden mb-5">
        <div class="p-5 border-b border-outline-variant flex items-center gap-3">
            <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-amber-600 text-[20px]">security</span>
            </div>
            <div>
                <h3 class="font-bold text-on-surface">Keamanan & Backup</h3>
                <p class="text-xs text-gray-400">Backup data dan keamanan akun</p>
            </div>
        </div>
        <div class="p-5 space-y-4">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div><p class="font-bold text-sm text-gray-800">Backup Data</p><p class="text-xs text-gray-500">Download semua data produk, transaksi, dan laporan</p></div>
                <button type="button" onclick="alert('Backup data akan segera tersedia')" class="px-4 py-2 bg-primary text-white rounded-xl text-xs font-bold">Backup</button>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div><p class="font-bold text-sm text-gray-800">Export Semua Data</p><p class="text-xs text-gray-500">Download dalam format Excel</p></div>
                <button type="button" onclick="alert('Export data akan segera tersedia')" class="px-4 py-2 bg-emerald-500 text-white rounded-xl text-xs font-bold">Export</button>
            </div>
            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl border border-blue-100">
                <div><p class="font-bold text-sm text-blue-800">Backup Otomatis</p><p class="text-xs text-blue-600">Data di-backup secara otomatis setiap hari</p></div>
                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">Aktif</span>
            </div>
        </div>
    </div>

    <!-- Settings Form (Account) -->
    <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden">
        <!-- Form Header -->
        <div class="p-5 border-b border-outline-variant flex items-center gap-3">
            <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-gray-500 text-[20px]">settings</span>
            </div>
            <div>
                <h3 class="font-bold text-on-surface">Pengaturan Akun</h3>
                <p class="text-xs text-gray-400">Perbarui informasi akun Anda</p>
            </div>
        </div>

        <!-- Messages -->
        @if (session('success'))
            <div class="mx-5 mt-5 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-500 text-[18px]">check_circle</span>
                <p class="text-emerald-700 font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-5 mt-5 rounded-xl bg-red-50 border border-red-200 px-4 py-3">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-red-500 text-[18px]">error</span>
                    <p class="font-bold text-red-700 text-sm">Ada data yang perlu diperbaiki:</p>
                </div>
                <ul class="list-disc pl-8 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-5">
            @csrf

            <!-- Nama -->
            <div>
                <label class="flex items-center gap-2 text-sm font-bold text-on-surface mb-2" for="name">
                    <span class="material-symbols-outlined text-[16px] text-gray-400">person</span>
                    Nama
                </label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                    class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none"
                    placeholder="Nama lengkap"/>
            </div>

            <!-- Email -->
            <div>
                <label class="flex items-center gap-2 text-sm font-bold text-on-surface mb-2" for="email">
                    <span class="material-symbols-outlined text-[16px] text-gray-400">mail</span>
                    Email
                </label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                    class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none"
                    placeholder="email@contoh.com"/>
            </div>

            <!-- Password Section -->
            <div class="pt-3 border-t border-gray-100">
                <p class="flex items-center gap-2 text-sm font-bold text-on-surface mb-4">
                    <span class="material-symbols-outlined text-[16px] text-gray-400">lock</span>
                    Ubah Password
                </p>
                <p class="text-xs text-gray-400 mb-4">Kosongkan jika tidak ingin mengubah password.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-500 mb-1.5 block" for="password">Password Baru</label>
                        <div class="relative">
                            <input id="password" name="password" type="password"
                                class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none pr-10"
                                placeholder="Min. 8 karakter"/>
                            <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 mb-1.5 block" for="password_confirmation">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="input-focus w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white outline-none pr-10"
                                placeholder="Ulangi password"/>
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-400">Perubahan akan langsung tersimpan.</p>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 transition-all active:scale-[0.98] flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="mt-5 bg-white rounded-2xl border border-red-200 overflow-hidden">
        <div class="p-5 flex items-center gap-3">
            <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-red-500 text-[20px]">logout</span>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-on-surface text-sm">Keluar dari Akun</h3>
                <p class="text-xs text-gray-400">Anda perlu login kembali setelah keluar.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 border border-red-200 text-red-500 rounded-xl text-xs font-bold hover:bg-red-50 transition-colors">
                    Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-4 flex flex-col sm:flex-row justify-between items-center gap-2">
        <p class="text-xs text-gray-500">&copy; 2025 TokoQ. All rights reserved.</p>
    </footer>
</div>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}

function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const avatarContainer = document.querySelector('.avatar-upload');
            let img = avatarContainer.querySelector('img');
            if (!img) {
                img = document.createElement('img');
                img.className = 'w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg';
                avatarContainer.querySelector('div').replaceWith(img);
            }
            img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewShopLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Preview di halaman settings
            const containers = document.querySelectorAll('.avatar-upload');
            const shopContainer = containers[1] || containers[0];
            let img = shopContainer.querySelector('img');
            if (!img) {
                img = document.createElement('img');
                img.className = 'w-20 h-20 rounded-2xl object-cover border-2 border-gray-100 shadow-sm';
                const placeholder = shopContainer.querySelector('div');
                if (placeholder) placeholder.replaceWith(img);
            }
            img.src = e.target.result;

            // Update juga logo di sidebar
            const sidebarLogoImg = document.querySelector('#sidebar img');
            if (sidebarLogoImg) {
                sidebarLogoImg.src = e.target.result;
            } else {
                // Kalau sidebar belum punya img (masih icon+text), ganti dengan img
                const sidebarLogoContainer = document.querySelector('#sidebar .flex.items-center.gap-2');
                if (sidebarLogoContainer) {
                    const newImg = document.createElement('img');
                    newImg.src = e.target.result;
                    newImg.alt = 'Logo';
                    newImg.className = 'w-full max-w-[180px] h-auto max-h-[80px] object-contain mb-2';
                    sidebarLogoContainer.replaceWith(newImg);
                }
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
