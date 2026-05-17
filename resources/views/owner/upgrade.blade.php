@extends('owner.layouts.app')

@section('title', 'Upgrade Plan - TokoQ')

@section('content')
<div class="p-4 lg:p-6 max-w-4xl mx-auto">
    <div class="text-center mb-10">
        <div class="w-16 h-16 bg-gradient-to-br from-primary to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-white text-3xl">workspace_premium</span>
        </div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-2">Upgrade Plan TokoQ</h1>
        <p class="text-gray-500 max-w-lg mx-auto">Pilih paket yang sesuai dengan kebutuhan toko Anda. Upgrade kapan saja, downgrade juga bisa.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
        <!-- Free -->
        <div class="bg-white rounded-3xl p-8 border border-gray-200 shadow-sm">
            <div class="mb-6"><h3 class="text-lg font-bold text-gray-800 mb-1">Gratis</h3><p class="text-sm text-gray-500">Untuk mencoba TokoQ</p></div>
            <div class="mb-6"><span class="text-4xl font-extrabold text-gray-800">Rp 0</span><span class="text-sm text-gray-400">/bulan</span></div>
            <div class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold mb-6">
                <span class="material-symbols-outlined text-[14px]">check</span> Plan Anda saat ini
            </div>
            <ul class="space-y-3 text-sm">
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>50 produk</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>100 transaksi/bulan</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Laporan dasar</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>1 pengguna</li>
                <li class="flex items-center gap-2 text-gray-400"><span class="material-symbols-outlined text-gray-300 text-[18px]">close</span>Prediksi AI</li>
                <li class="flex items-center gap-2 text-gray-400"><span class="material-symbols-outlined text-gray-300 text-[18px]">close</span>Support prioritas</li>
            </ul>
        </div>
        <!-- Pro -->
        <div class="bg-white rounded-3xl p-8 border-2 border-primary shadow-lg relative">
            <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-primary to-emerald-600 text-white text-[10px] font-bold uppercase tracking-wider rounded-full">Populer</div>
            <div class="mb-6"><h3 class="text-lg font-bold text-gray-800 mb-1">Pro</h3><p class="text-sm text-gray-500">Untuk toko yang berkembang</p></div>
            <div class="mb-6"><span class="text-4xl font-extrabold text-gray-800">Rp 99.000</span><span class="text-sm text-gray-400">/bulan</span></div>
            <a href="/register?plan=pro" class="block w-full text-center py-3 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl hover:shadow-lg transition-all mb-6">Upgrade ke Pro</a>
            <ul class="space-y-3 text-sm">
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>500 produk</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Transaksi unlimited</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Laporan lengkap + export</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>3 pengguna</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Prediksi AI restok</li>
                <li class="flex items-center gap-2 text-gray-400"><span class="material-symbols-outlined text-gray-300 text-[18px]">close</span>Support prioritas</li>
            </ul>
        </div>
        <!-- Bisnis -->
        <div class="bg-white rounded-3xl p-8 border border-gray-200 shadow-sm">
            <div class="mb-6"><h3 class="text-lg font-bold text-gray-800 mb-1">Bisnis</h3><p class="text-sm text-gray-500">Untuk toko dengan kebutuhan penuh</p></div>
            <div class="mb-6"><span class="text-4xl font-extrabold text-gray-800">Rp 249.000</span><span class="text-sm text-gray-400">/bulan</span></div>
            <a href="/register?plan=bisnis" class="block w-full text-center py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors mb-6">Upgrade ke Bisnis</a>
            <ul class="space-y-3 text-sm">
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Produk unlimited</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Transaksi unlimited</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Laporan lengkap + export</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>10 pengguna</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Prediksi AI restok</li>
                <li class="flex items-center gap-2 text-gray-600"><span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>Support prioritas 24/7</li>
            </ul>
        </div>
    </div>

    <div class="text-center mt-10">
        <p class="text-sm text-gray-500">Semua paket termasuk: QRIS, printer struk, barcode scanner, import/export Excel, backup data harian.</p>
        <p class="text-xs text-gray-400 mt-2">Biaya transaksi QRIS mengikuti ketentuan provider pembayaran.</p>
    </div>

    <div class="mt-10 bg-white rounded-2xl border border-gray-200 p-6">
        <h3 class="font-bold text-gray-800 mb-4">Pertanyaan tentang plan?</h3>
        <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-600">
            <div class="flex items-start gap-2"><span class="material-symbols-outlined text-primary text-[18px]">help</span><span>Bisa downgrade kapan saja tanpa penalti.</span></div>
            <div class="flex items-start gap-2"><span class="material-symbols-outlined text-primary text-[18px]">help</span><span>Data Anda tetap aman saat pindah plan.</span></div>
            <div class="flex items-start gap-2"><span class="material-symbols-outlined text-primary text-[18px]">help</span><span>Gratis 14 hari untuk plan Pro dan Bisnis.</span></div>
            <div class="flex items-start gap-2"><span class="material-symbols-outlined text-primary text-[18px]">help</span><span>Hubungi kami via WhatsApp untuk bantuan.</span></div>
        </div>
    </div>
</div>
@endsection