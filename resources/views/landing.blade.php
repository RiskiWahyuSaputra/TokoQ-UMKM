<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TokoQ - Sistem Kasir &amp; Digital Twin UMKM</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="../tokoq_design_system/responsive.css" rel="stylesheet"/>
<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: #ECFDF5; /* secondary - soft mint */
            color: #374151; /* text - charcoal */
        }
        .matcha-gradient {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        }
        .paper-elevation {
            box-shadow: 0 10px 30px -10px rgba(16, 185, 129, 0.12);
        }
        .paper-border {
            border: 1px solid #D1D5DB;
        }
    </style>
<script src="/js/tailwind-config.js"></script>
</head>
<body class="landing-shell font-body-md">
<!-- Navigation Header -->
<header class="landing-header h-20 w-full sticky top-0 z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant">
<div class="landing-header-inner flex justify-between items-center px-container-padding h-full max-w-7xl mx-auto">
<div class="flex items-center gap-2">
<div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-on-primary-container">storefront</span>
</div>
<span class="font-h3 text-h3 font-bold text-primary">TokoQ</span>
</div>
<nav class="landing-desktop-nav hidden md:flex gap-8 items-center">
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="#">Fitur</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="#">Kasir</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="#">Cara Kerja</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="#">Dampak</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="/login">Masuk</a>
</nav>
<div class="flex items-center gap-3">
<button aria-label="Buka menu navigasi" class="landing-mobile-nav-toggle md:hidden" data-landing-menu-toggle="" type="button">
<span class="material-symbols-outlined">menu</span>
</button>
<a href="/register" class="landing-primary-cta bg-primary-container text-on-primary-container px-6 py-2.5 rounded-full font-bold active:scale-95 transition-transform">
                Daftar Sekarang
            </a>
</div>
</div>
<div class="landing-mobile-menu md:hidden">
<nav>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="#">Fitur</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="#">Kasir</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="#">Cara Kerja</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="#">Dampak</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors" href="/login">Masuk</a>
<a href="/register" class="bg-primary text-on-primary px-6 py-3 rounded-2xl font-bold active:scale-95 transition-transform inline-flex">
                    Daftar Sekarang
                </a>
</nav>
</div>
</header>
<main>
<!-- Hero Section -->
<section class="landing-section landing-hero pt-20 pb-32 px-container-padding max-w-7xl mx-auto overflow-hidden">
<div class="landing-hero-grid grid md:grid-cols-2 gap-16 items-center">
<div class="space-y-8">
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-container text-on-secondary-fixed-variant rounded-full text-label-caps">
<span class="material-symbols-outlined text-[16px]">verified</span>
                        SOLUSI DIGITAL UMKM INDONESIA
                    </div>
<h1 class="font-h1 text-h1 md:text-[56px] text-primary leading-tight">
                        Sistem Kasir dan <span class="text-tertiary">Digital Twin</span> Sederhana untuk UMKM
                    </h1>
<p class="text-body-lg text-on-surface-variant max-w-lg">
                        Kelola stok barang, catat penjualan otomatis, dan pantau performa toko Anda melalui satu dashboard cerdas yang terasa nyata.
                    </p>
<div class="flex flex-wrap gap-4">
<a href="/register" class="bg-primary text-on-primary px-8 py-4 rounded-xl font-bold flex items-center gap-2 hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                            Daftar Toko Saya
                            <span class="material-symbols-outlined">arrow_forward</span>
</a>
<button class="bg-surface-container-high text-primary px-8 py-4 rounded-xl font-bold border border-outline-variant hover:bg-surface-variant transition-all">
                            Lihat Fitur Kasir
                        </button>
</div>
</div>
<div class="relative">
<div class="absolute -top-12 -right-12 w-64 h-64 bg-primary-fixed-dim/30 rounded-full blur-3xl"></div>
<div class="landing-hero-card relative bg-white p-4 rounded-3xl paper-elevation border border-outline-variant rotate-2">
<img alt="Dashboard Mockup" class="rounded-2xl w-full h-auto grayscale-[0.2] contrast-[1.1]" data-alt="A clean and professional digital dashboard mockup for a small retail business. The screen displays vibrant charts of sales growth, a grid of inventory items with photos of local Indonesian snacks, and a sidebar with elegant icons. The overall aesthetic is minimalist with a warm olive and matcha color palette, captured in soft morning light on a light wooden desk." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYU9VD48rS3kvGDQYNd9vXImbRCRJ3TCWeSba83rjjHkZLKQbwfl8tZHRlNjeTLnwH4sPnHK0XC89H_lGNDyKkpMldYRTCdrC1LwsG4HOeaJQjtxTrcGebCTprcsnLpUIViTstqlYn90O52s_GAQ1h7I13ISDr9vCQqD4XSGTQl38uQBTAltMUywJXnE2KwN99jA0Z6GGQULPRtek-pIkRxJoD_2kwO0gyT7S5B45p7Kw27GKE7d5E0NpLlN1Ga-XZPoJXULwFsvk"/>
<!-- Floating Insight Card -->
<div class="landing-insight-card absolute -bottom-8 -left-8 bg-white p-6 rounded-2xl shadow-xl border-t-4 border-tertiary max-w-[240px]">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined text-tertiary">psychology</span>
<span class="font-bold text-body-sm">AI Insight</span>
</div>
<p class="text-body-sm text-on-surface-variant">Stok krupuk pedas diprediksi habis dalam 3 hari. Restok sekarang?</p>
</div>
</div>
</div>
</div>
</section>
<!-- Problem Section -->
<section class="landing-section py-24 bg-surface-dim">
<div class="max-w-7xl mx-auto px-container-padding">
<div class="text-center mb-16 space-y-4">
<h2 class="font-h2 text-h2 text-primary">Masalah yang Sering Dialami Toko Kecil</h2>
<p class="text-on-surface-variant max-w-2xl mx-auto">Seringkali pengelolaan manual menghambat pertumbuhan bisnis Anda. Saatnya beralih dari cara lama.</p>
</div>
<div class="grid md:grid-cols-3 gap-8">
<!-- Manual Record -->
<div class="bg-white p-8 rounded-3xl shadow-lg shadow-black/5 border border-outline-variant/50 hover:translate-y-[-8px] hover:shadow-xl transition-all duration-300">
<div class="w-14 h-14 bg-error-container text-on-error-container rounded-2xl flex items-center justify-center mb-6">
<span class="material-symbols-outlined text-[32px]">edit_note</span>
</div>
<h3 class="font-h3 text-h3 mb-3">Pencatatan Manual</h3>
<p class="text-on-surface-variant">Buku nota sering hilang, kotor, atau salah hitung. Memakan waktu lama saat rekap akhir bulan.</p>
</div>
<!-- Stock Out -->
<div class="bg-white p-8 rounded-3xl shadow-lg shadow-black/5 border border-outline-variant/50 hover:translate-y-[-8px] hover:shadow-xl transition-all duration-300">
<div class="w-14 h-14 bg-error-container text-on-error-container rounded-2xl flex items-center justify-center mb-6">
<span class="material-symbols-outlined text-[32px]">inventory</span>
</div>
<h3 class="font-h3 text-h3 mb-3">Stok Tidak Terkontrol</h3>
<p class="text-on-surface-variant">Barang habis tanpa diketahui, pelanggan kecewa, dan modal tertahan di barang yang tidak laku.</p>
</div>
<!-- Missing Profit -->
<div class="bg-white p-8 rounded-3xl shadow-lg shadow-black/5 border border-outline-variant/50 hover:translate-y-[-8px] hover:shadow-xl transition-all duration-300">
<div class="w-14 h-14 bg-error-container text-on-error-container rounded-2xl flex items-center justify-center mb-6">
<span class="material-symbols-outlined text-[32px]">leak_remove</span>
</div>
<h3 class="font-h3 text-h3 mb-3">Laba Tidak Jelas</h3>
<p class="text-on-surface-variant">Uang toko dan uang pribadi sering tercampur. Sulit menentukan apakah bisnis untung atau rugi.</p>
</div>
</div>
</div>
</section>
<!-- Solution Section: Bento Grid -->
<section class="landing-section py-24 max-w-7xl mx-auto px-container-padding">
<div class="text-center mb-16 space-y-4">
<h2 class="font-h2 text-h2 text-primary">Satu Dashboard untuk Operasional Toko</h2>
<p class="text-on-surface-variant max-w-2xl mx-auto">Kami menggabungkan kemudahan penggunaan dengan kecanggihan prediksi AI.</p>
</div>
<div class="landing-bento grid md:grid-cols-4 md:grid-rows-2 gap-6 h-auto md:h-[600px]">
<div class="md:col-span-2 md:row-span-2 bg-white p-10 rounded-[32px] text-on-surface flex flex-col justify-between relative overflow-hidden group shadow-lg shadow-black/5 border border-outline-variant">
<div class="relative z-10">
<span class="material-symbols-outlined text-[48px] text-primary mb-6">point_of_sale</span>
<h3 class="font-h2 text-h2 mb-4 text-primary">Kasir POS Cepat</h3>
<p class="text-on-surface-variant text-body-lg">Transaksi lancar bahkan saat ramai. Mendukung pembayaran tunai dan QRIS otomatis.</p>
</div>
<div class="mt-8 relative z-10 flex gap-2">
<span class="px-4 py-1.5 bg-primary/10 rounded-full text-label-caps text-primary">RESPONSIF</span>
<span class="px-4 py-1.5 bg-primary/10 rounded-full text-label-caps text-primary">CETAK NOTA</span>
</div>
<!-- Abstract Shape -->
<div class="absolute -bottom-10 -right-10 w-64 h-64 bg-primary/5 rounded-full blur-2xl group-hover:scale-110 transition-transform"></div>
</div>
<div class="md:col-span-2 bg-white p-8 rounded-[32px] flex items-center gap-6 border border-outline-variant shadow-md shadow-black/5">
<div class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[40px] text-primary">inventory_2</span>
</div>
<div>
<h3 class="font-h3 text-h3 mb-2">Inventori Otomatis</h3>
<p class="text-on-surface-variant">Stok berkurang otomatis setiap penjualan. Notifikasi stok menipis secara real-time.</p>
</div>
</div>
<div class="md:col-span-1 bg-white p-8 rounded-[32px] flex flex-col justify-between border border-outline-variant shadow-md shadow-black/5">
<span class="material-symbols-outlined text-[32px] text-primary">psychology</span>
<div>
<h3 class="font-bold text-body-lg mb-2">Prediksi AI</h3>
<p class="text-body-sm text-on-surface-variant">Tahu kapan harus belanja barang lagi.</p>
</div>
</div>
<div class="md:col-span-1 bg-white p-8 rounded-[32px] flex flex-col justify-between border border-outline-variant shadow-md shadow-black/5">
<span class="material-symbols-outlined text-[32px] text-primary">description</span>
<div>
<h3 class="font-bold text-body-lg mb-2">Laporan</h3>
<p class="text-body-sm text-on-surface-variant">Laba rugi harian siap dalam satu klik.</p>
</div>
</div>
</div>
</section>
<!-- Process Section -->
<section class="landing-section py-24 bg-surface-dim">
<div class="max-w-7xl mx-auto px-container-padding">
<div class="grid md:grid-cols-3 gap-12">
<div class="bg-white p-10 rounded-3xl shadow-lg shadow-black/5 border border-outline-variant/50 text-center">
<div class="text-[64px] font-bold text-primary/15 leading-none mb-4">01</div>
<h3 class="font-h3 text-h3 mb-4 text-primary">Tambah Produk</h3>
<p class="text-on-surface-variant">Unggah foto dan atur harga produk Anda dengan mudah lewat HP atau Komputer.</p>
</div>
<div class="bg-white p-10 rounded-3xl shadow-lg shadow-black/5 border border-outline-variant/50 text-center">
<div class="text-[64px] font-bold text-primary/15 leading-none mb-4">02</div>
<h3 class="font-h3 text-h3 mb-4 text-primary">Catat Transaksi</h3>
<p class="text-on-surface-variant">Input pesanan pelanggan dengan cepat. Sistem akan otomatis memotong stok barang.</p>
</div>
<div class="bg-white p-10 rounded-3xl shadow-lg shadow-black/5 border border-outline-variant/50 text-center">
<div class="text-[64px] font-bold text-primary/15 leading-none mb-4">03</div>
<h3 class="font-h3 text-h3 mb-4 text-primary">Pantau Insight</h3>
<p class="text-on-surface-variant">Lihat grafik penjualan dan prediksi kebutuhan barang untuk hari esok.</p>
</div>
</div>
</div>
</section>
<!-- Impact Section -->
<section class="landing-section py-24 max-w-7xl mx-auto px-container-padding">
<div class="landing-impact-panel bg-text-dark rounded-[40px] p-12 md:p-20 text-white flex flex-col md:flex-row gap-12 items-center shadow-2xl shadow-black/30 border border-gray-700">
<div class="md:w-1/2">
<h2 class="font-h2 text-[40px] leading-tight mb-8">Dampak Nyata untuk Pertumbuhan Bisnis Anda</h2>
<ul class="space-y-6">
<li class="flex gap-4">
<div class="bg-primary text-on-primary w-8 h-8 rounded-full flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[18px]">check</span>
</div>
<div>
<p class="font-bold">Kurangi Risiko Stok Kosong hingga 40%</p>
<p class="text-body-sm text-gray-300">Dengan peringatan dini berbasis kebiasaan belanja pelanggan.</p>
</div>
</li>
<li class="flex gap-4">
<div class="bg-primary text-on-primary w-8 h-8 rounded-full flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[18px]">check</span>
</div>
<div>
<p class="font-bold">Keputusan Berbasis Data (Data-Driven)</p>
<p class="text-body-sm text-gray-300">Tentukan promosi yang tepat berdasarkan produk paling laris.</p>
</div>
</li>
<li class="flex gap-4">
<div class="bg-primary text-on-primary w-8 h-8 rounded-full flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[18px]">check</span>
</div>
<div>
<p class="font-bold">Efisiensi Waktu Rekapitulasi</p>
<p class="text-body-sm text-gray-300">Hemat 2 jam setiap hari yang biasanya digunakan untuk menghitung kasir manual.</p>
</div>
</li>
</ul>
</div>
<div class="landing-impact-grid md:w-1/2 grid grid-cols-2 gap-4">
<img alt="UMKM Activity" class="rounded-3xl h-64 w-full object-cover shadow-lg" data-alt="A candid, artistic black and white photograph of an Indonesian traditional market stall owner smiling while looking at a smartphone. The background is a beautifully blurred array of fresh produce and wooden shelves, capturing the authentic spirit of small local businesses. The lighting is soft and natural, emphasizing a sense of hope and progress." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrWZwq7BYf8QJgFJm1WWEu_YBGzYxdSmjRyff-PJdSrOpzrfFT9xZDQhtgeGjlxneA4GHys4m7zYMFXxdHMNTrZ13rBdoVIezAfP7uPwpicjBNdFX-FbsMUxQdfPLnAe-lVrm24BEw2mIioyBrrQoyvAi7DZ7wsSqimVMtQJcz-VTKyNmq8_w2_IUTXsaBuS9H0e3fdWbYNz1QioXcBdFeESunM1cwJZmHrJt9sfvpX3093TQwpI_2XDMOT1Tj5BHIIsTCEWvLK4M"/>
<div class="bg-primary p-6 rounded-3xl flex flex-col justify-end shadow-lg">
<div class="text-[40px] font-bold text-on-primary">10k+</div>
<div class="text-on-primary/80 font-medium">UMKM Bergabung</div>
</div>
</div>
</div>
</section>
<!-- Final CTA -->
<section class="landing-section py-32 text-center max-w-4xl mx-auto px-container-padding">
<h2 class="font-h1 text-[48px] text-primary mb-8">Bantu toko Anda naik kelas bersama TokoQ</h2>
<p class="text-body-lg text-on-surface-variant mb-12">Bergabunglah dengan ribuan pengusaha UMKM lainnya yang telah mendigitalisasi operasional mereka. Sederhana, cerdas, dan terjangkau.</p>
<div class="flex flex-col md:flex-row gap-4 justify-center">
<button class="bg-primary text-on-primary px-10 py-5 rounded-2xl font-bold text-body-lg shadow-xl hover:scale-105 transition-transform">
                    Mulai Sekarang — Gratis 14 Hari
                </button>
<button class="bg-white text-primary border-2 border-primary px-10 py-5 rounded-2xl font-bold text-body-lg hover:bg-surface-container-low transition-colors">
                    Hubungi Sales Kami
                </button>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-text-dark text-white py-20">
<div class="max-w-7xl mx-auto px-container-padding grid md:grid-cols-4 gap-12">
<div class="col-span-2">
<div class="flex items-center gap-2 mb-6">
<div class="w-8 h-8 bg-primary rounded flex items-center justify-center">
<span class="material-symbols-outlined text-white text-[20px]">storefront</span>
</div>
<span class="font-h3 text-h3 font-bold text-white">TokoQ</span>
</div>
<p class="max-w-sm mb-8 text-gray-200">Mendigitalisasi UMKM Indonesia melalui solusi kasir dan inventori berbasis AI yang intuitif dan mudah digunakan.</p>
<div class="flex gap-4">
<a class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center hover:bg-primary hover:border-primary transition-colors" href="#"><span class="material-symbols-outlined text-[20px]">language</span></a>
<a class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center hover:bg-primary hover:border-primary transition-colors" href="#"><span class="material-symbols-outlined text-[20px]">group</span></a>
</div>
</div>
<div>
<h4 class="font-bold text-white mb-6">Produk</h4>
<ul class="space-y-4 text-gray-200">
<li><a class="hover:text-white transition-colors" href="#">Sistem Kasir</a></li>
<li><a class="hover:text-white transition-colors" href="#">Manajemen Stok</a></li>
<li><a class="hover:text-white transition-colors" href="#">Laporan Keuangan</a></li>
<li><a class="hover:text-white transition-colors" href="#">Harga</a></li>
</ul>
</div>
<div>
<h4 class="font-bold text-white mb-6">Dukungan</h4>
<ul class="space-y-4 text-gray-200">
<li><a class="hover:text-white transition-colors" href="#">Pusat Bantuan</a></li>
<li><a class="hover:text-white transition-colors" href="#">Tutorial</a></li>
<li><a class="hover:text-white transition-colors" href="#">Komunitas</a></li>
<li><a class="hover:text-white transition-colors" href="#">Hubungi Kami</a></li>
</ul>
</div>
</div>
<div class="landing-footer-meta max-w-7xl mx-auto px-container-padding mt-20 pt-8 border-t border-gray-600 flex flex-col md:flex-row justify-between text-sm text-gray-300">
<p>© 2024 TokoQ Indonesia. Semua hak dilindungi undang-undang.</p>
<div class="flex gap-8 mt-4 md:md-0">
<a class="hover:text-white transition-colors" href="#">Kebijakan Privasi</a>
<a class="hover:text-white transition-colors" href="#">Syarat &amp; Ketentuan</a>
</div>
</div>
</footer>
<script src="../tokoq_design_system/responsive.js"></script>
</body></html>
