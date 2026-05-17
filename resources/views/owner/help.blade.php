@extends('owner.layouts.app')

@section('title', 'Pusat Bantuan - TokoQ')

@section('content')
<div class="p-4 lg:p-6 max-w-3xl mx-auto">
    <div class="text-center mb-10">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200">
            <span class="material-symbols-outlined text-white text-3xl">help</span>
        </div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-2">Pusat Bantuan TokoQ</h1>
        <p class="text-gray-500">Panduan cepat untuk mengelola toko Anda.</p>
    </div>

    <!-- Search -->
    <div class="relative mb-8">
        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
        <input type="text" id="help-search" placeholder="Cari bantuan..." class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm"/>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
        <a href="{{ route('products.create') }}" class="bg-white rounded-xl border border-gray-200 p-4 text-center hover:border-primary hover:shadow-sm transition-all">
            <span class="material-symbols-outlined text-primary text-2xl mb-1">add_box</span>
            <p class="text-xs font-bold text-gray-700">Tambah Produk</p>
        </a>
        <a href="{{ route('pos.index') }}" class="bg-white rounded-xl border border-gray-200 p-4 text-center hover:border-primary hover:shadow-sm transition-all">
            <span class="material-symbols-outlined text-primary text-2xl mb-1">point_of_sale</span>
            <p class="text-xs font-bold text-gray-700">Kasir POS</p>
        </a>
        <a href="{{ route('reports.index') }}" class="bg-white rounded-xl border border-gray-200 p-4 text-center hover:border-primary hover:shadow-sm transition-all">
            <span class="material-symbols-outlined text-primary text-2xl mb-1">description</span>
            <p class="text-xs font-bold text-gray-700">Laporan</p>
        </a>
        <a href="{{ route('settings.index') }}" class="bg-white rounded-xl border border-gray-200 p-4 text-center hover:border-primary hover:shadow-sm transition-all">
            <span class="material-symbols-outlined text-primary text-2xl mb-1">settings</span>
            <p class="text-xs font-bold text-gray-700">Pengaturan</p>
        </a>
    </div>

    <!-- FAQ Sections -->
    <div class="space-y-6">
        <!-- Memulai -->
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-600 text-[20px]">rocket_launch</span>
                </div>
                <h2 class="font-bold text-gray-800">Memulai</h2>
            </div>
            <div class="p-5 space-y-4">
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara menambah produk pertama?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">1. Buka menu <strong>Inventori</strong> di sidebar.<br/>2. Klik tombol <strong>+ Tambah Produk</strong>.<br/>3. Isi nama, harga, stok, dan kategori.<br/>4. Klik <strong>Simpan</strong>.<br/>Tips: Anda juga bisa import banyak produk sekaligus via Excel.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara mengatur stok minimum?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">1. Buka <strong>Inventori</strong> &rarr; pilih produk.<br/>2. Klik <strong>Edit</strong>.<br/>3. Isi kolom <strong>Stok Minimum</strong> (misal: 10).<br/>4. Simpan. TokoQ akan memberi notifikasi saat stok di bawah angka tersebut.</p>
                </details>
            </div>
        </div>

        <!-- Kasir POS -->
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600 text-[20px]">point_of_sale</span>
                </div>
                <h2 class="font-bold text-gray-800">Kasir POS</h2>
            </div>
            <div class="p-5 space-y-4">
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara melakukan transaksi?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">1. Buka menu <strong>Kasir POS</strong>.<br/>2. Tap produk yang dibeli pelanggan.<br/>3. Pilih metode pembayaran: <strong>Tunai</strong>, <strong>QRIS</strong>, atau <strong>E-Wallet</strong>.<br/>4. Klik <strong>Selesaikan Transaksi</strong>.<br/>5. Stok otomatis berkurang dan tercatat di laporan.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara cetak struk?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">Setelah transaksi berhasil, klik tombol <strong>Cetak Struk</strong>. Pastikan printer thermal sudah terhubung via USB atau network. TokoQ mendukung berbagai merek printer struk.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara batalkan/refund transaksi?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">1. Buka menu <strong>Penjualan</strong>.<br/>2. Cari transaksi yang ingin dibatalkan.<br/>3. Klik <strong>Detail</strong> &rarr; <strong>Refund</strong>.<br/>4. Stok akan dikembalikan otomatis.</p>
                </details>
            </div>
        </div>

        <!-- Laporan & Stok -->
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-600 text-[20px]">insights</span>
                </div>
                <h2 class="font-bold text-gray-800">Laporan & Stok</h2>
            </div>
            <div class="p-5 space-y-4">
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara lihat laporan harian?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">1. Buka menu <strong>Laporan</strong>.<br/>2. Pilih periode: <strong>Hari Ini</strong>, <strong>Minggu Ini</strong>, atau <strong>Bulan Ini</strong>.<br/>3. Lihat ringkasan omzet, laba, dan transaksi.<br/>4. Klik <strong>Export PDF</strong> atau <strong>Export Excel</strong> untuk download.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara export data ke Excel?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">Di halaman <strong>Laporan</strong> atau <strong>Inventori</strong>, klik tombol <strong>Export Excel</strong>. File akan terdownload otomatis.</p>
                </details>
            </div>
        </div>

        <!-- Pengaturan -->
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-gray-600 text-[20px]">settings</span>
                </div>
                <h2 class="font-bold text-gray-800">Pengaturan</h2>
            </div>
            <div class="p-5 space-y-4">
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara ubah profil toko?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">1. Buka menu <strong>Pengaturan</strong>.<br/>2. Ubah nama toko, deskripsi, alamat, dan logo.<br/>3. Klik <strong>Simpan Profil Toko</strong>.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between cursor-pointer text-sm font-bold text-gray-700 hover:text-primary">
                        <span>Bagaimana cara ubah password?</span>
                        <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">1. Buka <strong>Pengaturan</strong> &rarr; <strong>Pengaturan Akun</strong>.<br/>2. Isi <strong>Password Baru</strong> dan <strong>Konfirmasi</strong>.<br/>3. Klik <strong>Simpan Perubahan</strong>.</p>
                </details>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="mt-8 bg-gradient-to-r from-primary to-emerald-600 rounded-2xl p-6 text-white text-center">
        <h3 class="font-bold text-lg mb-2">Butuh bantuan lebih?</h3>
        <p class="text-white/80 text-sm mb-4">Tim support kami siap membantu Anda.</p>
        <a href="https://wa.me/6281234567890?text=Halo%20saya%20butuh%20bantuan%20tentang%20TokoQ" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-primary font-bold rounded-xl hover:bg-gray-50 transition-colors">
            <span class="material-symbols-outlined text-[18px]">chat</span>
            Hubungi via WhatsApp
        </a>
    </div>

    <footer class="py-4 mt-8">
        <p class="text-xs text-gray-500 text-center">&copy; 2025 TokoQ. All rights reserved.</p>
    </footer>
</div>

<script>
document.getElementById('help-search').addEventListener('input', function(e) {
    const query = e.target.value.toLowerCase();
    document.querySelectorAll('details').forEach(detail => {
        const text = detail.textContent.toLowerCase();
        detail.style.display = text.includes(query) ? '' : 'none';
    });
});
</script>
@endsection