<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TokoQ - Kasir, Stok & Laporan Toko dalam Satu Aplikasi</title>
<meta name="description" content="TokoQ membantu UMKM Indonesia mengelola kasir, stok barang, dan laporan keuangan dalam satu dashboard. Gratis 14 hari. Tanpa kartu kredit."/>
<meta property="og:title" content="TokoQ - Kasir, Stok & Laporan Toko dalam Satu Aplikasi"/>
<meta property="og:description" content="Kelola stok barang, catat penjualan otomatis, dan pantau performa toko Anda melalui satu dashboard cerdas. Gratis 14 hari."/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="https://tokoq.id"/>
<link rel="canonical" href="https://tokoq.id"/>
<meta property="og:image" content="/images/og-tokoq.png"/>
<meta property="og:locale" content="id_ID"/>
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:title" content="TokoQ - Kasir, Stok & Laporan Toko dalam Satu Aplikasi"/>
<meta name="twitter:description" content="Kelola stok barang, catat penjualan otomatis, dan pantau performa toko Anda. Gratis 14 hari."/>
<meta name="twitter:image" content="/images/og-tokoq.png"/>
<link rel="icon" type="image/png" href="/images/favicon.png"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
section[id] { scroll-margin-top: 96px; }
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
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
@keyframes bounce-subtle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
.animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
.animate-gradient {
    background-size: 200% 200%;
    animation: gradient-shift 4s ease infinite;
}
.animate-bounce-subtle { animation: bounce-subtle 2s ease-in-out infinite; }
.reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.reveal.visible {
    opacity: 1;
    transform: translateY(0);
}
@media (prefers-reduced-motion: reduce) {
    .reveal { opacity: 1; transform: none; transition: none; }
}
.reveal-scale {
    opacity: 0;
    transform: scale(0.92);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.reveal-scale.visible {
    opacity: 1;
    transform: scale(1);
}
@media (prefers-reduced-motion: reduce) {
    .reveal-scale { opacity: 1; transform: none; transition: none; }
}
.delay-100 { transition-delay: 0.1s; }
.delay-200 { transition-delay: 0.2s; }
.delay-300 { transition-delay: 0.3s; }
.delay-400 { transition-delay: 0.4s; }
.gradient-text {
    background: linear-gradient(135deg, #10B981 0%, #059669 50%, #047857 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.glass {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}
.hero-gradient {
    background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 30%, #A7F3D0 60%, #ECFDF5 100%);
    background-size: 200% 200%;
    animation: gradient-shift 8s ease infinite;
}
.card-lift {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.card-lift:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.15);
}
.btn-glow {
    position: relative;
    overflow: hidden;
}
.nav-scrolled {
    background: rgba(255, 255, 255, 0.95) !important;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
}
.nav-link {
    color: rgba(255, 255, 255, 0.85);
    transition: color 0.3s ease;
}
.nav-link:hover { color: #ffffff; }
.nav-scrolled .nav-link { color: #4B5563; }
.nav-scrolled .nav-link:hover { color: #10B981; }
.nav-brand { color: #ffffff; transition: color 0.3s ease; }
.nav-scrolled .nav-brand { color: #10B981; }
.nav-mobile-btn { color: #ffffff; transition: color 0.3s ease; }
.nav-mobile-btn:hover { background: rgba(255,255,255,0.1); }
.nav-scrolled .nav-mobile-btn { color: #4B5563; }
.nav-scrolled .nav-mobile-btn:hover { background: #F3F4F6; }
@keyframes navDrop {
    from { opacity: 0; transform: translateY(-100%); }
    to { opacity: 1; transform: translateY(0); }
}
.nav-drop { animation: navDrop 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
.hero-bg {
    background-image: url('/images/bg-hero.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
.hero-section {
    min-height: 100vh;
    min-height: 100svh;
}
@supports (min-height: 100dvh) {
    .hero-section { min-height: 100dvh; }
}
.impact-stat {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
}
.footer-gradient {
    background: linear-gradient(180deg, #1F2937 0%, #111827 100%);
}
.mobile-menu {
    transform: translateY(-100%);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.mobile-menu.open {
    transform: translateY(0);
    opacity: 1;
}
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #ECFDF5; }
::-webkit-scrollbar-thumb { background: #10B981; border-radius: 10px; }
.scroll-progress {
    position: fixed; top: 0; left: 0; width: 0%; height: 3px;
    background: linear-gradient(90deg, #10B981, #34D399, #059669);
    z-index: 9999; transition: width 0.1s linear;
}
@keyframes float-particle {
    0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
    25% { transform: translateY(-30px) rotate(90deg); opacity: 0.6; }
    50% { transform: translateY(-15px) rotate(180deg); opacity: 0.4; }
    75% { transform: translateY(-40px) rotate(270deg); opacity: 0.5; }
}
.scroll-particle {
    position: absolute; border-radius: 50%; pointer-events: none;
    animation: float-particle 6s ease-in-out infinite;
}
.faq-answer {
    max-height: 0; overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease;
}
.faq-item.open .faq-answer { max-height: 300px; }
.faq-item.open .faq-icon { transform: rotate(180deg); }
.faq-icon { transition: transform 0.3s ease; }
.demo-mockup {
    border-radius: 16px;
    box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.15);
    overflow: hidden; border: 1px solid #E5E7EB;
}
.demo-browser-bar {
    background: #F3F4F6; padding: 12px 16px;
    display: flex; align-items: center; gap: 8px;
    border-bottom: 1px solid #E5E7EB;
}
.demo-dot { width: 10px; height: 10px; border-radius: 50%; }
.demo-tab {
    background: white; border-radius: 6px; padding: 4px 12px;
    font-size: 0.7rem; color: #6B7280; margin-left: 8px;
    border: 1px solid #E5E7EB;
}
.demo-tab-btn { transition: all 0.2s ease; }
.demo-tab-btn.active { background: #10B981; color: white; }
.demo-panel { display: none; }
.demo-panel.active { display: block; }
</style>
</head>
<body class="font-body-md">

<div class="scroll-progress" id="scroll-progress"></div>
<div id="particles" class="fixed inset-0 pointer-events-none z-0 overflow-hidden"></div>

<!-- NAVIGATION -->
<header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-transparent border-b border-transparent">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="#" class="flex items-center gap-2.5 group">
            <img src="/images/logo-tokoq.png" alt="TokoQ" width="150" height="40" class="group-hover:scale-105 transition-transform"/>
        </a>
        <nav class="hidden md:flex items-center gap-8">
            <a href="#fitur" class="nav-link text-sm font-medium transition-colors">Fitur</a>
            <a href="#demo" class="nav-link text-sm font-medium transition-colors">Demo</a>
            <a href="#harga" class="nav-link text-sm font-medium transition-colors">Harga</a>
            <a href="#faq" class="nav-link text-sm font-medium transition-colors">FAQ</a>
            <a href="/login" class="nav-link text-sm font-medium transition-colors">Masuk</a>
            <a href="/register" class="px-5 py-2.5 bg-white text-primary text-sm font-bold rounded-full shadow-lg hover:shadow-xl hover:scale-105 transition-all">Coba Gratis</a>
        </nav>
        <button id="mobile-menu-btn" class="nav-mobile-btn md:hidden w-10 h-10 rounded-xl flex items-center justify-center transition-colors">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
    <div id="mobile-menu" class="mobile-menu md:hidden absolute top-16 left-0 right-0 bg-white/95 backdrop-blur-xl border-b border-gray-100 shadow-xl">
        <nav class="p-6 space-y-4">
            <a href="#fitur" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Fitur</a>
            <a href="#demo" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Demo</a>
            <a href="#harga" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Harga</a>
            <a href="#faq" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">FAQ</a>
            <a href="/login" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Masuk</a>
            <a href="/register" class="block w-full text-center px-5 py-3 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl shadow-lg">Coba Gratis 14 Hari</a>
        </nav>
    </div>
</header>

<main>
<!-- HERO -->
<section class="hero-section relative flex items-center hero-bg overflow-hidden pt-16">
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/60 via-emerald-800/40 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-0 w-full relative z-10">
        <div class="max-w-2xl">
            <div class="space-y-6">
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/15 backdrop-blur-sm rounded-full text-xs font-bold text-white border border-white/20">
                        <span class="material-symbols-outlined text-[14px] text-emerald-300">verified</span>
                        SOLUSI DIGITAL UNTUK UMKM INDONESIA
                    </div>
                </div>
                <h1 class="animate-fade-in-up delay-100 text-4xl md:text-5xl lg:text-[56px] font-extrabold leading-[1.1] text-white drop-shadow-lg">
                    Kasir, Stok &amp;<br/>
                    Laporan Toko<br/>
                    dalam Satu Aplikasi
                </h1>
                <p class="animate-fade-in-up delay-200 text-lg text-white/80 max-w-lg leading-relaxed drop-shadow-sm">
                    Kelola stok barang, catat penjualan otomatis, dan pantau performa toko Anda melalui satu dashboard cerdas. Dilengkapi AI untuk prediksi restok.
                </p>
                <div class="animate-fade-in-up delay-300 flex flex-wrap gap-4">
                    <a href="/register" class="btn-glow group px-8 py-4 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-primary/25 hover:shadow-2xl hover:shadow-primary/35 hover:scale-105 transition-all flex items-center gap-2">
                        Coba Gratis 14 Hari
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="#demo" class="px-8 py-4 bg-white/15 backdrop-blur-sm text-white font-bold rounded-2xl border border-white/20 hover:bg-white/25 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">play_circle</span>
                        Lihat Demo
                    </a>
                </div>
                <div class="animate-fade-in-up delay-400 flex items-center gap-6 pt-2">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 border-2 border-white/30"></div>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 border-2 border-white/30"></div>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 border-2 border-white/30"></div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">UMKM Beta</p>
                            <p class="text-[10px] text-white/60">sedang mencoba TokoQ</p>
                        </div>
                    </div>
                    <div class="h-8 w-px bg-white/20"></div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-emerald-400 text-[18px]">verified</span>
                        <span class="text-sm font-bold text-white">Feedback beta positif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2">
            <p class="text-white/50 text-[10px] uppercase tracking-[0.3em]">Scroll</p>
            <div class="w-5 h-8 rounded-full border-2 border-white/30 flex items-start justify-center p-1">
                <div class="w-1 h-2 bg-white/60 rounded-full animate-bounce-subtle"></div>
            </div>
        </div>
    </div>
</section>

<!-- PROBLEM -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-[#ECFDF5] to-transparent"></div>
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 rounded-full text-xs font-bold text-red-500 mb-4">
                <span class="material-symbols-outlined text-[14px]">error</span>
                MASALAH UMUM
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Masalah yang Sering Dialami<br/>Toko Kecil</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Seringkali pengelolaan manual menghambat pertumbuhan bisnis Anda. Saatnya beralih dari cara lama.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="reveal delay-100 group relative flex flex-col justify-between w-full p-6 overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out hover:scale-[1.02] min-h-[200px] bg-red-500/90 text-white">
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-3xl text-white">edit_note</span>
                    </div>
                    <h3 class="text-2xl font-bold tracking-tight">Pencatatan Manual</h3>
                    <p class="text-sm text-white/80 mt-2 leading-relaxed">Buku nota sering hilang, kotor, atau salah hitung.</p>
                </div>
                <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=200&amp;h=200&amp;fit=crop" alt="Messy notebook" class="absolute -right-6 -bottom-6 w-32 h-32 object-contain opacity-80 group-hover:opacity-100 group-hover:scale-110 group-hover:rotate-6 transition-all duration-400 ease-in-out rounded-2xl" loading="lazy"/>
            </div>
            <div class="reveal delay-200 group relative flex flex-col justify-between w-full p-6 overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out hover:scale-[1.02] min-h-[200px] bg-gray-600 text-white">
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-3xl text-white">inventory</span>
                    </div>
                    <h3 class="text-2xl font-bold tracking-tight">Stok Tidak Terkontrol</h3>
                    <p class="text-sm text-white/80 mt-2 leading-relaxed">Barang habis tanpa diketahui, pelanggan kecewa.</p>
                </div>
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=200&amp;h=200&amp;fit=crop" alt="Empty shelf" class="absolute -right-6 -bottom-6 w-32 h-32 object-contain opacity-80 group-hover:opacity-100 group-hover:scale-110 group-hover:rotate-6 transition-all duration-400 ease-in-out rounded-2xl" loading="lazy"/>
            </div>
            <div class="reveal delay-300 group relative flex flex-col justify-between w-full p-6 overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out hover:scale-[1.02] min-h-[200px] bg-blue-500/90 text-white">
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-3xl text-white">account_balance_wallet</span>
                    </div>
                    <h3 class="text-2xl font-bold tracking-tight">Laba Tidak Jelas</h3>
                    <p class="text-sm text-white/80 mt-2 leading-relaxed">Uang toko dan pribadi sering tercampur.</p>
                </div>
                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=200&amp;h=200&amp;fit=crop" alt="Calculator and money" class="absolute -right-6 -bottom-6 w-32 h-32 object-contain opacity-80 group-hover:opacity-100 group-hover:scale-110 group-hover:rotate-6 transition-all duration-400 ease-in-out rounded-2xl" loading="lazy"/>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES GRID -->
<section id="fitur" class="py-20 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 rounded-full text-xs font-bold text-primary mb-4">
                <span class="material-symbols-outlined text-[14px]">auto_awesome</span>
                SOLUSI LENGKAP
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Satu Dashboard untuk<br/>Operasional Toko</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Klik fitur di bawah untuk melihat detail lengkap. Semua ada dalam satu platform.</p>
        </div>
        <div id="fluid-grid" class="w-full max-w-2xl mx-auto">
            <div class="grid grid-cols-2 grid-rows-2 gap-5 w-full h-[300px] sm:h-[400px] md:h-[460px] transition-all duration-500 ease-in-out">
                <div class="fluid-card relative cursor-pointer group w-full h-full rounded-[32px] overflow-hidden bg-zinc-100" data-id="kasir" data-color="#10B981" onclick="expandGridItem(this)">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&amp;auto=format&amp;fit=crop&amp;q=60" alt="Kasir POS" class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"/>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-700"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px]" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                    <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white z-10 select-none">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-medium mb-1 tracking-tight">Kasir POS</h3>
                        <p class="text-xs sm:text-sm text-white/80 font-normal">Transaksi cepat &amp; QRIS otomatis</p>
                    </div>
                </div>
                <div class="fluid-card relative cursor-pointer group w-full h-full rounded-[32px] overflow-hidden bg-zinc-100" data-id="inventori" data-color="#3B82F6" onclick="expandGridItem(this)">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=600&amp;auto=format&amp;fit=crop&amp;q=60" alt="Inventori" class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"/>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-700"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px]" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                    <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white z-10 select-none">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-medium mb-1 tracking-tight">Inventori</h3>
                        <p class="text-xs sm:text-sm text-white/80 font-normal">Stok otomatis &amp; notifikasi real-time</p>
                    </div>
                </div>
                <div class="fluid-card relative cursor-pointer group w-full h-full rounded-[32px] overflow-hidden bg-zinc-100" data-id="ai" data-color="#8B5CF6" onclick="expandGridItem(this)">
                    <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?w=600&amp;auto=format&amp;fit=crop&amp;q=60" alt="AI Prediksi" class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"/>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-700"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px]" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                    <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white z-10 select-none">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-medium mb-1 tracking-tight">Prediksi AI</h3>
                        <p class="text-xs sm:text-sm text-white/80 font-normal">Tahu kapan harus restok barang</p>
                    </div>
                </div>
                <div class="fluid-card relative cursor-pointer group w-full h-full rounded-[32px] overflow-hidden bg-zinc-100" data-id="laporan" data-color="#F59E0B" onclick="expandGridItem(this)">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&amp;auto=format&amp;fit=crop&amp;q=60" alt="Laporan" class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"/>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-700"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px]" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                    <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white z-10 select-none">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-medium mb-1 tracking-tight">Laporan</h3>
                        <p class="text-xs sm:text-sm text-white/80 font-normal">Laba rugi harian dalam satu klik</p>
                    </div>
                </div>
            </div>
            <div id="fluid-detail" class="hidden mt-6 rounded-3xl overflow-hidden shadow-2xl transition-all duration-500 ease-in-out">
                <div id="fluid-detail-content" class="p-8 md:p-10"></div>
            </div>
        </div>
    </div>
</section>

<script>
const detailContent = {
    kasir: { title: 'Kasir POS Cepat', desc: 'Transaksi lancar bahkan saat ramai. Mendukung pembayaran tunai, QRIS, dan transfer bank otomatis. Cetak nota thermal langsung dari browser.', tags: ['RESPONSIF', 'CETAK NOTA', 'QRIS', 'MULTI PEMBAYARAN'], color: '#10B981', icon: 'point_of_sale' },
    inventori: { title: 'Inventori Otomatis', desc: 'Stok berkurang otomatis setiap penjualan. Notifikasi stok menipis real-time via WhatsApp. Riwayat mutasi barang lengkap.', tags: ['AUTO STOK', 'NOTIFIKASI WA', 'RIWAYAT MUTASI'], color: '#3B82F6', icon: 'inventory_2' },
    ai: { title: 'Prediksi AI', desc: 'Machine learning menganalisis pola penjualan Anda. Rekomendasi jumlah pembelian optimal untuk mengurangi stok kosong hingga 40%.', tags: ['MACHINE LEARNING', 'PREDIKSI PENJUALAN', 'REKOMENDASI BELANJA'], color: '#8B5CF6', icon: 'psychology' },
    laporan: { title: 'Laporan Keuangan', desc: 'Laba rugi harian, mingguan, dan bulanan siap dalam satu klik. Export ke PDF atau Excel. Grafik visual yang mudah dipahami.', tags: ['EXPORT PDF/EXCEL', 'GRAFIK VISUAL', 'PERIODE FLEKSIBEL'], color: '#F59E0B', icon: 'description' }
};
let expandedId = null;
function expandGridItem(el) {
    const id = el.getAttribute('data-id');
    const grid = document.getElementById('fluid-grid').querySelector('.grid');
    const detail = document.getElementById('fluid-detail');
    const content = document.getElementById('fluid-detail-content');
    const cards = grid.querySelectorAll('.fluid-card');
    if (expandedId === id) { closeDetail(); return; }
    expandedId = id;
    const info = detailContent[id];
    content.innerHTML = '<div class="flex flex-col md:flex-row gap-6 items-start"><div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0" style="background: ' + info.color + '20;"><span class="material-symbols-outlined text-3xl" style="color: ' + info.color + ';">' + info.icon + '</span></div><div class="flex-1"><h3 class="text-2xl font-extrabold text-gray-800 mb-3">' + info.title + '</h3><p class="text-gray-500 leading-relaxed mb-4">' + info.desc + '</p><div class="flex flex-wrap gap-2">' + info.tags.map(tag => '<span class="px-3 py-1 rounded-full text-xs font-bold" style="background: ' + info.color + '15; color: ' + info.color + ';">' + tag + '</span>').join('') + '</div></div><button onclick="closeDetail()" class="shrink-0 w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors"><span class="material-symbols-outlined text-gray-500">close</span></button></div>';
    grid.classList.remove('grid-rows-2'); grid.classList.add('grid-rows-3');
    cards.forEach(card => {
        card.classList.remove('col-span-2','row-start-1','row-start-2','row-start-3','opacity-40','scale-95'); card.style.gridColumn = ''; card.style.gridRow = '';
        if (card.getAttribute('data-id') === id) { const idx = Array.from(cards).indexOf(card); card.style.gridColumn = '1 / span 2'; card.style.gridRow = idx < 2 ? 1 : 2; }
        else { card.classList.add('opacity-60','scale-[0.97]'); }
    });
    detail.classList.remove('hidden');
    detail.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}
function closeDetail() {
    expandedId = null;
    const grid = document.getElementById('fluid-grid').querySelector('.grid');
    const detail = document.getElementById('fluid-detail');
    const cards = grid.querySelectorAll('.fluid-card');
    detail.classList.add('hidden'); grid.classList.remove('grid-rows-3'); grid.classList.add('grid-rows-2');
    cards.forEach(card => { card.classList.remove('col-span-2','row-start-1','row-start-2','row-start-3','opacity-40','scale-95','opacity-60','scale-[0.97]'); card.style.gridColumn = ''; card.style.gridRow = ''; });
}
</script>

<!-- DEMO SECTION -->
<section id="demo" class="py-20 bg-gray-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-50 rounded-full text-xs font-bold text-purple-600 mb-4">
                <span class="material-symbols-outlined text-[14px]">visibility</span>
                LIHAT CARA KERJANYA
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">TokoQ dalam Aksi</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Jelajahi tampilan dashboard, kasir, stok, prediksi AI, dan laporan yang akan Anda gunakan setiap hari.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-3 mb-8 reveal">
            <button class="demo-tab-btn active px-5 py-2.5 rounded-xl text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all" onclick="switchDemo('dashboard', this)"><span class="material-symbols-outlined text-[16px] align-middle mr-1">dashboard</span>Dashboard</button>
            <button class="demo-tab-btn px-5 py-2.5 rounded-xl text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all" onclick="switchDemo('kasir', this)"><span class="material-symbols-outlined text-[16px] align-middle mr-1">point_of_sale</span>Kasir POS</button>
            <button class="demo-tab-btn px-5 py-2.5 rounded-xl text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all" onclick="switchDemo('stok', this)"><span class="material-symbols-outlined text-[16px] align-middle mr-1">inventory_2</span>Stok Barang</button>
            <button class="demo-tab-btn px-5 py-2.5 rounded-xl text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all" onclick="switchDemo('ai', this)"><span class="material-symbols-outlined text-[16px] align-middle mr-1">psychology</span>Prediksi AI</button>
            <button class="demo-tab-btn px-5 py-2.5 rounded-xl text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all" onclick="switchDemo('laporan', this)"><span class="material-symbols-outlined text-[16px] align-middle mr-1">bar_chart</span>Laporan</button>
        </div>
        <div class="reveal-scale">
            <div id="demo-dashboard" class="demo-panel active">
                <div class="demo-mockup bg-white max-w-5xl mx-auto">
                    <div class="demo-browser-bar"><div class="demo-dot bg-red-400"></div><div class="demo-dot bg-amber-400"></div><div class="demo-dot bg-green-400"></div><div class="demo-tab">tokoq.id/dashboard</div></div>
                    <div class="p-6 md:p-8 bg-gradient-to-br from-gray-50 to-emerald-50/30">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100"><p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Penjualan Hari Ini</p><p class="text-xl font-extrabold text-gray-800">Rp 2.450.000</p><p class="text-[10px] text-emerald-500 font-bold mt-1">+12% dari kemarin</p></div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100"><p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Transaksi</p><p class="text-xl font-extrabold text-gray-800">47</p><p class="text-[10px] text-emerald-500 font-bold mt-1">+5 dari kemarin</p></div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100"><p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Stok Menipis</p><p class="text-xl font-extrabold text-amber-500">8</p><p class="text-[10px] text-amber-500 font-bold mt-1">perlu restok</p></div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100"><p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Produk</p><p class="text-xl font-extrabold text-gray-800">156</p><p class="text-[10px] text-gray-400 font-bold mt-1">total item</p></div>
                        </div>
                        <div class="grid md:grid-cols-3 gap-4">
                            <div class="md:col-span-2 bg-white rounded-xl p-4 shadow-sm border border-gray-100"><p class="text-xs font-bold text-gray-600 mb-3">Grafik Penjualan 7 Hari</p><div class="flex items-end gap-2 h-32"><div class="flex-1 bg-emerald-100 rounded-t" style="height:45%"></div><div class="flex-1 bg-emerald-200 rounded-t" style="height:60%"></div><div class="flex-1 bg-emerald-300 rounded-t" style="height:35%"></div><div class="flex-1 bg-emerald-200 rounded-t" style="height:80%"></div><div class="flex-1 bg-emerald-400 rounded-t" style="height:65%"></div><div class="flex-1 bg-emerald-300 rounded-t" style="height:90%"></div><div class="flex-1 bg-emerald-500 rounded-t" style="height:100%"></div></div><div class="flex justify-between mt-2 text-[9px] text-gray-400"><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span></div></div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100"><p class="text-xs font-bold text-gray-600 mb-3">AI Prediksi Restok</p><div class="space-y-3"><div class="flex items-center gap-3"><div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined text-amber-500 text-[16px]">warning</span></div><div><p class="text-xs font-bold text-gray-700">Beras 5kg</p><p class="text-[10px] text-gray-400">Habis dalam ~3 hari</p></div></div><div class="flex items-center gap-3"><div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined text-red-500 text-[16px]">error</span></div><div><p class="text-xs font-bold text-gray-700">Minyak Goreng</p><p class="text-[10px] text-gray-400">Habis dalam ~1 hari</p></div></div><div class="flex items-center gap-3"><div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined text-emerald-500 text-[16px]">check</span></div><div><p class="text-xs font-bold text-gray-700">Gula Pasir</p><p class="text-[10px] text-gray-400">Stok aman</p></div></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="demo-kasir" class="demo-panel">
                <div class="demo-mockup bg-white max-w-5xl mx-auto">
                    <div class="demo-browser-bar"><div class="demo-dot bg-red-400"></div><div class="demo-dot bg-amber-400"></div><div class="demo-dot bg-green-400"></div><div class="demo-tab">tokoq.id/pos</div></div>
                    <div class="flex flex-col md:flex-row min-h-[400px]">
                        <div class="flex-1 p-4 md:p-6 bg-gray-50"><p class="text-xs font-bold text-gray-500 mb-3">Pilih Produk</p><div class="grid grid-cols-2 gap-3"><div class="bg-white rounded-xl p-3 shadow-sm border border-gray-100"><div class="w-full h-16 bg-emerald-50 rounded-lg mb-2 flex items-center justify-center"><span class="material-symbols-outlined text-emerald-400 text-2xl">inventory_2</span></div><p class="text-xs font-bold text-gray-700">Beras 5kg</p><p class="text-[10px] text-gray-400">Rp 65.000</p></div><div class="bg-white rounded-xl p-3 shadow-sm border border-gray-100"><div class="w-full h-16 bg-blue-50 rounded-lg mb-2 flex items-center justify-center"><span class="material-symbols-outlined text-blue-400 text-2xl">inventory_2</span></div><p class="text-xs font-bold text-gray-700">Minyak 1L</p><p class="text-[10px] text-gray-400">Rp 18.500</p></div><div class="bg-white rounded-xl p-3 shadow-sm border border-gray-100"><div class="w-full h-16 bg-amber-50 rounded-lg mb-2 flex items-center justify-center"><span class="material-symbols-outlined text-amber-400 text-2xl">inventory_2</span></div><p class="text-xs font-bold text-gray-700">Gula 1kg</p><p class="text-[10px] text-gray-400">Rp 14.000</p></div><div class="bg-white rounded-xl p-3 shadow-sm border border-gray-100"><div class="w-full h-16 bg-purple-50 rounded-lg mb-2 flex items-center justify-center"><span class="material-symbols-outlined text-purple-400 text-2xl">inventory_2</span></div><p class="text-xs font-bold text-gray-700">Telur 1kg</p><p class="text-[10px] text-gray-400">Rp 28.000</p></div></div></div>
                        <div class="w-full md:w-80 bg-white border-l border-gray-100 p-4 md:p-6"><p class="text-xs font-bold text-gray-500 mb-3">Keranjang</p><div class="space-y-3 mb-4"><div class="flex justify-between items-center"><div><p class="text-xs font-bold text-gray-700">Beras 5kg</p><p class="text-[10px] text-gray-400">x1 Rp 65.000</p></div><p class="text-xs font-bold text-gray-700">65.000</p></div><div class="flex justify-between items-center"><div><p class="text-xs font-bold text-gray-700">Minyak 1L</p><p class="text-[10px] text-gray-400">x2 Rp 18.500</p></div><p class="text-xs font-bold text-gray-700">37.000</p></div><div class="flex justify-between items-center"><div><p class="text-xs font-bold text-gray-700">Gula 1kg</p><p class="text-[10px] text-gray-400">x1 Rp 14.000</p></div><p class="text-xs font-bold text-gray-700">14.000</p></div></div><div class="border-t border-gray-100 pt-3 mb-4"><div class="flex justify-between items-center mb-1"><p class="text-xs text-gray-500">Subtotal</p><p class="text-xs font-bold text-gray-700">Rp 116.000</p></div><div class="flex justify-between items-center"><p class="text-sm font-extrabold text-gray-800">Total</p><p class="text-lg font-extrabold text-emerald-600">Rp 116.000</p></div></div><div class="grid grid-cols-2 gap-2"><button class="py-2.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-xl">Tunai</button><button class="py-2.5 bg-emerald-500 text-white text-xs font-bold rounded-xl">QRIS</button></div><button class="w-full mt-3 py-3 bg-gradient-to-r from-primary to-emerald-600 text-white text-sm font-bold rounded-xl shadow-lg">Bayar Sekarang</button></div>
                    </div>
                </div>
            </div>
            <div id="demo-stok" class="demo-panel">
                <div class="demo-mockup bg-white max-w-5xl mx-auto">
                    <div class="demo-browser-bar"><div class="demo-dot bg-red-400"></div><div class="demo-dot bg-amber-400"></div><div class="demo-dot bg-green-400"></div><div class="demo-tab">tokoq.id/products</div></div>
                    <div class="p-4 md:p-6"><div class="flex flex-wrap gap-3 mb-4"><div class="px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full">Semua (156)</div><div class="px-3 py-1.5 bg-red-50 text-red-500 text-[10px] font-bold rounded-full">Stok Habis (3)</div><div class="px-3 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-full">Stok Menipis (8)</div></div><div class="overflow-x-auto"><table class="w-full text-left"><thead><tr class="border-b border-gray-100"><th class="text-[10px] font-bold text-gray-400 uppercase pb-3 pr-4">Produk</th><th class="text-[10px] font-bold text-gray-400 uppercase pb-3 pr-4">Kategori</th><th class="text-[10px] font-bold text-gray-400 uppercase pb-3 pr-4">Harga</th><th class="text-[10px] font-bold text-gray-400 uppercase pb-3 pr-4">Stok</th><th class="text-[10px] font-bold text-gray-400 uppercase pb-3">Status</th></tr></thead><tbody class="text-xs"><tr class="border-b border-gray-50"><td class="py-3 pr-4 font-bold text-gray-700">Beras 5kg</td><td class="py-3 pr-4 text-gray-500">Sembako</td><td class="py-3 pr-4 text-gray-700">Rp 65.000</td><td class="py-3 pr-4 font-bold text-gray-700">12</td><td class="py-3"><span class="px-2 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-full">Menipis</span></td></tr><tr class="border-b border-gray-50"><td class="py-3 pr-4 font-bold text-gray-700">Minyak Goreng 1L</td><td class="py-3 pr-4 text-gray-500">Sembako</td><td class="py-3 pr-4 text-gray-700">Rp 18.500</td><td class="py-3 pr-4 font-bold text-gray-700">2</td><td class="py-3"><span class="px-2 py-1 bg-red-50 text-red-500 text-[10px] font-bold rounded-full">Hampir Habis</span></td></tr><tr class="border-b border-gray-50"><td class="py-3 pr-4 font-bold text-gray-700">Gula Pasir 1kg</td><td class="py-3 pr-4 text-gray-500">Sembako</td><td class="py-3 pr-4 text-gray-700">Rp 14.000</td><td class="py-3 pr-4 font-bold text-gray-700">45</td><td class="py-3"><span class="px-2 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full">Aman</span></td></tr><tr class="border-b border-gray-50"><td class="py-3 pr-4 font-bold text-gray-700">Telur Ayam 1kg</td><td class="py-3 pr-4 text-gray-500">Protein</td><td class="py-3 pr-4 text-gray-700">Rp 28.000</td><td class="py-3 pr-4 font-bold text-gray-700">0</td><td class="py-3"><span class="px-2 py-1 bg-red-50 text-red-500 text-[10px] font-bold rounded-full">Habis</span></td></tr><tr><td class="py-3 pr-4 font-bold text-gray-700">Indomie Goreng</td><td class="py-3 pr-4 text-gray-500">Makanan</td><td class="py-3 pr-4 text-gray-700">Rp 3.500</td><td class="py-3 pr-4 font-bold text-gray-700">120</td><td class="py-3"><span class="px-2 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full">Aman</span></td></tr></tbody></table></div></div>
                </div>
            </div>
            <div id="demo-ai" class="demo-panel">
                <div class="demo-mockup bg-white max-w-5xl mx-auto">
                    <div class="demo-browser-bar"><div class="demo-dot bg-red-400"></div><div class="demo-dot bg-amber-400"></div><div class="demo-dot bg-green-400"></div><div class="demo-tab">tokoq.id/ai-predictions</div></div>
                    <div class="p-6 md:p-8 bg-gradient-to-br from-purple-50/50 to-emerald-50/30">
                        <div class="grid md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                <div class="flex items-center gap-2 mb-2"><span class="material-symbols-outlined text-purple-500 text-[18px]">psychology</span><p class="text-[10px] text-gray-400 uppercase font-bold">Total Prediksi</p></div>
                                <p class="text-2xl font-extrabold text-gray-800">12</p>
                                <p class="text-[10px] text-purple-500 font-bold mt-1">barang perlu restok</p>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                <div class="flex items-center gap-2 mb-2"><span class="material-symbols-outlined text-emerald-500 text-[18px]">trending_up</span><p class="text-[10px] text-gray-400 uppercase font-bold">Akurasi Model</p></div>
                                <p class="text-2xl font-extrabold text-gray-800">94%</p>
                                <p class="text-[10px] text-emerald-500 font-bold mt-1">terus meningkat</p>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                <div class="flex items-center gap-2 mb-2"><span class="material-symbols-outlined text-amber-500 text-[18px]">schedule</span><p class="text-[10px] text-gray-400 uppercase font-bold">Hemat Waktu</p></div>
                                <p class="text-2xl font-extrabold text-gray-800">2 Jam</p>
                                <p class="text-[10px] text-amber-500 font-bold mt-1">per hari dari hitung manual</p>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                                <p class="text-xs font-bold text-gray-600 mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-purple-500 text-[18px]">auto_awesome</span>Rekomendasi Restok</p>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl border border-red-100">
                                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-red-500 text-[20px]">error</span></div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-gray-700">Minyak Goreng 1L</p>
                                            <p class="text-[10px] text-gray-400">Stok: 2 unit • Habis dalam ~1 hari</p>
                                        </div>
                                        <span class="text-[10px] font-bold text-red-500 bg-red-100 px-2 py-1 rounded-full">Darurat</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 bg-amber-50 rounded-xl border border-amber-100">
                                        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-amber-500 text-[20px]">warning</span></div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-gray-700">Beras 5kg</p>
                                            <p class="text-[10px] text-gray-400">Stok: 12 unit • Habis dalam ~3 hari</p>
                                        </div>
                                        <span class="text-[10px] font-bold text-amber-600 bg-amber-100 px-2 py-1 rounded-full">Segera</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 bg-amber-50 rounded-xl border border-amber-100">
                                        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-amber-500 text-[20px]">warning</span></div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-gray-700">Indomie Goreng</p>
                                            <p class="text-[10px] text-gray-400">Stok: 25 unit • Habis dalam ~5 hari</p>
                                        </div>
                                        <span class="text-[10px] font-bold text-amber-600 bg-amber-100 px-2 py-1 rounded-full">Perhatian</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl border border-emerald-100">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-emerald-500 text-[20px]">check_circle</span></div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-gray-700">Gula Pasir 1kg</p>
                                            <p class="text-[10px] text-gray-400">Stok: 45 unit • Aman untuk ~14 hari</p>
                                        </div>
                                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-100 px-2 py-1 rounded-full">Aman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                                    <p class="text-xs font-bold text-gray-600 mb-3 flex items-center gap-2"><span class="material-symbols-outlined text-blue-500 text-[18px]">insights</span>Pola Penjualan</p>
                                    <div class="space-y-3">
                                        <div>
                                            <div class="flex justify-between text-[10px] mb-1"><span class="font-bold text-gray-600">Senin - Rabu</span><span class="text-gray-400">Naik 25%</span></div>
                                            <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-purple-500 h-2 rounded-full" style="width:75%"></div></div>
                                        </div>
                                        <div>
                                            <div class="flex justify-between text-[10px] mb-1"><span class="font-bold text-gray-600">Kamis - Jumat</span><span class="text-gray-400">Stabil</span></div>
                                            <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-blue-500 h-2 rounded-full" style="width:60%"></div></div>
                                        </div>
                                        <div>
                                            <div class="flex justify-between text-[10px] mb-1"><span class="font-bold text-gray-600">Sabtu - Minggu</span><span class="text-gray-400">Puncak 40%</span></div>
                                            <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-emerald-500 h-2 rounded-full" style="width:90%"></div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl p-5 text-white">
                                    <div class="flex items-center gap-2 mb-2"><span class="material-symbols-outlined text-white/80 text-[18px]">lightbulb</span><p class="text-xs font-bold">Saran AI</p></div>
                                    <p class="text-sm leading-relaxed text-white/90">Berdasarkan pola penjualan, disarankan restok <strong>Minyak Goreng</strong> dan <strong>Beras 5kg</strong> sebelum akhir pekan untuk menghindari kehabisan stok.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="demo-laporan" class="demo-panel">
                <div class="demo-mockup bg-white max-w-5xl mx-auto">
                    <div class="demo-browser-bar"><div class="demo-dot bg-red-400"></div><div class="demo-dot bg-amber-400"></div><div class="demo-dot bg-green-400"></div><div class="demo-tab">tokoq.id/reports</div></div>
                    <div class="p-4 md:p-6"><div class="flex flex-wrap gap-2 mb-6"><button class="px-3 py-1.5 bg-emerald-500 text-white text-[10px] font-bold rounded-lg">Harian</button><button class="px-3 py-1.5 bg-gray-100 text-gray-500 text-[10px] font-bold rounded-lg">Mingguan</button><button class="px-3 py-1.5 bg-gray-100 text-gray-500 text-[10px] font-bold rounded-lg">Bulanan</button></div><div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6"><div class="bg-emerald-50 rounded-xl p-4"><p class="text-[10px] text-emerald-600 font-bold uppercase mb-1">Pendapatan</p><p class="text-lg font-extrabold text-emerald-700">Rp 18.200.000</p></div><div class="bg-blue-50 rounded-xl p-4"><p class="text-[10px] text-blue-600 font-bold uppercase mb-1">Laba Bersih</p><p class="text-lg font-extrabold text-blue-700">Rp 4.550.000</p></div><div class="bg-purple-50 rounded-xl p-4"><p class="text-[10px] text-purple-600 font-bold uppercase mb-1">Transaksi</p><p class="text-lg font-extrabold text-purple-700">312</p></div><div class="bg-amber-50 rounded-xl p-4"><p class="text-[10px] text-amber-600 font-bold uppercase mb-1">Rata-rata</p><p class="text-lg font-extrabold text-amber-700">Rp 58.333</p></div></div><div class="bg-gray-50 rounded-xl p-4"><p class="text-xs font-bold text-gray-600 mb-3">Produk Terlaris Bulan Ini</p><div class="space-y-2"><div class="flex items-center gap-3"><span class="text-xs font-bold text-gray-400 w-4">1</span><div class="flex-1 bg-gray-200 rounded-full h-2"><div class="bg-emerald-500 h-2 rounded-full" style="width:95%"></div></div><span class="text-xs font-bold text-gray-700 w-24 text-right">Indomie (450)</span></div><div class="flex items-center gap-3"><span class="text-xs font-bold text-gray-400 w-4">2</span><div class="flex-1 bg-gray-200 rounded-full h-2"><div class="bg-emerald-400 h-2 rounded-full" style="width:72%"></div></div><span class="text-xs font-bold text-gray-700 w-24 text-right">Beras (340)</span></div><div class="flex items-center gap-3"><span class="text-xs font-bold text-gray-400 w-4">3</span><div class="flex-1 bg-gray-200 rounded-full h-2"><div class="bg-emerald-300 h-2 rounded-full" style="width:58%"></div></div><span class="text-xs font-bold text-gray-700 w-24 text-right">Minyak (280)</span></div></div></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function switchDemo(tab, btn) {
    document.querySelectorAll('.demo-tab-btn').forEach(b => { b.classList.remove('active'); b.classList.add('bg-gray-100', 'text-gray-600'); });
    btn.classList.add('active'); btn.classList.remove('bg-gray-100', 'text-gray-600');
    document.querySelectorAll('.demo-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('demo-' + tab).classList.add('active');
}
</script>

<!-- HOW IT WORKS -->
<section id="cara-kerja" class="py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-full text-xs font-bold text-blue-500 mb-4">
                <span class="material-symbols-outlined text-[14px]">rocket_launch</span>
                MUDAH DIGUNAKAN
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Mulai dalam 3 Langkah Sederhana</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8 relative">
            <div class="hidden md:block absolute top-14 left-[20%] right-[20%] h-0.5 bg-gradient-to-r from-primary/30 via-primary/50 to-primary/30"></div>
            <div class="reveal delay-100 text-center relative">
                <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-primary/10 to-emerald-100 rounded-3xl flex items-center justify-center relative">
                    <span class="material-symbols-outlined text-5xl text-primary">person_add</span>
                    <div class="absolute -top-3 -right-3 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg shadow-primary/30">1</div>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Buat Akun Gratis</h3>
                <p class="text-sm text-gray-500 max-w-xs mx-auto">Daftar dalam 30 detik. Masukkan nama toko dan data dasar Anda.</p>
            </div>
            <div class="reveal delay-200 text-center relative">
                <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-3xl flex items-center justify-center relative">
                    <span class="material-symbols-outlined text-5xl text-blue-500">inventory_2</span>
                    <div class="absolute -top-3 -right-3 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg shadow-blue-500/30">2</div>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Tambah Produk</h3>
                <p class="text-sm text-gray-500 max-w-xs mx-auto">Foto barang, atur harga, masukkan stok. Bisa juga import dari Excel.</p>
            </div>
            <div class="reveal delay-300 text-center relative">
                <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-purple-50 to-indigo-100 rounded-3xl flex items-center justify-center relative">
                    <span class="material-symbols-outlined text-5xl text-purple-500">storefront</span>
                    <div class="absolute -top-3 -right-3 w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg shadow-purple-500/30">3</div>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Mulai Jualan</h3>
                <p class="text-sm text-gray-500 max-w-xs mx-auto">Buka kasir, catat transaksi, dan pantau penjualan real-time.</p>
            </div>
        </div>
    </div>
</section>

<!-- IMPACT -->
<section id="dampak" class="py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 rounded-[40px] p-10 md:p-16 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-2xl -ml-32 -mb-32"></div>
            <div class="grid md:grid-cols-2 gap-12 items-center relative z-10">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/20 rounded-full text-xs font-bold text-emerald-400 mb-6">
                        <span class="material-symbols-outlined text-[14px]">trending_up</span>DAMPAK NYATA
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-8">Dampak Nyata untuk Pertumbuhan Bisnis Anda</h2>
                    <ul class="space-y-5">
                        <li class="flex gap-4 items-start"><div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-primary/30"><span class="material-symbols-outlined text-white text-[18px]">check</span></div><div><p class="font-bold text-white">Kurangi Risiko Stok Kosong hingga 40%</p><p class="text-sm text-gray-400">Dengan peringatan dini berbasis kebiasaan belanja pelanggan.</p></div></li>
                        <li class="flex gap-4 items-start"><div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-primary/30"><span class="material-symbols-outlined text-white text-[18px]">check</span></div><div><p class="font-bold text-white">Keputusan Berbasis Data</p><p class="text-sm text-gray-400">Tentukan promosi yang tepat berdasarkan produk paling laris.</p></div></li>
                        <li class="flex gap-4 items-start"><div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-primary/30"><span class="material-symbols-outlined text-white text-[18px]">check</span></div><div><p class="font-bold text-white">Efisiensi Waktu Rekapitulasi</p><p class="text-sm text-gray-400">Hemat 2 jam setiap hari yang biasanya digunakan untuk menghitung kasir manual.</p></div></li>
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-primary to-emerald-600 p-6 rounded-3xl flex flex-col justify-center items-center text-center shadow-2xl shadow-primary/20"><div class="text-4xl font-extrabold text-white mb-1">3+</div><div class="text-sm text-white/80 font-medium">UMKM Beta</div><div class="text-[10px] text-white/50 mt-1">sedang mencoba TokoQ</div></div>
                    <div class="bg-white/10 backdrop-blur-sm p-5 rounded-3xl border border-white/10"><div class="flex items-center gap-3 mb-2"><div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined text-emerald-400 text-[16px]">trending_up</span></div><p class="text-white font-bold text-sm">Efisiensi</p></div><p class="text-2xl font-extrabold text-white">+150%</p><p class="text-[10px] text-gray-400 mt-1">Peningkatan rata-rata</p></div>
                    <div class="bg-white/10 backdrop-blur-sm p-5 rounded-3xl border border-white/10"><div class="flex items-center gap-3 mb-2"><div class="w-8 h-8 bg-amber-500/20 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined text-amber-400 text-[16px]">schedule</span></div><p class="text-white font-bold text-sm">Waktu Hemat</p></div><p class="text-2xl font-extrabold text-white">2 Jam</p><p class="text-[10px] text-gray-400 mt-1">Per hari dari rekap manual</p></div>
                    <div class="bg-white/10 backdrop-blur-sm p-5 rounded-3xl border border-white/10"><div class="flex items-center gap-3 mb-2"><div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined text-blue-400 text-[16px]">verified</span></div><p class="text-white font-bold text-sm">Uptime</p></div><p class="text-2xl font-extrabold text-white">99.9%</p><p class="text-[10px] text-gray-400 mt-1">Sistem selalu siap</p></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section id="testimoni" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 rounded-full text-xs font-bold text-amber-600 mb-4"><span class="material-symbols-outlined text-[14px]">format_quote</span>TESTIMONI</div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Apa Kata Pengguna TokoQ?</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="reveal delay-100 bg-gray-50 p-6 rounded-3xl border border-gray-100 card-lift">
                <div class="flex items-center gap-1 mb-4">@for($i = 0; $i < 5; $i++)<span class="material-symbols-outlined text-amber-400 text-[18px]">star</span>@endfor</div>
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">"Sejak pakai TokoQ, stok kosong turun dari 8x sebulan jadi cuma 2x. Pelanggan nggak kecewa lagi karena barang selalu ada."</p>
                <div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-sm">S</div><div><p class="font-bold text-sm text-gray-800">Sari Dewi</p><p class="text-xs text-gray-400">Warung Sari, Bandung</p><p class="text-[10px] text-emerald-500 font-bold">Toko Kelontong &mdash; stok kosong turun dari 8x/bulan jadi 2x/bulan</p></div></div>
            </div>
            <div class="reveal delay-200 bg-gray-50 p-6 rounded-3xl border border-gray-100 card-lift">
                <div class="flex items-center gap-1 mb-4">@for($i = 0; $i < 5; $i++)<span class="material-symbols-outlined text-amber-400 text-[18px]">star</span>@endfor</div>
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">"Fitur prediksi AI-nya sangat membantu. Saya jadi tahu kapan harus restok barang tanpa harus menghitung manual. Hemat waktu banget."</p>
                <div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm">B</div><div><p class="font-bold text-sm text-gray-800">Budi Santoso</p><p class="text-xs text-gray-400">Warung Makan Budi, Surabaya</p><p class="text-[10px] text-emerald-500 font-bold">Warung Makan &mdash; restok jadi tepat waktu</p></div></div>
            </div>
            <div class="reveal delay-300 bg-gray-50 p-6 rounded-3xl border border-gray-100 card-lift">
                <div class="flex items-center gap-1 mb-4">@for($i = 0; $i < 5; $i++)<span class="material-symbols-outlined text-amber-400 text-[18px]">star</span>@endfor</div>
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">"Laporan keuangan yang dulu ribet sekarang jadi satu klik. TokoQ benar-benar menghemat waktu saya setiap hari."</p>
                <div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold text-sm">R</div><div><p class="font-bold text-sm text-gray-800">Rina Wati</p><p class="text-xs text-gray-400">Toko Sembako Rina, Yogyakarta</p><p class="text-[10px] text-emerald-500 font-bold">Toko Sembako &mdash; laporan harian dalam 1 klik</p></div></div>
            </div>
        </div>
    </div>
</section>

<!-- PRICING -->
<section id="harga" class="py-20 bg-gray-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 rounded-full text-xs font-bold text-primary mb-4"><span class="material-symbols-outlined text-[14px]">payments</span>HARGA TERJANGKAU</div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Pilih Paket yang Sesuai<br/>Kebutuhan Toko Anda</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Gratis untuk memulai. Upgrade kapan saja saat bisnis Anda berkembang.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            <!-- Free -->
            <div class="reveal delay-100 bg-white rounded-3xl p-8 border border-gray-200 shadow-sm card-lift">
                <div class="mb-6"><h3 class="text-lg font-bold text-gray-800 mb-1">Gratis</h3><p class="text-sm text-gray-500">Untuk mencoba TokoQ</p></div>
                <div class="mb-6"><span class="text-4xl font-extrabold text-gray-800">Rp 0</span><span class="text-sm text-gray-400">/bulan</span></div>
                <a href="/register" class="block w-full text-center py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors mb-6">Mulai Gratis</a>
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
            <div class="reveal delay-200 bg-white rounded-3xl p-8 border-2 border-primary shadow-lg card-lift pricing-popular relative">
                <div class="mb-6"><h3 class="text-lg font-bold text-gray-800 mb-1">Pro</h3><p class="text-sm text-gray-500">Untuk toko yang berkembang</p></div>
                <div class="mb-6"><span class="text-4xl font-extrabold text-gray-800">Rp 99.000</span><span class="text-sm text-gray-400">/bulan</span></div>
                <a href="/register?plan=pro" class="block w-full text-center py-3 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl hover:shadow-lg transition-all mb-6">Pilih Pro</a>
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
            <div class="reveal delay-300 bg-white rounded-3xl p-8 border border-gray-200 shadow-sm card-lift">
                <div class="mb-6"><h3 class="text-lg font-bold text-gray-800 mb-1">Bisnis</h3><p class="text-sm text-gray-500">Untuk toko dengan kebutuhan penuh</p></div>
                <div class="mb-6"><span class="text-4xl font-extrabold text-gray-800">Rp 249.000</span><span class="text-sm text-gray-400">/bulan</span></div>
                <a href="/register?plan=bisnis" class="block w-full text-center py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors mb-6">Pilih Bisnis</a>
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
        <div class="text-center mt-10 reveal">
            <p class="text-sm text-gray-500">Semua paket termasuk: QRIS, printer struk, barcode scanner, import/export Excel, backup data harian.</p>
            <p class="text-xs text-gray-400 mt-2">Biaya transaksi QRIS mengikuti ketentuan provider pembayaran.</p>
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-20 bg-white relative overflow-hidden">
    <div class="max-w-3xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-full text-xs font-bold text-blue-600 mb-4"><span class="material-symbols-outlined text-[14px]">help</span>PERTANYAAN UMUM</div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Pertanyaan yang Sering Ditanyakan</h2>
        </div>
        <div class="space-y-4 reveal">
            <div class="faq-item bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden">
                <button class="w-full flex items-center justify-between p-5 text-left" onclick="toggleFaq(this)" aria-expanded="false" aria-controls="faq-1">
                    <span class="font-bold text-gray-800 text-sm">Apakah TokoQ bisa dipakai di HP?</span>
                    <span class="material-symbols-outlined faq-icon text-gray-400" aria-hidden="true">expand_more</span>
                </button>
                <div class="faq-answer px-5 pb-0" id="faq-1" role="region"><p class="text-sm text-gray-600 pb-5 leading-relaxed">Ya! TokoQ berbasis web yang responsif, bisa dibuka dari HP, tablet, atau komputer melalui browser. Tidak perlu instal aplikasi.</p></div>
            </div>
            <div class="faq-item bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden">
                <button class="w-full flex items-center justify-between p-5 text-left" onclick="toggleFaq(this)" aria-expanded="false" aria-controls="faq-2">
                    <span class="font-bold text-gray-800 text-sm">Apakah butuh internet?</span>
                    <span class="material-symbols-outlined faq-icon text-gray-400" aria-hidden="true">expand_more</span>
                </button>
                <div class="faq-answer px-5 pb-0" id="faq-2" role="region"><p class="text-sm text-gray-600 pb-5 leading-relaxed">Ya, TokoQ membutuhkan koneksi internet karena berbasis cloud. Data Anda tersimpan aman di server dan bisa diakses dari mana saja.</p></div>
            </div>
            <div class="faq-item bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden">
                <button class="w-full flex items-center justify-between p-5 text-left" onclick="toggleFaq(this)" aria-expanded="false" aria-controls="faq-3">
                    <span class="font-bold text-gray-800 text-sm">Apakah bisa pakai printer struk?</span>
                    <span class="material-symbols-outlined faq-icon text-gray-400" aria-hidden="true">expand_more</span>
                </button>
                <div class="faq-answer px-5 pb-0" id="faq-3" role="region"><p class="text-sm text-gray-600 pb-5 leading-relaxed">Bisa! TokoQ mendukung cetak nota thermal langsung dari browser. Kompatibel dengan berbagai merek printer struk USB dan network.</p></div>
            </div>
            <div class="faq-item bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden">
                <button class="w-full flex items-center justify-between p-5 text-left" onclick="toggleFaq(this)" aria-expanded="false" aria-controls="faq-4">
                    <span class="font-bold text-gray-800 text-sm">Apakah support QRIS?</span>
                    <span class="material-symbols-outlined faq-icon text-gray-400" aria-hidden="true">expand_more</span>
                </button>
                <div class="faq-answer px-5 pb-0" id="faq-4" role="region"><p class="text-sm text-gray-600 pb-5 leading-relaxed">Ya, TokoQ mendukung pembayaran QRIS. Pelanggan cukup scan QR code dan pembayaran tercatat otomatis di sistem.</p></div>
            </div>
            <div class="faq-item bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden">
                <button class="w-full flex items-center justify-between p-5 text-left" onclick="toggleFaq(this)" aria-expanded="false" aria-controls="faq-5">
                    <span class="font-bold text-gray-800 text-sm">Apakah data saya aman?</span>
                    <span class="material-symbols-outlined faq-icon text-gray-400" aria-hidden="true">expand_more</span>
                </button>
                <div class="faq-answer px-5 pb-0" id="faq-5" role="region"><p class="text-sm text-gray-600 pb-5 leading-relaxed">Data Anda dienkripsi dan disimpan di server cloud yang aman dengan backup harian. Anda juga bisa export data kapan saja.</p></div>
            </div>
            <div class="faq-item bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden">
                <button class="w-full flex items-center justify-between p-5 text-left" onclick="toggleFaq(this)" aria-expanded="false" aria-controls="faq-6">
                    <span class="font-bold text-gray-800 text-sm">Bisa import data dari Excel?</span>
                    <span class="material-symbols-outlined faq-icon text-gray-400" aria-hidden="true">expand_more</span>
                </button>
                <div class="faq-answer px-5 pb-0" id="faq-6" role="region"><p class="text-sm text-gray-600 pb-5 leading-relaxed">Bisa! Anda bisa import data produk dari file Excel/CSV. Juga bisa export laporan ke Excel atau PDF kapan saja.</p></div>
            </div>
        </div>
    </div>
</section>

<!-- FINAL CTA -->
<section id="mulai" class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 hero-gradient"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-3xl mx-auto px-6 text-center relative z-10">
        <div class="reveal">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-primary/30 animate-pulse-glow">
                <span class="material-symbols-outlined text-white text-[40px]">rocket_launch</span>
            </div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-800 mb-6">Siap Bawa Toko Anda<br/>Naik Kelas?</h2>
            <p class="text-lg text-gray-500 mb-10 max-w-lg mx-auto">Bergabung dengan UMKM beta yang sudah merasakan bedanya. Gratis 14 hari, tanpa kartu kredit.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="btn-glow group px-10 py-5 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold text-lg rounded-2xl shadow-2xl shadow-primary/30 hover:shadow-3xl hover:scale-105 transition-all flex items-center justify-center gap-2">
                    Coba Gratis 14 Hari
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
                <!-- GANTI NOMOR WA ASLI SEBELUM PUBLISH -->
                <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20tanya%20tentang%20TokoQ" target="_blank" class="px-10 py-5 bg-white text-primary font-bold text-lg rounded-2xl border-2 border-primary/10 hover:border-primary/30 hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">chat</span>
                    Hubungi via WhatsApp
                </a>
            </div>
            <p class="text-sm text-gray-400 mt-6">Gratis 14 hari &bull; Tanpa kartu kredit &bull; Batal kapan saja</p>
        </div>
    </div>
</section>
</main>

<!-- FOOTER -->
<footer class="footer-gradient text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-10 mb-12">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-5">
                    <img src="/images/logo-tokoq.png" alt="TokoQ" width="120" height="32"/>
                </div>
                <p class="text-gray-400 text-sm max-w-sm mb-6 leading-relaxed">Mendigitalisasi UMKM Indonesia melalui solusi kasir dan inventori berbasis AI yang intuitif dan mudah digunakan.</p>
                <div class="flex gap-3">
                    <span class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-gray-400" title="Bahasa Indonesia"><span class="material-symbols-outlined text-[18px]">language</span></span>
                    <a class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-primary transition-colors" href="#testimoni" title="Testimoni"><span class="material-symbols-outlined text-[18px]">group</span></a>
                </div>
            </div>
            <div>
                <h4 class="font-bold text-white mb-5">Produk</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a class="hover:text-white transition-colors" href="#fitur">Sistem Kasir</a></li>
                    <li><a class="hover:text-white transition-colors" href="#fitur">Manajemen Stok</a></li>
                    <li><a class="hover:text-white transition-colors" href="#fitur">Laporan Keuangan</a></li>
                    <li><a class="hover:text-white transition-colors" href="#harga">Harga</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white mb-5">Dukungan</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a class="hover:text-white transition-colors" href="#faq">Pusat Bantuan</a></li>
                    <li><a class="hover:text-white transition-colors" href="#demo">Tutorial</a></li>
                    <li><a class="hover:text-white transition-colors" href="https://wa.me/6281234567890" target="_blank">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500">&copy; 2025 TokoQ Indonesia. Semua hak dilindungi.</p>
            <div class="flex gap-6 text-sm text-gray-500">
                <span class="text-gray-600 cursor-default" title="Segera hadir">Kebijakan Privasi</span>
                <span class="text-gray-600 cursor-default" title="Segera hadir">Syarat &amp; Ketentuan</span>
            </div>
        </div>
    </div>
</footer>

<script>
// Scroll progress
const progressBar = document.getElementById('scroll-progress');
window.addEventListener('scroll', () => {
    if (!progressBar) return;
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    progressBar.style.width = (docHeight > 0 ? (scrollTop / docHeight) * 100 : 0) + '%';
});

// Floating particles
const particlesContainer = document.getElementById('particles');
if (particlesContainer) {
    for (let i = 0; i < 15; i++) {
        const p = document.createElement('div');
        p.className = 'scroll-particle';
        p.style.cssText = 'left:' + (Math.random()*100) + '%;top:' + (Math.random()*100) + '%;width:' + (4+Math.random()*8) + 'px;height:' + (4+Math.random()*8) + 'px;background:rgba(16,185,129,' + (0.1+Math.random()*0.2) + ');animation-delay:' + (Math.random()*6) + 's;animation-duration:' + (5+Math.random()*5) + 's;';
        particlesContainer.appendChild(p);
    }
}

// Navbar scroll
const navbar = document.getElementById('navbar');
let lastScroll = 0;
window.addEventListener('scroll', () => {
    const currentScroll = window.scrollY;
    if (currentScroll > 50) { navbar.classList.add('nav-scrolled'); navbar.classList.remove('bg-transparent', 'border-transparent'); }
    else { navbar.classList.remove('nav-scrolled'); navbar.classList.add('bg-transparent', 'border-transparent'); }
    if (currentScroll > 100 && lastScroll <= 100) { navbar.classList.remove('nav-drop'); void navbar.offsetWidth; navbar.classList.add('nav-drop'); }
    lastScroll = currentScroll;
});

// Mobile menu
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        mobileMenuBtn.querySelector('.material-symbols-outlined').textContent = mobileMenu.classList.contains('open') ? 'close' : 'menu';
    });
    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => { mobileMenu.classList.remove('open'); mobileMenuBtn.querySelector('.material-symbols-outlined').textContent = 'menu'; });
    });
}

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});

// Reveal fallback
const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
revealElements.forEach(el => revealObserver.observe(el));

// FAQ toggle
function toggleFaq(btn) {
    const item = btn.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const isOpen = item.classList.contains('open');
    // Close all
    document.querySelectorAll('.faq-item').forEach(fi => {
        fi.classList.remove('open');
        fi.querySelector('.faq-answer').style.maxHeight = null;
        fi.querySelector('button').setAttribute('aria-expanded', 'false');
    });
    // Open clicked if it was closed
    if (!isOpen) {
        item.classList.add('open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        btn.setAttribute('aria-expanded', 'true');
    }
}

// GSAP animations
if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    // Hero parallax
    const heroSection = document.querySelector('.hero-bg');
    if (heroSection) {
        const heroContent = heroSection.querySelector('.max-w-2xl');
        if (heroContent) {
            gsap.to(heroContent, { y: 100, opacity: 0, ease: 'none', scrollTrigger: { trigger: heroSection, start: 'top top', end: 'center top', scrub: true } });
        }
    }

    // Problem cards
    const problemSection = document.querySelector('section.py-20.bg-white');
    if (problemSection) {
        const cards = problemSection.querySelectorAll('.group.relative');
        cards.forEach((card, i) => {
            gsap.fromTo(card, { y: 80, opacity: 0, rotation: -3 }, { y: 0, opacity: 1, rotation: 0, duration: 0.8, delay: i * 0.2, ease: 'power3.out', scrollTrigger: { trigger: card, start: 'top 85%', toggleActions: 'play none none reverse' } });
        });
    }

    // Fluid cards
    const solutionSection = document.querySelector('#fitur');
    if (solutionSection) {
        const fluidCards = solutionSection.querySelectorAll('.fluid-card');
        fluidCards.forEach((card, i) => {
            gsap.fromTo(card, { y: 60, opacity: 0, scale: 0.9 }, { y: 0, opacity: 1, scale: 1, duration: 0.6, delay: i * 0.12, ease: 'back.out(1.2)', scrollTrigger: { trigger: card, start: 'top 88%' } });
        });
    }

    // Steps
    const howSection = document.querySelector('#cara-kerja');
    if (howSection) {
        const steps = howSection.querySelectorAll('.text-center.relative');
        steps.forEach((step, i) => {
            gsap.fromTo(step, { y: 80, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, delay: i * 0.2, ease: 'power3.out', scrollTrigger: { trigger: step, start: 'top 88%' } });
        });
    }

    // Impact
    const impactSec = document.querySelector('#dampak');
    if (impactSec) {
        const impactBox = impactSec.querySelector('.bg-gradient-to-br');
        if (impactBox) {
            gsap.set(impactBox, { y: 60, opacity: 0, scale: 0.95 });
            gsap.to(impactBox, { y: 0, opacity: 1, scale: 1, duration: 0.8, ease: 'power3.out', scrollTrigger: { trigger: impactBox, start: 'top 80%', toggleActions: 'play none none reverse' } });
        }
    }

    // Testimonials
    const testimonialSection = document.querySelector('#testimoni');
    if (testimonialSection) {
        const testCards = testimonialSection.querySelectorAll('.card-lift');
        testCards.forEach((card, i) => {
            gsap.fromTo(card, { y: 60, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, delay: i * 0.15, ease: 'power3.out', scrollTrigger: { trigger: card, start: 'top 88%' } });
        });
    }

    // Pricing
    const pricingSection = document.querySelector('#harga');
    if (pricingSection) {
        const pricingCards = pricingSection.querySelectorAll('.card-lift');
        pricingCards.forEach((card, i) => {
            gsap.fromTo(card, { y: 60, opacity: 0, scale: 0.95 }, { y: 0, opacity: 1, scale: 1, duration: 0.6, delay: i * 0.15, ease: 'power3.out', scrollTrigger: { trigger: card, start: 'top 88%' } });
        });
    }

    // CTA
    const ctaSection = document.querySelector('#mulai');
    if (ctaSection) {
        const ctaIcon = ctaSection.querySelector('.w-20.h-20');
        if (ctaIcon) {
            gsap.fromTo(ctaIcon, { scale: 0, rotation: -30, opacity: 0 }, { scale: 1, rotation: 0, opacity: 1, duration: 0.8, ease: 'back.out(2)', scrollTrigger: { trigger: ctaIcon, start: 'top 85%' } });
        }
    }

    ScrollTrigger.refresh();
}
</script>
</body>
</html>
