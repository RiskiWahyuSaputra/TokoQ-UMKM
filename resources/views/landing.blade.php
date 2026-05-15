<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TokoQ - Sistem Kasir & Digital UMKM</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
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

/* Navbar scroll effect - transparent by default */
.nav-scrolled {
    background: rgba(255, 255, 255, 0.95) !important;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
}

/* Navbar link colors - default (transparent bg) */
.nav-link {
    color: rgba(255, 255, 255, 0.85);
    transition: color 0.3s ease;
}
.nav-link:hover {
    color: #ffffff;
}

/* Navbar link colors - scrolled (white bg) */
.nav-scrolled .nav-link {
    color: #4B5563;
}
.nav-scrolled .nav-link:hover {
    color: #10B981;
}

/* Navbar brand - default */
.nav-brand {
    color: #ffffff;
    transition: color 0.3s ease;
}

/* Navbar brand - scrolled */
.nav-scrolled .nav-brand {
    color: #10B981;
}

/* Navbar mobile button - default */
.nav-mobile-btn {
    color: #ffffff;
    transition: color 0.3s ease;
}
.nav-mobile-btn:hover {
    background: rgba(255,255,255,0.1);
}

/* Navbar mobile button - scrolled */
.nav-scrolled .nav-mobile-btn {
    color: #4B5563;
}
.nav-scrolled .nav-mobile-btn:hover {
    background: #F3F4F6;
}

/* Navbar drop animation */
@keyframes navDrop {
    from {
        opacity: 0;
        transform: translateY(-100%);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.nav-drop {
    animation: navDrop 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

/* Hero with background image */
.hero-bg {
    background-image: url('/images/bg-hero.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
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

/* Custom transition duration */
.duration-400 { transition-duration: 400ms; }

/* ===== SCROLL PROGRESS ===== */
.scroll-progress {
  position: fixed;
  top: 0;
  left: 0;
  width: 0%;
  height: 3px;
  background: linear-gradient(90deg, #10B981, #34D399, #059669);
  z-index: 9999;
  transition: width 0.1s linear;
}

/* ===== GSAP SCROLL ANIMATIONS ===== */
.scroll-animate {
  opacity: 0;
  transform: translateY(60px);
}
.scroll-animate-left {
  opacity: 0;
  transform: translateX(-80px);
}
.scroll-animate-right {
  opacity: 0;
  transform: translateX(80px);
}
.scroll-animate-scale {
  opacity: 0;
  transform: scale(0.8);
}
.scroll-animate-rotate {
  opacity: 0;
  transform: rotate(-10deg) translateY(40px);
}

/* Parallax layers */
.parallax-bg {
  will-change: transform;
}
.parallax-slow {
  will-change: transform;
}
.parallax-fast {
  will-change: transform;
}

/* Section reveal overlay */
.section-reveal {
  position: relative;
  overflow: hidden;
}
.section-reveal::after {
  content: '';
  position: absolute;
  inset: 0;
  background: #10B981;
  transform: translateX(0);
  transition: transform 0.8s cubic-bezier(0.77, 0, 0.175, 1);
  z-index: 10;
}
.section-reveal.revealed::after {
  transform: translateX(100%);
}

/* Floating particles */
@keyframes float-particle {
  0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
  25% { transform: translateY(-30px) rotate(90deg); opacity: 0.6; }
  50% { transform: translateY(-15px) rotate(180deg); opacity: 0.4; }
  75% { transform: translateY(-40px) rotate(270deg); opacity: 0.5; }
}
.scroll-particle {
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
  animation: float-particle 6s ease-in-out infinite;
}

/* Text reveal animation */
.text-reveal {
  overflow: hidden;
}
.text-reveal span {
  display: inline-block;
  transform: translateY(100%);
  opacity: 0;
}

/* Counter scroll */
.counter-scroll {
  display: inline-block;
}

/* Smooth section separators */
.section-separator {
  position: relative;
}
.section-separator::before {
  content: '';
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 1px;
  height: 80px;
  background: linear-gradient(to bottom, transparent, #10B981, transparent);
}

/* Magnetic hover effect */
.magnetic-hover {
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Glow line animation */
@keyframes glow-line {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
.glow-line {
  background: linear-gradient(90deg, #10B981, #34D399, #059669, #10B981);
  background-size: 200% 100%;
  animation: glow-line 3s ease infinite;
}

/* ===== STORY SCROLL ===== */
.story-scroll-container {
  position: relative;
  width: 100%;
  overflow-x: hidden;
}
.story-section {
  position: relative;
  min-height: 100vh;
  width: 100%;
  overflow: hidden;
}
.story-section-inner {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 100vh;
  padding: clamp(2rem, 8vw, 4rem) clamp(2rem, 5vw, 4rem);
  will-change: transform;
  transform-origin: bottom left;
}
.story-section-title {
  font-size: clamp(2.5rem, 10vw, 9rem);
  font-weight: 800;
  line-height: 0.85;
  letter-spacing: -0.02em;
  text-transform: uppercase;
}
.story-section-text {
  font-size: clamp(0.9rem, 2vw, 1.5rem);
  line-height: 1.6;
  max-width: 50ch;
}
.story-section-label {
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.2em;
  text-transform: uppercase;
}
.story-hr {
  border: none;
  border-top: 1px solid currentColor;
  opacity: 0.15;
  margin: clamp(1rem, 3vw, 2rem) 0;
}
.story-grid-3 {
  display: flex;
  flex-wrap: wrap;
  gap: clamp(1rem, 3vw, 2rem);
}
.story-grid-3 > div {
  flex: 1;
  min-width: 180px;
}
.story-grid-3 p:first-child {
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 0.5rem;
}
.story-grid-3 p:last-child {
  font-size: clamp(0.8rem, 1.2vw, 0.95rem);
  line-height: 1.6;
  opacity: 0.7;
}
@media (max-width: 640px) {
  .story-grid-3 > div {
    min-width: 100%;
  }
}
</style>
</head>
<body class="font-body-md">

<!-- Scroll Progress Bar -->
<div class="scroll-progress" id="scroll-progress"></div>

<!-- Floating Particles -->
<div id="particles" class="fixed inset-0 pointer-events-none z-0 overflow-hidden"></div>


<!-- ===== NAVIGATION ===== -->
<header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-transparent border-b border-transparent">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="#" class="flex items-center gap-2.5 group">
            <img src="/images/logo-tokoq.png" alt="TokoQ" style="width: 150px;" class=" group-hover:scale-105 transition-transform"/>
        </a>

        <nav class="hidden md:flex items-center gap-8">
            <a href="#fitur" class="nav-link text-sm font-medium transition-colors">Fitur</a>
            <a href="#cara-kerja" class="nav-link text-sm font-medium transition-colors">Cara Kerja</a>
            <a href="#dampak" class="nav-link text-sm font-medium transition-colors">Dampak</a>
            <a href="/login" class="nav-link text-sm font-medium transition-colors">Masuk</a>
            <a href="/register" class="px-5 py-2.5 bg-white text-primary text-sm font-bold rounded-full shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                Daftar Gratis
            </a>
        </nav>

        <button id="mobile-menu-btn" class="nav-mobile-btn md:hidden w-10 h-10 rounded-xl flex items-center justify-center transition-colors">
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
            <a href="/register" class="block w-full text-center px-5 py-3 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl shadow-lg">
                Daftar Gratis
            </a>
        </nav>
    </div>
</header>

<main>
<!-- ===== HERO SECTION ===== -->
<section class="relative min-h-screen flex items-center hero-bg overflow-hidden pt-16">
    <!-- Overlay for better text readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/60 via-emerald-800/40 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-6 py-20 lg:py-0 w-full relative z-10">
        <div class="max-w-2xl">
            <!-- Left: Text Only -->
            <div class="space-y-8">
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/15 backdrop-blur-sm rounded-full text-xs font-bold text-white border border-white/20">
                        <span class="material-symbols-outlined text-[14px] text-emerald-300">verified</span>
                        SOLUSI DIGITAL UMKM INDONESIA
                    </div>
                </div>

                <h1 class="animate-fade-in-up delay-100 text-4xl md:text-5xl lg:text-[56px] font-extrabold leading-[1.1] text-white drop-shadow-lg">
                    Sistem Kasir &<br/>
                    Digital Twin<br/>
                    untuk UMKM
                </h1>

                <p class="animate-fade-in-up delay-200 text-lg text-white/80 max-w-lg leading-relaxed drop-shadow-sm">
                    Kelola stok barang, catat penjualan otomatis, dan pantau performa toko Anda melalui satu dashboard cerdas yang terasa nyata.
                </p>

                <div class="animate-fade-in-up delay-300 flex flex-wrap gap-4">
                    <a href="/register" class="btn-glow group px-8 py-4 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-primary/25 hover:shadow-2xl hover:shadow-primary/35 hover:scale-105 transition-all flex items-center gap-2">
                        Daftar Toko Saya
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="#fitur" class="px-8 py-4 bg-white/15 backdrop-blur-sm text-white font-bold rounded-2xl border border-white/20 hover:bg-white/25 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">play_circle</span>
                        Lihat Fitur
                    </a>
                </div>

                <!-- Trust badges -->
                <div class="animate-fade-in-up delay-400 flex items-center gap-6 pt-4">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 border-2 border-white/30"></div>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 border-2 border-white/30"></div>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 border-2 border-white/30"></div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">{{ number_format($totalShops) }}+</p>
                            <p class="text-[10px] text-white/60">UMKM Bergabung</p>
                        </div>
                    </div>
                    <div class="h-8 w-px bg-white/20"></div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-amber-400 text-[18px]">star</span>
                        <span class="text-sm font-bold text-white">4.9</span>
                        <span class="text-xs text-white/60">Rating</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2">
            <p class="text-white/50 text-[10px] uppercase tracking-[0.3em]">Scroll</p>
            <div class="w-5 h-8 rounded-full border-2 border-white/30 flex items-start justify-center p-1">
                <div class="w-1 h-2 bg-white/60 rounded-full animate-bounce-subtle"></div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PROBLEM SECTION ===== -->
<section class="py-24 bg-white relative overflow-hidden section-separator">
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
            <!-- Card 1: Pencatatan Manual (Red) -->
            <div class="reveal delay-100 group relative flex flex-col justify-between w-full p-6 overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out hover:scale-[1.02] min-h-[220px] bg-red-500/90 text-white">
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-3xl text-white">edit_note</span>
                    </div>
                    <h3 class="text-2xl font-bold tracking-tight">Pencatatan Manual</h3>
                    <p class="text-sm text-white/80 mt-2 leading-relaxed">Buku nota sering hilang, kotor, atau salah hitung.</p>
                    <a href="#fitur" aria-label="Learn more about Pencatatan Manual" class="mt-auto pt-4 flex items-center text-sm font-semibold group-hover:underline">
                        PELAJARI SOLUSI
                        <span class="material-symbols-outlined ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
                <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=200&h=200&fit=crop" alt="Messy notebook and pen" class="absolute -right-6 -bottom-6 w-36 h-36 object-contain opacity-80 group-hover:opacity-100 group-hover:scale-110 group-hover:rotate-6 transition-all duration-400 ease-in-out rounded-2xl" loading="lazy"/>
            </div>

            <!-- Card 2: Stok Tidak Terkontrol (Amber/Gray) -->
            <div class="reveal delay-200 group relative flex flex-col justify-between w-full p-6 overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out hover:scale-[1.02] min-h-[220px] bg-gray-600 text-white">
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-3xl text-white">inventory</span>
                    </div>
                    <h3 class="text-2xl font-bold tracking-tight">Stok Tidak Terkontrol</h3>
                    <p class="text-sm text-white/80 mt-2 leading-relaxed">Barang habis tanpa diketahui, pelanggan kecewa.</p>
                    <a href="#fitur" aria-label="Learn more about Stok Tidak Terkontrol" class="mt-auto pt-4 flex items-center text-sm font-semibold group-hover:underline">
                        PELAJARI SOLUSI
                        <span class="material-symbols-outlined ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=200&h=200&fit=crop" alt="Empty warehouse shelf" class="absolute -right-6 -bottom-6 w-36 h-36 object-contain opacity-80 group-hover:opacity-100 group-hover:scale-110 group-hover:rotate-6 transition-all duration-400 ease-in-out rounded-2xl" loading="lazy"/>
            </div>

            <!-- Card 3: Laba Tidak Jelas (Blue) -->
            <div class="reveal delay-300 group relative flex flex-col justify-between w-full p-6 overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out hover:scale-[1.02] min-h-[220px] bg-blue-500/90 text-white">
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-3xl text-white">account_balance_wallet</span>
                    </div>
                    <h3 class="text-2xl font-bold tracking-tight">Laba Tidak Jelas</h3>
                    <p class="text-sm text-white/80 mt-2 leading-relaxed">Uang toko dan pribadi sering tercampur.</p>
                    <a href="#fitur" aria-label="Learn more about Laba Tidak Jelas" class="mt-auto pt-4 flex items-center text-sm font-semibold group-hover:underline">
                        PELAJARI SOLUSI
                        <span class="material-symbols-outlined ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=200&h=200&fit=crop" alt="Calculator and money" class="absolute -right-6 -bottom-6 w-36 h-36 object-contain opacity-80 group-hover:opacity-100 group-hover:scale-110 group-hover:rotate-6 transition-all duration-400 ease-in-out rounded-2xl" loading="lazy"/>
            </div>
        </div>
    </div>
</section>

<!-- ===== STORY SCROLL ===== -->
<div class="story-scroll-container" id="story-scroll">
  <!-- Section 1: TokoQ itu apa? (Emerald) -->
  <section class="story-section" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: #fff;">
    <div class="story-section-inner">
      <div>
        <p class="story-section-label">01 — TokoQ itu apa?</p>
        <hr class="story-hr"/>
        <h2 class="story-section-title">
          Bangun<br/>
          Toko Tanpa<br/>
          Batas
        </h2>
      </div>
      <hr class="story-hr"/>
      <p class="story-section-text" style="opacity: 0.85;">
        TokoQ adalah sistem kasir dan manajemen toko berbasis AI yang dirancang khusus untuk UMKM Indonesia. Satu dashboard untuk semua kebutuhan operasional Anda.
      </p>
    </div>
  </section>

  <!-- Section 2: Misi Kami (Dark) -->
  <section class="story-section" style="background: #111827; color: #fff;">
    <div class="story-section-inner">
      <div>
        <p class="story-section-label">02 — Misi Kami</p>
        <hr class="story-hr"/>
        <h2 class="story-section-title">
          UMKM<br/>
          Naik<br/>
          Kelas
        </h2>
      </div>
      <hr class="story-hr"/>
      <p class="story-section-text" style="opacity: 0.8;">
        Kami percaya setiap pelaku UMKM layak mendapat akses teknologi canggih. Bukan hanya soal digitalisasi — tapi tentang memberdayakan ekonomi dari bawah.
      </p>
      <hr class="story-hr"/>
      <div class="story-grid-3">
        <div>
          <p>Akses Mudah</p>
          <p>Buka dari HP, tablet, atau komputer. Tidak perlu instalasi ribet, cukup browser.</p>
        </div>
        <div>
          <p>Harga Terjangkau</p>
          <p>Gratis untuk memulai. Bayar hanya saat bisnis Anda berkembang dan butuh fitur lebih.</p>
        </div>
        <div>
          <p>Support Lokal</p>
          <p>Tim support yang paham konteks UMKM Indonesia, siap membantu kapan saja.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 3: Cara Kerja (Cream) -->
  <section class="story-section" style="background: #F5F0E8; color: #1F2937;">
    <div class="story-section-inner">
      <div>
        <p class="story-section-label">03 — Cara Kerja</p>
        <hr class="story-hr"/>
        <h2 class="story-section-title">
          Daftar.<br/>
          Tambah.<br/>
          Jual.
        </h2>
      </div>
      <hr class="story-hr"/>
      <p class="story-section-text" style="opacity: 0.75;">
        Tiga langkah sederhana untuk membawa toko Anda ke era digital. Tidak perlu teknis, tidak perlu lama.
      </p>
      <hr class="story-hr"/>
      <div class="story-grid-3">
        <div>
          <p>01 — Daftar Gratis</p>
          <p>Buat akun dalam 30 detik. Masukkan nama toko dan data dasar Anda.</p>
        </div>
        <div>
          <p>02 — Tambah Produk</p>
          <p>Foto barang, atur harga, masukkan stok. Bisa juga import dari Excel.</p>
        </div>
        <div>
          <p>03 — Mulai Jual</p>
          <p>Buka kasir, catat transaksi, dan pantau penjualan real-time.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 4: Dampak Nyata (Blue) -->
  <section class="story-section" style="background: linear-gradient(135deg, #1E40AF 0%, #7C3AED 100%); color: #fff;">
    <div class="story-section-inner">
      <div>
        <p class="story-section-label">04 — Dampak Nyata</p>
        <hr class="story-hr"/>
        <h2 class="story-section-title">
          Angka<br/>
          yang<br/>
          Bicara
        </h2>
      </div>
      <hr class="story-hr"/>
      <p class="story-section-text" style="opacity: 0.85;">
        Bukan janji kosong. Ini adalah hasil nyata dari UMKM yang sudah bergabung dengan TokoQ.
      </p>
      <hr class="story-hr"/>
      <div class="story-grid-3">
        <div>
          <p>40%</p>
          <p>Pengurangan stok kosong berkat prediksi AI yang menganalisis pola penjualan.</p>
        </div>
        <div>
          <p>2 Jam</p>
          <p>Waktu yang dihemat setiap hari dari rekap manual menjadi otomatis.</p>
        </div>
        <div>
          <p>99.9%</p>
          <p>Uptime sistem. Toko Anda selalu siap beroperasi kapan saja.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 5: Bergabung (Dark) -->
  <section class="story-section" style="background: #0f172a; color: #fff;">
    <div class="story-section-inner">
      <div>
        <p class="story-section-label">05 — Bergabung Sekarang</p>
        <hr class="story-hr"/>
        <h2 class="story-section-title">
          Siap<br/>
          Mulai<br/>
          Hari Ini?
        </h2>
      </div>
      <hr class="story-hr"/>
      <p class="story-section-text" style="opacity: 0.8;">
        Bergabunglah dengan ribuan pelaku UMKM yang sudah merasakan bedanya. Gratis 14 hari, tanpa kartu kredit.
      </p>
      <hr class="story-hr"/>
      <div>
        <a href="/register" class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-primary to-emerald-500 text-white font-bold text-lg rounded-2xl shadow-2xl shadow-primary/30 hover:shadow-primary/50 hover:scale-105 transition-all">
          Daftar Gratis
          <span class="material-symbols-outlined">arrow_forward</span>
        </a>
      </div>
    </div>
  </section>
</div>

<script>
// ===== STORY SCROLL - GSAP ScrollTrigger =====
if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
  gsap.registerPlugin(ScrollTrigger);

  const storyContainer = document.querySelector('#story-scroll');
  if (storyContainer) {
    const sections = storyContainer.querySelectorAll('.story-section');

    sections.forEach((section, i) => {
      const inner = section.querySelector('.story-section-inner');
      if (!inner) return;

      // Set z-index so later sections stack on top
      gsap.set(section, { zIndex: i + 1 });

      // First section: no rotation
      if (i > 0) {
        gsap.set(inner, { rotation: 30, transformOrigin: 'bottom left' });

        gsap.to(inner, {
          rotation: 0,
          ease: 'none',
          scrollTrigger: {
            trigger: section,
            start: 'top bottom',
            end: 'top 25%',
            scrub: true,
          }
        });
      }

      // Pin all sections except the last one
      if (i < sections.length - 1) {
        ScrollTrigger.create({
          trigger: section,
          start: 'bottom bottom',
          end: 'bottom top',
          pin: true,
          pinSpacing: false,
        });
      }
    });

    ScrollTrigger.refresh();
  }
}
</script>

<!-- ===== SOLUTION / FLUID EXPANDING GRID ===== -->
<section id="fitur" class="py-24 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 rounded-full text-xs font-bold text-primary mb-4">
                <span class="material-symbols-outlined text-[14px]">auto_awesome</span>
                SOLUSI LENGKAP
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">Satu Dashboard untuk<br/>Operasional Toko</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Klik fitur di bawah untuk melihat detail lengkap. Semua ada dalam satu platform.</p>
        </div>

        <!-- Fluid Expanding Grid -->
        <div id="fluid-grid" class="w-full max-w-2xl mx-auto">
            <div class="grid grid-cols-2 grid-rows-2 gap-5 w-full h-[340px] sm:h-[440px] md:h-[500px] transition-all duration-500 ease-in-out">
                <!-- Card 1: Kasir POS (emerald) -->
                <div class="fluid-card relative cursor-pointer group w-full h-full rounded-[32px] overflow-hidden bg-zinc-100"
                     data-id="kasir" data-color="#10B981"
                     onclick="expandGridItem(this)">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&auto=format&fit=crop&q=60"
                         alt="Kasir POS sistem modern"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"/>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-700"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px] border border-white/10 group-hover:border-white/20 transition-colors duration-500"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px]" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                    <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white z-10 select-none">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-medium mb-1 tracking-tight">Kasir POS</h3>
                        <p class="text-xs sm:text-sm text-white/80 font-normal">Transaksi cepat & QRIS otomatis</p>
                    </div>
                </div>

                <!-- Card 2: Inventori (blue) -->
                <div class="fluid-card relative cursor-pointer group w-full h-full rounded-[32px] overflow-hidden bg-zinc-100"
                     data-id="inventori" data-color="#3B82F6"
                     onclick="expandGridItem(this)">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=600&auto=format&fit=crop&q=60"
                         alt="Manajemen inventori stok barang"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"/>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-700"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px] border border-white/10 group-hover:border-white/20 transition-colors duration-500"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px]" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                    <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white z-10 select-none">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-medium mb-1 tracking-tight">Inventori</h3>
                        <p class="text-xs sm:text-sm text-white/80 font-normal">Stok otomatis & notifikasi real-time</p>
                    </div>
                </div>

                <!-- Card 3: Prediksi AI (purple) -->
                <div class="fluid-card relative cursor-pointer group w-full h-full rounded-[32px] overflow-hidden bg-zinc-100"
                     data-id="ai" data-color="#8B5CF6"
                     onclick="expandGridItem(this)">
                    <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?w=600&auto=format&fit=crop&q=60"
                         alt="AI prediksi bisnis"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"/>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-700"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px] border border-white/10 group-hover:border-white/20 transition-colors duration-500"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px]" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                    <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white z-10 select-none">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-medium mb-1 tracking-tight">Prediksi AI</h3>
                        <p class="text-xs sm:text-sm text-white/80 font-normal">Tahu kapan harus restok barang</p>
                    </div>
                </div>

                <!-- Card 4: Laporan (amber) -->
                <div class="fluid-card relative cursor-pointer group w-full h-full rounded-[32px] overflow-hidden bg-zinc-100"
                     data-id="laporan" data-color="#F59E0B"
                     onclick="expandGridItem(this)">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&auto=format&fit=crop&q=60"
                         alt="Laporan keuangan dashboard"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"/>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-700"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px] border border-white/10 group-hover:border-white/20 transition-colors duration-500"></div>
                    <div class="absolute inset-0 pointer-events-none rounded-[32px]" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                    <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white z-10 select-none">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-medium mb-1 tracking-tight">Laporan</h3>
                        <p class="text-xs sm:text-sm text-white/80 font-normal">Laba rugi harian dalam satu klik</p>
                    </div>
                </div>
            </div>

            <!-- Expanded detail panel (shown when item is selected) -->
            <div id="fluid-detail" class="hidden mt-6 rounded-3xl overflow-hidden shadow-2xl transition-all duration-500 ease-in-out">
                <div id="fluid-detail-content" class="p-8 md:p-10">
                    <!-- Filled by JS -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// ===== FLUID EXPANDING GRID =====
const detailContent = {
    kasir: {
        title: 'Kasir POS Cepat',
        desc: 'Transaksi lancar bahkan saat ramai. Mendukung pembayaran tunai, QRIS, dan transfer bank otomatis. Cetak nota thermal langsung dari browser.',
        tags: ['RESPONSIF', 'CETAK NOTA', 'QRIS', 'MULTI PEMBAYARAN'],
        color: '#10B981',
        icon: 'point_of_sale'
    },
    inventori: {
        title: 'Inventori Otomatis',
        desc: 'Stok berkurang otomatis setiap penjualan. Notifikasi stok menipis real-time via WhatsApp. Riwayat mutasi barang lengkap.',
        tags: ['AUTO STOK', 'NOTIFIKASI WA', 'RIWAYAT MUTASI'],
        color: '#3B82F6',
        icon: 'inventory_2'
    },
    ai: {
        title: 'Prediksi AI',
        desc: 'Machine learning menganalisis pola penjualan Anda. Rekomendasi jumlah pembelian optimal untuk mengurangi stok kosong hingga 40%.',
        tags: ['MACHINE LEARNING', 'PREDIKSI PENJUALAN', 'REKOMENDASI BELANJA'],
        color: '#8B5CF6',
        icon: 'psychology'
    },
    laporan: {
        title: 'Laporan Keuangan',
        desc: 'Laba rugi harian, mingguan, dan bulanan siap dalam satu klik. Export ke PDF atau Excel. Grafik visual yang mudah dipahami.',
        tags: ['EXPORT PDF/EXCEL', 'GRAFIK VISUAL', 'PERIODE FLEKSIBEL'],
        color: '#F59E0B',
        icon: 'description'
    }
};

let expandedId = null;

function expandGridItem(el) {
    const id = el.getAttribute('data-id');
    const grid = document.getElementById('fluid-grid').querySelector('.grid');
    const detail = document.getElementById('fluid-detail');
    const content = document.getElementById('fluid-detail-content');
    const cards = grid.querySelectorAll('.fluid-card');

    // If clicking the already-expanded item, collapse it
    if (expandedId === id) {
        expandedId = null;
        detail.classList.add('hidden');
        grid.classList.remove('grid-rows-3');
        grid.classList.add('grid-rows-2');
        cards.forEach(card => {
            card.classList.remove('col-span-2', 'row-start-1', 'row-start-2', 'row-start-3', 'opacity-40', 'scale-95');
            card.style.gridColumn = '';
            card.style.gridRow = '';
        });
        return;
    }

    expandedId = id;
    const info = detailContent[id];

    // Build detail panel
    content.innerHTML = `
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0" style="background: ${info.color}20;">
                <span class="material-symbols-outlined text-3xl" style="color: ${info.color};">${info.icon}</span>
            </div>
            <div class="flex-1">
                <h3 class="text-2xl font-extrabold text-gray-800 mb-3">${info.title}</h3>
                <p class="text-gray-500 leading-relaxed mb-4">${info.desc}</p>
                <div class="flex flex-wrap gap-2">
                    ${info.tags.map(tag => `<span class="px-3 py-1 rounded-full text-xs font-bold" style="background: ${info.color}15; color: ${info.color};">${tag}</span>`).join('')}
                </div>
            </div>
            <button onclick="closeDetail()" class="shrink-0 w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined text-gray-500">close</span>
            </button>
        </div>
    `;

    // Rearrange grid: expanded item goes full-width in its row, others compress
    grid.classList.remove('grid-rows-2');
    grid.classList.add('grid-rows-3');

    cards.forEach(card => {
        card.classList.remove('col-span-2', 'row-start-1', 'row-start-2', 'row-start-3', 'opacity-40', 'scale-95');
        card.style.gridColumn = '';
        card.style.gridRow = '';

        if (card.getAttribute('data-id') === id) {
            // Find which row the card is in
            const allCards = Array.from(cards);
            const idx = allCards.indexOf(card);
            const row = idx < 2 ? 1 : 2;
            card.style.gridColumn = '1 / span 2';
            card.style.gridRow = row;
        } else {
            // Dim non-selected cards slightly
            card.classList.add('opacity-60', 'scale-[0.97]');
        }
    });

    detail.classList.remove('hidden');
    detail.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function closeDetail() {
    expandedId = null;
    const grid = document.getElementById('fluid-grid').querySelector('.grid');
    const detail = document.getElementById('fluid-detail');
    const cards = grid.querySelectorAll('.fluid-card');

    detail.classList.add('hidden');
    grid.classList.remove('grid-rows-3');
    grid.classList.add('grid-rows-2');

    cards.forEach(card => {
        card.classList.remove('col-span-2', 'row-start-1', 'row-start-2', 'row-start-3', 'opacity-40', 'scale-95', 'opacity-60', 'scale-[0.97]');
        card.style.gridColumn = '';
        card.style.gridRow = '';
    });
}
</script>

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
                <div class="impact-left">
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

                <div class="impact-right grid grid-cols-2 gap-4">
                    <div class="rounded-3xl overflow-hidden shadow-2xl bg-gray-800 relative group">
                        <img alt="UMKM Activity" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&h=300&fit=crop"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
                            <p class="text-white text-xs font-medium">UMKM di seluruh Indonesia</p>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-primary to-emerald-600 p-6 rounded-3xl flex flex-col justify-center items-center text-center shadow-2xl shadow-primary/20 impact-stat">
                        <div class="text-4xl font-extrabold text-white mb-1 counter-value" data-target="{{ $totalShops }}">{{ number_format($totalShops) }}+</div>
                        <div class="text-sm text-white/80 font-medium">UMKM Bergabung</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-5 rounded-3xl border border-white/10">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-emerald-400 text-[16px]">trending_up</span>
                            </div>
                            <p class="text-white font-bold text-sm">Pertumbuhan</p>
                        </div>
                        <p class="text-2xl font-extrabold text-white">+150%</p>
                        <p class="text-[10px] text-gray-400 mt-1">Peningkatan efisiensi rata-rata</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-5 rounded-3xl border border-white/10">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-amber-400 text-[16px]">schedule</span>
                            </div>
                            <p class="text-white font-bold text-sm">Waktu Hemat</p>
                        </div>
                        <p class="text-2xl font-extrabold text-white">2 Jam</p>
                        <p class="text-[10px] text-gray-400 mt-1">Per hari dari rekap manual</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIAL / SOCIAL PROOF ===== -->
<section id="testimoni" class="py-24 bg-white">
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
<section id="mulai" class="py-24 relative overflow-hidden">
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
                    Mulai Sekarang - Gratis 14 Hari
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
                <a href="/register" class="px-10 py-5 bg-white text-primary font-bold text-lg rounded-2xl border-2 border-primary/10 hover:border-primary/30 hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">chat</span>
                    Hubungi Sales
                </a>
            </div>

            <p class="text-sm text-gray-400 mt-6">Gratis 14 hari &nbsp; Tanpa kartu kredit &nbsp; Batal kapan saja</p>
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
// ===== SCROLL PROGRESS BAR =====
const progressBar = document.getElementById('scroll-progress');
window.addEventListener('scroll', () => {
  if (!progressBar) return;
  const scrollTop = window.scrollY;
  const docHeight = document.documentElement.scrollHeight - window.innerHeight;
  const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
  progressBar.style.width = progress + '%';
});

// ===== FLOATING PARTICLES =====
const particlesContainer = document.getElementById('particles');
if (particlesContainer) {
  for (let i = 0; i < 15; i++) {
    const p = document.createElement('div');
    p.className = 'scroll-particle';
    p.style.cssText = `
      left: ${Math.random() * 100}%;
      top: ${Math.random() * 100}%;
      width: ${4 + Math.random() * 8}px;
      height: ${4 + Math.random() * 8}px;
      background: rgba(16, 185, 129, ${0.1 + Math.random() * 0.2});
      animation-delay: ${Math.random() * 6}s;
      animation-duration: ${5 + Math.random() * 5}s;
    `;
    particlesContainer.appendChild(p);
  }
}

// ===== NAVBAR SCROLL EFFECT =====
const navbar = document.getElementById('navbar');
let lastScroll = 0;
let isNavbarVisible = true;

window.addEventListener('scroll', () => {
  const currentScroll = window.scrollY;
  if (currentScroll > 50) {
    navbar.classList.add('nav-scrolled');
    navbar.classList.remove('bg-transparent', 'border-transparent');
  } else {
    navbar.classList.remove('nav-scrolled');
    navbar.classList.add('bg-transparent', 'border-transparent');
  }
  if (currentScroll > 100 && lastScroll <= 100 && isNavbarVisible) {
    navbar.classList.remove('nav-drop');
    void navbar.offsetWidth;
    navbar.classList.add('nav-drop');
  }
  lastScroll = currentScroll;
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

// ===== REVEAL FALLBACK =====
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

// ===== COUNTER ANIMATION =====
function animateCounter(element, target, suffix = '', duration = 2000) {
  let start = 0;
  const increment = target / (duration / 16);
  const timer = setInterval(() => {
    start += increment;
    if (start >= target) { start = target; clearInterval(timer); }
    element.textContent = Math.floor(start).toLocaleString('id-ID') + suffix;
  }, 16);
}
const impactSection = document.querySelector('#dampak');
if (impactSection) {
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counter = entry.target.querySelector('.counter-value');
        if (counter && !counter.dataset.animated) {
          counter.dataset.animated = 'true';
          const targetCount = parseInt(counter.dataset.target) || {{ $totalShops }};
          animateCounter(counter, targetCount, '+');
        }
      }
    });
  }, { threshold: 0.5 });
  const statElement = document.querySelector('#dampak .impact-stat');
  if (statElement) counterObserver.observe(statElement.parentElement);
}

// ===== GSAP SCROLL ANIMATIONS (Hero to Footer) =====
if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
  gsap.registerPlugin(ScrollTrigger);

  // --- HERO SECTION: Parallax layers ---
  const heroSection = document.querySelector('.hero-bg');
  if (heroSection) {
    const heroOverlay = heroSection.querySelector('.absolute.inset-0.bg-gradient-to-r');
    const heroContent = heroSection.querySelector('.max-w-2xl');
    const heroBadge = heroSection.querySelector('.animate-fade-in-up');
    const heroTitle = heroSection.querySelector('h1');
    const heroDesc = heroSection.querySelector('p.animate-fade-in-up');
    const heroBtns = heroSection.querySelector('.flex.flex-wrap.gap-4');
    const heroTrust = heroSection.querySelector('.flex.items-center.gap-6');

    // Parallax on hero background
    if (heroOverlay) {
      gsap.to(heroOverlay, {
        yPercent: 20,
        ease: 'none',
        scrollTrigger: { trigger: heroSection, start: 'top top', end: 'bottom top', scrub: true }
      });
    }
    // Fade out hero content on scroll
    if (heroContent) {
      gsap.to(heroContent, {
        y: 100,
        opacity: 0,
        ease: 'none',
        scrollTrigger: { trigger: heroSection, start: 'top top', end: 'center top', scrub: true }
      });
    }
    // Staggered entrance for hero elements (only on load)
    const heroElements = [heroBadge, heroTitle, heroDesc, heroBtns, heroTrust].filter(Boolean);
    heroElements.forEach((el, i) => {
      gsap.fromTo(el,
        { y: 40, opacity: 0 },
        { y: 0, opacity: 1, duration: 0.8, delay: 0.2 + i * 0.15, ease: 'power3.out' }
      );
    });
  }

  // --- PROBLEM SECTION: Cards stagger in ---
  const problemCards = document.querySelectorAll('#problem-section .group, [class*="Pencatatan Manual"]').length > 0
    ? document.querySelectorAll('.grid.md\\:grid-cols-3.gap-6 .group')
    : [];
  if (problemCards.length === 0) {
    // Fallback: target the 3 problem cards by their container
    const problemSection = document.querySelector('section.py-24.bg-white');
    if (problemSection) {
      const cards = problemSection.querySelectorAll('.group.relative');
      cards.forEach((card, i) => {
        gsap.fromTo(card,
          { y: 80, opacity: 0, rotation: -3 },
          {
            y: 0, opacity: 1, rotation: 0, duration: 0.8, delay: i * 0.2,
            ease: 'power3.out',
            scrollTrigger: { trigger: card, start: 'top 85%', toggleActions: 'play none none reverse' }
          }
        );
      });
      // Section title
      const probTitle = problemSection.querySelector('h2');
      if (probTitle) {
        gsap.fromTo(probTitle, { y: 40, opacity: 0 }, {
          y: 0, opacity: 1, duration: 0.7, ease: 'power3.out',
          scrollTrigger: { trigger: probTitle, start: 'top 85%' }
        });
      }
    }
  }

  // --- STORY SCROLL: Already handled by its own script above ---
  // (Story scroll GSAP is in the dedicated story-scroll script)

  // --- SOLUTION / FLUID GRID SECTION ---
  const solutionSection = document.querySelector('#fitur');
  if (solutionSection) {
    // Title reveal
    const solTitle = solutionSection.querySelector('h2');
    if (solTitle) {
      gsap.fromTo(solTitle, { y: 50, opacity: 0 }, {
        y: 0, opacity: 1, duration: 0.8, ease: 'power3.out',
        scrollTrigger: { trigger: solTitle, start: 'top 85%' }
      });
    }
    // Grid cards stagger
    const fluidCards = solutionSection.querySelectorAll('.fluid-card');
    fluidCards.forEach((card, i) => {
      gsap.fromTo(card,
        { y: 60, opacity: 0, scale: 0.9 },
        {
          y: 0, opacity: 1, scale: 1, duration: 0.6, delay: i * 0.12,
          ease: 'back.out(1.2)',
          scrollTrigger: { trigger: card, start: 'top 88%' }
        }
      );
    });
  }

  // --- HOW IT WORKS SECTION ---
  const howSection = document.querySelector('#cara-kerja');
  if (howSection) {
    // Title
    const howTitle = howSection.querySelector('h2');
    if (howTitle) {
      gsap.fromTo(howTitle, { y: 40, opacity: 0 }, {
        y: 0, opacity: 1, duration: 0.7, ease: 'power3.out',
        scrollTrigger: { trigger: howTitle, start: 'top 85%' }
      });
    }
    // Steps with horizontal slide
    const steps = howSection.querySelectorAll('.text-center.relative');
    steps.forEach((step, i) => {
      gsap.fromTo(step,
        { y: 80, opacity: 0 },
        {
          y: 0, opacity: 1, duration: 0.7, delay: i * 0.2,
          ease: 'power3.out',
          scrollTrigger: { trigger: step, start: 'top 88%' }
        }
      );
      // Icon circle bounce
      const icon = step.querySelector('.w-28.h-28');
      if (icon) {
        gsap.fromTo(icon,
          { scale: 0.5, opacity: 0, rotation: -15 },
          {
            scale: 1, opacity: 1, rotation: 0, duration: 0.6, delay: 0.1 + i * 0.2,
            ease: 'back.out(2)',
            scrollTrigger: { trigger: icon, start: 'top 88%' }
          }
        );
      }
    });
    // Connector line draw
    const connector = howSection.querySelector('.absolute.top-14');
    if (connector) {
      gsap.fromTo(connector, { scaleX: 0, transformOrigin: 'left' }, {
        scaleX: 1, duration: 1, ease: 'power2.out',
        scrollTrigger: { trigger: connector, start: 'top 80%' }
      });
    }
  }

  // --- IMPACT SECTION ---
  const impactSec = document.querySelector('#dampak');
  if (impactSec) {
    // Main container
    const impactBox = impactSec.querySelector('.bg-gradient-to-br');
    if (impactBox) {
      gsap.set(impactBox, { y: 60, opacity: 0, scale: 0.95 });
      gsap.to(impactBox, {
        y: 0, opacity: 1, scale: 1, duration: 0.8, ease: 'power3.out',
        scrollTrigger: { trigger: impactBox, start: 'top 80%', toggleActions: 'play none none reverse' }
      });
    }
    // Left content slide
    const impactLeft = impactSec.querySelector('.impact-left');
    if (impactLeft) {
      gsap.set(impactLeft, { x: -60, opacity: 0 });
      gsap.to(impactLeft, {
        x: 0, opacity: 1, duration: 0.8, ease: 'power3.out',
        scrollTrigger: { trigger: impactLeft, start: 'top 82%', toggleActions: 'play none none reverse' }
      });
    }
    // Right content slide
    const impactRight = impactSec.querySelector('.impact-right');
    if (impactRight) {
      gsap.set(impactRight, { x: 60, opacity: 0 });
      gsap.to(impactRight, {
        x: 0, opacity: 1, duration: 0.8, ease: 'power3.out',
        scrollTrigger: { trigger: impactRight, start: 'top 82%', toggleActions: 'play none none reverse' }
      });
    }
    // Checklist items stagger
    const checklistItems = impactSec.querySelectorAll('ul.space-y-5 li');
    checklistItems.forEach((item, i) => {
      gsap.fromTo(item,
        { x: -30, opacity: 0 },
        {
          x: 0, opacity: 1, duration: 0.5, delay: i * 0.15,
          ease: 'power2.out',
          scrollTrigger: { trigger: item, start: 'top 88%' }
        }
      );
    });
    // Decorative orbs parallax
    const orbs = impactSec.querySelectorAll('.absolute.w-96, .absolute.w-64');
    orbs.forEach((orb, i) => {
      gsap.to(orb, {
        y: i === 0 ? -40 : 30,
        ease: 'none',
        scrollTrigger: { trigger: impactSec, start: 'top bottom', end: 'bottom top', scrub: true }
      });
    });
  }

  // --- TESTIMONIAL SECTION ---
  const testimonialSection = document.querySelector('#testimoni');
  if (testimonialSection) {
    const testTitle = testimonialSection.querySelector('h2');
    if (testTitle) {
      gsap.fromTo(testTitle, { y: 40, opacity: 0 }, {
        y: 0, opacity: 1, duration: 0.7, ease: 'power3.out',
        scrollTrigger: { trigger: testTitle, start: 'top 85%' }
      });
    }
    const testCards = testimonialSection.querySelectorAll('.card-lift');
    testCards.forEach((card, i) => {
      gsap.fromTo(card,
        { y: 60, opacity: 0, rotation: i % 2 === 0 ? -2 : 2 },
        {
          y: 0, opacity: 1, rotation: 0, duration: 0.7, delay: i * 0.15,
          ease: 'power3.out',
          scrollTrigger: { trigger: card, start: 'top 88%' }
        }
      );
    });
  }

  // --- FINAL CTA SECTION ---
  const ctaSection = document.querySelector('#mulai');
  if (ctaSection) {
    // Icon bounce in
    const ctaIcon = ctaSection.querySelector('.w-20.h-20');
    if (ctaIcon) {
      gsap.fromTo(ctaIcon,
        { scale: 0, rotation: -30, opacity: 0 },
        {
          scale: 1, rotation: 0, opacity: 1, duration: 0.8,
          ease: 'back.out(2)',
          scrollTrigger: { trigger: ctaIcon, start: 'top 85%' }
        }
      );
    }
    // Title reveal
    const ctaTitle = ctaSection.querySelector('h2');
    if (ctaTitle) {
      gsap.fromTo(ctaTitle, { y: 50, opacity: 0 }, {
        y: 0, opacity: 1, duration: 0.8, ease: 'power3.out',
        scrollTrigger: { trigger: ctaTitle, start: 'top 85%' }
      });
    }
    // Text
    const ctaText = ctaSection.querySelector('p.text-lg');
    if (ctaText) {
      gsap.fromTo(ctaText, { y: 30, opacity: 0 }, {
        y: 0, opacity: 1, duration: 0.6, delay: 0.2, ease: 'power3.out',
        scrollTrigger: { trigger: ctaText, start: 'top 85%' }
      });
    }
    // Buttons stagger
    const ctaBtns = ctaSection.querySelectorAll('.flex.flex-col.sm\\:flex-row a');
    ctaBtns.forEach((btn, i) => {
      gsap.fromTo(btn,
        { y: 30, opacity: 0, scale: 0.9 },
        {
          y: 0, opacity: 1, scale: 1, duration: 0.5, delay: 0.3 + i * 0.1,
          ease: 'back.out(1.5)',
          scrollTrigger: { trigger: btn, start: 'top 88%' }
        }
      );
    });
    // Parallax on gradient background
    const ctaGradient = ctaSection.querySelector('.absolute.inset-0.hero-gradient');
    if (ctaGradient) {
      gsap.to(ctaGradient, {
        yPercent: 15,
        ease: 'none',
        scrollTrigger: { trigger: ctaSection, start: 'top bottom', end: 'bottom top', scrub: true }
      });
    }
  }

  // --- FOOTER ---
  const footer = document.querySelector('footer');
  if (footer) {
    // Fade up entire footer
    gsap.fromTo(footer,
      { y: 40, opacity: 0 },
      {
        y: 0, opacity: 1, duration: 0.8,
        ease: 'power3.out',
        scrollTrigger: { trigger: footer, start: 'top 90%' }
      }
    );
    // Stagger footer columns
    const footerCols = footer.querySelectorAll('.md\\:col-span-2, .space-y-3');
    footerCols.forEach((col, i) => {
      gsap.fromTo(col,
        { y: 20, opacity: 0 },
        {
          y: 0, opacity: 1, duration: 0.5, delay: i * 0.1,
          ease: 'power2.out',
          scrollTrigger: { trigger: col, start: 'top 92%' }
        }
      );
    });
  }

  // --- GLOBAL: Section separator lines draw ---
  const separators = document.querySelectorAll('.section-separator::before');
  // CSS handles this, but let's add a subtle scale animation
  document.querySelectorAll('.section-separator').forEach(sep => {
    gsap.fromTo(sep, { opacity: 0 }, {
      opacity: 1, duration: 0.5,
      scrollTrigger: { trigger: sep, start: 'top 90%' }
    });
  });

  // --- GLOBAL: Parallax on all section backgrounds ---
  document.querySelectorAll('.absolute').forEach(el => {
    if (el.classList.contains('blur-3xl') || el.classList.contains('blur-2xl') || el.classList.contains('blur-xl')) {
      const parent = el.closest('section');
      if (parent) {
        gsap.to(el, {
          y: 30,
          ease: 'none',
          scrollTrigger: { trigger: parent, start: 'top bottom', end: 'bottom top', scrub: true }
        });
      }
    }
  });

  ScrollTrigger.refresh();
}
</script>
</body>
</html>
