<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TokoQ - Sistem Kasir & Digital UMKM</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<script src="/js/tailwind-config.js"></script>
<style>
.material-symbols-outlined {
    font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
}
body {
    background-color: #ECFDF5;
    color: #374151;
    overflow-x: hidden;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInLeft {
    from { opacity: 0; transform: translateX(-40px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(40px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}
@keyframes floatSlow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-12px) rotate(3deg); }
}
@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.2); }
    50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.4); }
}
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes count-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes slideInStack {
    from { opacity: 0; transform: translateY(60px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes orbit {
    from { transform: rotate(0deg) translateX(120px) rotate(0deg); }
    to { transform: rotate(360deg) translateX(120px) rotate(-360deg); }
}
@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}
@keyframes bounce-subtle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
@keyframes wiggle {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-3deg); }
    75% { transform: rotate(3deg); }
}

.animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
.animate-fade-in-left { animation: fadeInLeft 0.8s ease-out forwards; }
.animate-fade-in-right { animation: fadeInRight 0.8s ease-out forwards; }
.animate-scale-in { animation: scaleIn 0.6s ease-out forwards; }
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-float-slow { animation: floatSlow 8s ease-in-out infinite; }
.animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
.animate-gradient { 
    background-size: 200% 200%;
    animation: gradient-shift 4s ease infinite; 
}
.animate-bounce-subtle { animation: bounce-subtle 2s ease-in-out infinite; }
.animate-wiggle { animation: wiggle 3s ease-in-out infinite; }

/* Scroll animations - hidden by default, shown when in view */
.reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
.reveal.visible {
    opacity: 1;
    transform: translateY(0);
}
.reveal-left {
    opacity: 0;
    transform: translateX(-40px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
.reveal-left.visible {
    opacity: 1;
    transform: translateX(0);
}
.reveal-right {
    opacity: 0;
    transform: translateX(40px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
.reveal-right.visible {
    opacity: 1;
    transform: translateX(0);
}
.reveal-scale {
    opacity: 0;
    transform: scale(0.85);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
.reveal-scale.visible {
    opacity: 1;
    transform: scale(1);
}

/* Stagger delays */
.delay-100 { transition-delay: 0.1s; }
.delay-200 { transition-delay: 0.2s; }
.delay-300 { transition-delay: 0.3s; }
.delay-400 { transition-delay: 0.4s; }
.delay-500 { transition-delay: 0.5s; }
.delay-600 { transition-delay: 0.6s; }

/* Gradient text */
.gradient-text {
    background: linear-gradient(135deg, #10B981 0%, #059669 50%, #047857 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Glass morphism */
.glass {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

/* Hero gradient background */
.hero-gradient {
    background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 30%, #A7F3D0 60%, #ECFDF5 100%);
    background-size: 200% 200%;
    animation: gradient-shift 8s ease infinite;
}

/* Card hover effects */
.card-lift {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.card-lift:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.15);
}

/* Glow button */
.btn-glow {
    position: relative;
    overflow: hidden;
}
.btn-glow::before {
    content: '';
    position: absolute;
    inset: -2px;
    background: linear-gradient(135deg, #10B981, #34D399, #10B981);
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
    border-radius: inherit;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s;
}
.btn-glow:hover::before {
    opacity: 1;
}

/* Shimmer effect */
.shimmer {
    background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%);
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}

/* Particle dots */
.particle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

/* Counter animation */
.counter-value {
    display: inline-block;
}

/* Navbar scroll effect */
.nav-scrolled {
    background: rgba(255, 255, 255, 0.95) !important;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
}

/* Image mockup tilt */
.mockup-tilt {
    transform: perspective(1000px) rotateY(-5deg) rotateX(2deg);
    transition: transform 0.5s ease;
}
.mockup-tilt:hover {
    transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
}

/* Step connector line */
.step-connector {
    position: relative;
}
.step-connector::after {
    content: '';
    position: absolute;
    top: 28px;
    left: 56px;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #10B981, #D1FAE5);
}

/* Bento card hover */
.bento-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.bento-card:hover {
    transform: scale(1.02);
    z-index: 10;
}

/* Impact counter */
.impact-stat {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
}

/* Footer gradient */
.footer-gradient {
    background: linear-gradient(180deg, #1F2937 0%, #111827 100%);
}

/* Mobile menu */
.mobile-menu {
    transform: translateY(-100%);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.mobile-menu.open {
    transform: translateY(0);
    opacity: 1;
}

/* Scrollbar */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #ECFDF5; }
::-webkit-scrollbar-thumb { background: #10B981; border-radius: 10px; }
</style>
</head>
<body class="font-body-md">

<!-- ===== NAVIGATION ===== -->
<header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/60 backdrop-blur-xl border-b border-white/20">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="#" class="flex items-center gap-2.5 group">
            <div class="w-9 h-9 bg-gradient-to-br from-primary to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-white text-[18px]">storefront</span>
            </div>
            <span class="text-lg font-extrabold gradient-text">TokoQ</span>
        </a>

        <nav class="hidden md:flex items-center gap-8">
            <a href="#fitur" class="text-sm font-medium text-gray-500 hover:text-primary transition-colors">Fitur</a>
            <a href="#cara-kerja" class="text-sm font-medium text-gray-500 hover:text-primary transition-colors">Cara Kerja</a>
            <a href="#dampak" class="text-sm font-medium text-gray-500 hover:text-primary transition-colors">Dampak</a>
            <a href="/login" class="text-sm font-medium text-gray-500 hover:text-primary transition-colors">Masuk</a>
            <a href="/register" class="px-5 py-2.5 bg-gradient-to-r from-primary to-emerald-600 text-white text-sm font-bold rounded-full shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 hover:scale-105 transition-all">
                Daftar Gratis
            </a>
        </nav>

        <button id="mobile-menu-btn" class="md:hidden w-10 h-10 rounded-xl flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu md:hidden absolute top-16 left-0 right-0 bg-white/95 backdrop-blur-xl border-b border-gray-100 shadow-xl">
        <nav class="p-6 space-y-4">
            <a href="#fitur" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Fitur</a>
            <a href="#cara-kerja" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Cara Kerja</a>
            <a href="#dampak" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Dampak</a>
            <a href="/login" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Masuk</a>
            <a href="/register"="block w-full text-center px-5 py-3 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl shadow-lg">
                Daftar Gratis
            </a>
        </nav>
    </div>
</header>

<main>
<!-- ===== HERO SECTION ===== -->
<section class="relative min-h-screen flex items-center hero-gradient overflow-hidden pt-16">
    <!-- Floating particles -->
    <div class="particle w-3 h-3 bg-primary/20 top-1/4 left-[10%] animate-float" style="animation-delay: 0s;"></div>
    <div class="particle w-2 h-2 bg-emerald-400/30 top-1/3 right-[15%] animate-float" style="animation-delay: 1s;"></div>
    <div class="particle w-4 h-4 bg-primary/10 bottom-1/4 left-[20%] animate-float-slow" style="animation-delay: 2s;"></div>
    <div class="particle w-2.5 h-2.5 bg-teal-400/20 top-1/2 right-[25%] animate-float" style="animation-delay: 0.5s;"></div>
    <div class="particle w-3 h-3 bg-green-300/15 bottom-1/3 right-[10%] animate-float-slow" style="animation-delay: 1.5s;"></div>

    <!-- Large decorative circles -->
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-48 -left-48 w-[500px] h-[500px] bg-emerald-200/20 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 py-20 lg:py-0 w-full">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Left: Text -->
            <div class="space-y-8">
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full text-xs font-bold text-primary border border-primary/10 shadow-sm">
                        <span class="material-symbols-outlined text-[14px] text-primary">verified</span>
                        SOLUSI DIGITAL UMKM INDONESIA
                    </div>
                </div>

                <h1 class="animate-fade-in-up delay-100 text-4xl md:text-5xl lg:text-[56px] font-extrabold leading-[1.1]">
                    <span class="text-gray-800">Sistem Kasir &</span><br/>
                    <span class="gradient-text">Digital</span><br/>
                    <span class="text-gray-800">untuk UMKM</span>
                </h1>

                <p class="animate-fade-in-up delay-200 text-lg text-gray-500 max-w-lg leading-relaxed">
                    Kelola stok barang, catat penjualan otomatis, dan pantau performa toko Anda melalui satu dashboard cerdas yang terasa nyata.
                </p>

                <div class="animate-fade-in-up delay-300 flex flex-wrap gap-4">
                    <a href="/register" class="btn-glow group px-8 py-4 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-primary/25 hover:shadow-2xl hover:shadow-primary/35 hover:scale-105 transition-all flex items-center gap-2">
                        Daftar Toko Saya
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="#fitur" class="px-8 py-4 bg-white text-primary font-bold rounded-2xl border-2 border-primary/10 hover:border-primary/30 hover:bg-primary/5 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">play_circle</span>
                        Lihat Fitur
                    </a>
                </div>

                <!-- Trust badges -->
                <div class="animate-fade-in-up delay-400 flex items-center gap-6 pt-4">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 border-2 border-white"></div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">10.000+</p>
                            <p class="text-[10px] text-gray-400">UMKM Bergabung</p>
                        </div>
                    </div>
                    <div class="h-8 w-px bg-gray-200"></div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-amber-400 text-[18px]">star</span>
                        <span class="text-sm font-bold text-gray-800">4.9</span>
                        <span class="text-xs text-gray-400">Rating</span>
                    </div>
                </div>
            </div>

            <!-- Right: Dashboard Mockup -->
            <div class="relative animate-fade-in-right delay-200">
                <!-- Orbiting elements -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="w-[500px] h-[500px] border border-primary/5 rounded-full"></div>
                </div>

                <div class="relative">
                    <!-- Main mockup card -->
                    <div class="mockup-tilt bg-white p-3 rounded-3xl shadow-2xl shadow-primary/10 border border-gray-100 animate-float-slow">
                        <img alt="Dashboard TokoQ" class="rounded-2xl w-full h-auto" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYU9VD48rS3kvGDQYNd9vXImbRCRJ3TCWeSba83rjjHkZLKQbwfl8tZHRlNjeTLnwH4sPnHK0XC89H_lGNDyKkpMldYRTCdrC1LwsG4HOeaJQjtxTrcGebCTprcsnLpUIViTstqlYn90O52s_GAQ1h7I13ISDr9vCQqD4XSGTQl38uQBTAltMUywJXnE2KwN99jA0Z6GGQULPRtek-pIkRxJoD_2kwO0gyT7S5B45p7Kw27GKE7d5E0NpLlN1Ga-XZPoJXULwFsvk"/>
                    </div>

                    <!-- Floating AI Insight Card -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl border-l-4 border-primary max-w-[220px] animate-float" style="animation-delay: 1s;">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-7 h-7 bg-primary/10 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-[16px]">psychology</span>
                            </div>
                            <span class="font-bold text-xs text-gray-800">AI Insight</span>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed">Stok krupuk pedas diprediksi habis dalam 3 hari. Restok sekarang?</p>
                    </div>

                    <!-- Floating stat card -->
                    <div class="absolute -top-4 -right-4 bg-white p-3 rounded-2xl shadow-xl animate-float" style="animation-delay: 2s;">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 gradient-success rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-[16px]">trending_up</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-800">+24%</p>
                                <p class="text-[10px] text-gray-400">Penjualan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce-subtle">
        <div class="w-6 h-10 rounded-full border-2 border-gray-300 flex items-start justify-center p-1.5">
            <div class="w-1.5 h-3 bg-primary rounded-full"></div>
        </div>
    </div>
</section>

<!-- ===== PROBLEM SECTION ===== -->
<section class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-[#ECFDF5] to-transparent"></div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 rounded-full text-xs font-bold text-red-500 mb-4">
                <span class="material-symbols-outlined text-[14px]">error</span>
                MASALAH UMUM
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Masalah yang Sering Dialami<br/>Toko Kecil</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Seringkali pengelolaan manual menghambat pertumbuhan bisnis Anda. Saatnya beralih dari cara lama.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="reveal delay-100 card-lift bg-gradient-to-br from-red-50 to-orange-50 p-8 rounded-3xl border border-red-100">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm animate-wiggle">
                    <span class="material-symbols-outlined text-3xl text-red-400">edit_note</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-3">Pencatatan Manual</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Buku nota sering hilang, kotor, atau salah hitung. Memakan waktu lama saat rekap akhir bulan.</p>
            </div>

            <!-- Card 2 -->
            <div class="reveal delay-200 card-lift bg-gradient-to-br from-amber-50 to-yellow-50 p-8 rounded-3xl border border-amber-100">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm animate-wiggle" style="animation-delay: 0.5s;">
                    <span class="material-symbols-outlined text-3xl text-amber-400">inventory</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-3">Stok Tidak Terkontrol</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Barang habis tanpa diketahui, pelanggan kecewa, dan modal tertahan di barang yang tidak laku.</p>
            </div>

            <!-- Card 3 -->
            <div class="reveal delay-300 card-lift bg-gradient-to-br from-purple-50 to-indigo-50 p-8 rounded-3xl border border-purple-100">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm animate-wiggle" style="animation-delay: 1s;">
                    <span class="material-symbols-outlined text-3xl text-purple-400">leak_remove</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-3">Laba Tidak Jelas</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Uang toko dan uang pribadi sering tercampur. Sulit menentukan apakah bisnis untung atug.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== SOLUTION / BENTO GRID ===== -->
<section id="fitur" class="py-24 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 rounded-full text-xs font-bold text-primary mb-4">
                <span class="material-symbols-outlined text-[14px]">auto_awesome</span>
                SOLUSI LENGKAP
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Satu Dashboard untuk<br/>Operasional Toko</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Kami menggabungkan kemudahan penggunaan dengan kecanggihan prediksi AI.</p>
        </div>

        <div class="grid md:grid-cols-4 md:grid-rows-2 gap-5 h-auto md:h-[550px]">
            <!-- Kasir POS (large) -->
            <div class="reveal-scale delay-100 md:col-span-2 md:row-span-2 bento-card bg-gradient-to-br from-primary to-emerald-600 p-8 rounded-3xl text-white flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[32px] text-white">point_of_sale</span>
                    </div>
                    <h3 class="text-2xl font-extrabold mb-3">Kasir POS Cepat</h3>
                    <p class="text-white/80 text-sm leading-relaxed max-w-xs">Transaksi lancar bahkan saat ramai. Mendukung pembayaran tunai dan QRIS otomatis.</p>
                </div>
                <div class="relative z-10 flex gap-2 mt-6">
                    <span class="px-3 py-1 bg-white/15 rounded-full text-xs font-bold backdrop-blur-sm">RESPONSIF</span>
                    <span class="px-3 py-1 bg-white/15 rounded-full text-xs font-bold backdrop-blur-sm">CETAK NOTA</span>
                </div>
            </div>

            <!-- Inventori -->
            <div class="reveal-scale delay-200 md:col-span-2 bento-card bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[32px] text-blue-500">inventory_2</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-1">Inventori Otomatis</h3>
                    <p class="text-sm text-gray-500">Stok berkurang otomatis setiap penjualan. Notifikasi stok menipis real-time.</p>
                </div>
            </div>

            <!-- Prediksi AI -->
            <div class="reveal-scale delay-300 md:col-span-1 bento-card bg-gradient-to-br from-purple-500 to-indigo-600 p-6 rounded-3xl text-white flex flex-col justify-between">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[24px]">psychology</span>
                </div>
                <div>
                    <h3 class="font-bold mb-1">Prediksi AI</h3>
                    <p className="text-xs text-white/70">Tahu kapan harus belanja barang lagi.</p>
                </div>
            </div>

            <!-- Laporan -->
            <div class="reveal-scale delay-400 md:col-span-1 bento-card bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[24px] text-amber-500">description</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-1">Laporan</h3>
                    <p class="text-xs text-gray-500">Laba rugi harian siap dalam satu klik.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section id="cara-kerja" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-full text-xs font-bold text-blue-500 mb-4">
                <span class="material-symbols-outlined text-[14px]">rocket_launch</span>
                MUDAH DIGUNAKAN
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Mulai dalam 3 Langkah<br/>Sederhana</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8 relative">
            <!-- Connector line (desktop) -->
            <div class="hidden md:block absolute top-14 left-[20%] right-[20%] h-0.5 bg-gradient-to-r from-primary/30 via-primary/50 to-primary/30"></div>

            <!-- Step 1 -->
            <div class="reveal delay-100 text-center relative">
                <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-primary/10 to-emerald-100 rounded-3xl flex items-center justify-center relative">
                    <span class="material-symbols-outlined text-5xl text-primary">add_box</span>
                    <div class="absolute -top-3 -right-3 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg shadow-primary/30">1</div>
                </div>
                <h3 className="text-lg font-bold text-gray-800 mb-2">Tambah Produk</h3>
                <p class="text-sm text-gray-500 max-w-xs mx-auto">Unggah foto dan atur harga produk Anda dengan mudah lewat HP atau Komputer.</p>
            </div>

            <!-- Step 2 -->
            <div class="reveal delay-200 text-center relative">
                <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-3xl flex items-center justify-center relative">
                    <span class="material-symbols-outlined text-5xl text-blue-500">point_of_sale</span>
                    <div class="absolute -top-3 -right-3 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg shadow-blue-500/30">2</div>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Catat Transaksi</h3>
                <p class="text-sm text-gray-500 max-w-xs mx-auto">Input pesanan pelanggan dengan cepat. Sistem otomatis memotong stok barang.</p>
            </div>

            <!-- Step 3 -->
            <div class="reveal delay-300 text-center relative">
                <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-purple-50 to-indigo-100 rounded-3xl flex items-center justify-center relative">
                    <span class="material-symbols-outlined text-5xl text-purple-500">insights</span>
                    <div class="absolute -top-3 -right-3 w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg shadow-purple-500/30">3</div>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Pantau Insight</h3>
                <p class="text-sm text-gray-500 max-w-xs mx-auto">Lihat grafik penjualan dan prediksi kebutuhan barang untuk hari esok.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== IMPACT SECTION ===== -->
<section id="dampak" class="py-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 rounded-[40px] p-10 md:p-16 text-white relative overflow-hidden">
            <!-- Decorative -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-2xl -ml-32 -mb-32"></div>

            <div class="grid md:grid-cols-2 gap-12 items-center relative z-10">
                <div class="reveal-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/20 rounded-full text-xs font-bold text-emerald-400 mb-6">
                        <span class="material-symbols-outlined text-[14px]">trending_up</span>
                        DAMPAK NYATA
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-8">Dampak Nyata untuk Pertumbuhan Bisnis Anda</h2>

                    <ul class="space-y-5">
                        <li class="flex gap-4 items-start">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-primary/30">
                                <span class="material-symbols-outlined text-white text-[18px]">check</span>
                            </div>
                            <div>
                                <p class="font-bold text-white">Kurangi Risiko Stok Kosong hingga 40%</p>
                                <p class="text-sm text-gray-400">Dengan peringatan dini berbasis kebiasaan belanja pelanggan.</p>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-primary/30">
                                <span class="material-symbols-outlined text-white text-[18px]">check</span>
                            </div>
                            <div>
                                <p class="font-bold text-white">Keputusan Berbasis Data (Data-Driven)</p>
                                <p class="text-sm text-gray-400">Tentukan promosi yang tepat berdasarkan produk paling laris.</p>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-primary/30">
                                <span class="material-symbols-outlined text-white text-[18px]">check</span>
                            </div>
                            <div>
                                <p class="font-bold text-white">Efisiensi Waktu Rekapitulasi</p>
                                <p class="text-sm text-gray-400">Hemat 2 jam setiap hari yang biasanya digunakan untuk menghitung kasir manual.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="reveal-right grid grid-cols-2 gap-4">
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img alt="UMKM Activity" class="w-full h-56 object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrWZwq7BYf8QJgFJm1WWEu_YBGzYxdSmjRyff-PJdSrOpzrfFT9xZDQhtgeGjlxneA4GHys4m7zYMFXxdHMNTrZ13rBdoVIezAfP7uPwpicjBNdFX-FbsMUxQdfPLnAe-lVrm24BEw2mIioyBrrQoyvAi7DZ7wsSqimVMtQJcz-VTKyNmq8_w2_IUTXsaBuS9H0e3fdWbYNz1QioXcBdFeESunM1cwJZmHrJt9sfvpX3093TQwpI_2XDMOT1Tj5BHIIsTCEWvLK4M"/>
                    </div>
                    <div class="bg-gradient-to-br from-primary to-emerald-600 p-6 rounded-3xl flex flex-col justify-center items-center text-center shadow-2xl shadow-primary/20">
                        <div class="text-4xl font-extrabold text-white mb-1">10k+</div>
                        <div class="text-sm text-white/80 font-medium">UMKM Bergabung</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIAL / SOCIAL PROOF ===== -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 rounded-full text-xs font-bold text-amber-600 mb-4">
                <span class="material-symbols-outlined text-[14px]">format_quote</span>
                TESTIMONI
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Apa Kata Pengguna TokoQ?</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="reveal delay-100 bg-gray-50 p-6 rounded-3xl border border-gray-100 card-lift">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <span class="material-symbols-outlined text-amber-400 text-[18px]">star</span>
                    @endfor
                </div>
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">"Sejak pakai TokoQ, stok barang saya selalu terkontrol. Tidak ada lagi pelanggan kecewa karena barang habis."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-sm">S</div>
                    <div>
                        <p class="font-bold text-sm text-gray-800">Sari Dewi</p>
                        <p class="text-xs text-gray-400">Pemilik Toko Kelontong</p>
                    </div>
                </div>
            </div>

            <div class="reveal delay-200 bg-gray-50 p-6 rounded-3xl border border-gray-100 card-lift">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <span class="material-symbols-outlined text-amber-400 text-[18px]">star</span>
                    @endfor
                </div>
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">"Fitur prediksi AI-nya sangat membantu. Saya jadi tahu kapan harus restok barang tanpa harus menghitung manual."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm">B</div>
                    <div>
                        <p class="font-bold text-sm text-gray-800">Budi Santoso</p>
                        <p class="text-xs text-gray-400">Pemilik Warung Makan</p>
                    </div>
                </div>
            </div>

            <div class="reveal delay-300 bg-gray-50 p-6 rounded-3xl border border-gray-100 card-lift">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <span class="material-symbols-outlined text-amber-400 text-[18px]">star</span>
                    @endfor
                </div>
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">"Laporan keuangan yang dulu ribet sekarang jadi satu klik. TokoQ benar-benar menghemat waktu saya setiap hari."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold text-sm">R</div>
                    <div>
                        <p class="font-bold text-sm text-gray-800">Rina Wati</p>
                        <p class="text-xs text-gray-400">Pemilik Toko Sembako</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FINAL CTA ===== -->
<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 hero-gradient"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-3xl mx-auto px-6 text-center relative z-10">
        <div class="reveal">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-primary/30 animate-pulse-glow">
                <span class="material-symbols-outlined text-white text-[40px]">rocket_launch</span>
            </div>

            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-800 mb-6">Bantu Toko Anda<br/>Naik Kelas Bersama TokoQ</h2>
            <p class="text-lg text-gray-500 mb-10 max-w-lg mx-auto">Bergabunglah dengan ribuan pengusaha UMKM lainnya yang telah mendigitalisasi operasional mereka. Sederhana, cerdas, dan terjangkau.</p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="btn-glow group px-10 py-5 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold text-lg rounded-2xl shadow-2xl shadow-primary/30 hover:shadow-3xl hover:scale-105 transition-all flex items-center justify-center gap-2">
                    Mulai Sekarang — Gratis 14 Hari
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
                <a href="/register" class="px-10 py-5 bg-white text-primary font-bold text-lg rounded-2xl border-2 border-primary/10 hover:border-primary/30 hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">chat</span>
                    Hubungi Sales
                </a>
            </div>

            <p class="text-sm text-gray-400 mt-6">✓ Gratis 14 hari &nbsp; ✓ Tanpa kartu kredit &nbsp; ✓ Batal kapan saja</p>
        </div>
    </div>
</section>
</main>

<!-- ===== FOOTER ===== -->
<footer class="footer-gradient text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-10 mb-12">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-5">
                    <div class="w-9 h-9 bg-gradient-to-br from-primary to-emerald-600 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-[18px]">storefront</span>
                    </div>
                    <span class="text-lg font-extrabold text-white">TokoQ</span>
                </div>
                <p class="text-gray-400 text-sm max-w-sm mb-6 leading-relaxed">Mendigitalisasi UMKM Indonesia melalui solusi kasir dan inventori berbasis AI yang intuitif dan mudah digunakan.</p>
                <div class="flex gap-3">
                    <a class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-primary transition-colors" href="#"><span class="material-symbols-outlined text-[18px]">language</span></a>
                    <a class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-primary transition-colors" href="#"><span class="material-symbols-outlined text-[18px]">group</span></a>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-white mb-5">Produk</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a class="hover:text-white transition-colors" href="#">Sistem Kasir</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Manajemen Stok</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Laporan Keuangan</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Harga</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-white mb-5">Dukungan</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a class="hover:text-white transition-colors" href="#">Pusat Bantuan</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Tutorial</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Komunitas</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500">&copy; 2025 TokoQ Indonesia. Semua hak dilindungi.</p>
            <div class="flex gap-6 text-sm text-gray-500">
                <a class="hover:text-white transition-colors" href="#">Kebijakan Privasi</a>
                <a class="hover:text-white transition-colors" href="#">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<script>
// ===== NAVBAR SCROLL EFFECT =====
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('nav-scrolled');
    } else {
        navbar.classList.remove('nav-scrolled');
    }
});

// ===== MOBILE MENU =====
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        const icon = mobileMenuBtn.querySelector('.material-symbols-outlined');
        icon.textContent = mobileMenu.classList.contains('open') ? 'close' : 'menu';
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            mobileMenuBtn.querySelector('.material-symbols-outlined').textContent = 'menu';
        });
    });
}

// ===== SCROLL REVEAL =====
const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
});

revealElements.forEach(el => revealObserver.observe(el));

// ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// ===== COUNTER ANIMATION =====
function animateCounter(element, target, suffix = '', duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            start = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(start).toLocaleString('id-ID') + suffix;
    }, 16);
}

// Trigger counter when impact section is visible
const impactSection = document.querySelector('#dampak');
if (impactSection) {
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target.querySelector('.counter-value');
                if (counter && !counter.dataset.animated) {
                    counter.dataset.animated = 'true';
                    animateCounter(counter, 10000, '+');
                }
            }
        });
    }, { threshold: 0.5 });

    const statElement = document.querySelector('#dampak .impact-stat');
    if (statElement) counterObserver.observe(statElement.parentElement);
}
</script>
</body>
</html>
