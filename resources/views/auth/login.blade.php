<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Masuk - TokoQ</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<script src="/js/tailwind-config.js"></script>
<style>
.material-symbols-outlined {
    font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInLeft {
    from { opacity: 0; transform: translateX(-30px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}
@keyframes floatSlow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(2deg); }
}
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes wiggle {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-5deg); }
    75% { transform: rotate(5deg); }
}

.animate-fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }
.animate-fade-in-left { animation: fadeInLeft 0.7s ease-out forwards; }
.animate-fade-in-right { animation: fadeInRight 0.7s ease-out forwards; }
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-float-slow { animation: floatSlow 8s ease-in-out infinite; }
.animate-gradient { 
    background-size: 200% 200%;
    animation: gradient-shift 4s ease infinite; 
}
.animate-wiggle { animation: wiggle 3s ease-in-out infinite; }

.gradient-text {
    background: linear-gradient(135deg, #10B981 0%, #059669 50%, #047857 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

.input-animated {
    transition: all 0.3s ease;
    border: 2px solid #E5E7EB;
}
.input-animated:focus {
    border-color: #10B981;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    transform: translateY(-1px);
}

.btn-shine {
    position: relative;
    overflow: hidden;
}
.btn-shine::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        to right,
        transparent 0%,
        rgba(255,255,255,0.15) 50%,
        transparent 100%
    );
    transform: rotate(30deg);
    transition: transform 0.6s;
}
.btn-shine:hover::after {
    transform: rotate(30deg) translateX(100%);
}

.particle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

.mockup-float {
    transform: perspective(1000px) rotateY(-8deg) rotateX(3deg);
    transition: transform 0.5s ease;
}
.mockup-float:hover {
    transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
}

::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #ECFDF5; }
::-webkit-scrollbar-thumb { background: #10B981; border-radius: 10px; }
</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#ECFDF5] via-[#D1FAE5] to-[#ECFDF5] relative overflow-x-hidden">

<!-- Background decorations -->
<div class="particle w-80 h-80 bg-primary/5 rounded-full -top-40 -right-40 blur-3xl fixed"></div>
<div class="particle w-96 h-96 bg-emerald-200/15 rounded-full -bottom-48 -left-48 blur-3xl fixed"></div>
<div class="particle w-4 h-4 bg-primary/20 top-[15%] left-[5%] animate-float fixed" style="animation-delay: 0s;"></div>
<div class="particle w-3 h-3 bg-emerald-400/25 top-[25%] right-[8%] animate-float fixed" style="animation-delay: 1.5s;"></div>
<div class="particle w-5 h-5 bg-teal-300/15 bottom-[20%] left-[12%] animate-float-slow fixed" style="animation-delay: 0.8s;"></div>
<div class="particle w-2.5 h-2.5 bg-green-400/20 top-[60%] right-[15%] animate-float fixed" style="animation-delay: 2s;"></div>

<div class="min-h-screen flex items-center justify-center py-12 px-4 relative z-10">
    <div class="w-full max-w-5xl grid lg:grid-cols-2 gap-8 items-center">

        <!-- Left: Branding -->
        <div class="hidden lg:block space-y-8 animate-fade-in-left">
            <a href="/" class="inline-flex items-center gap-2.5 group">
                <div class="w-11 h-11 bg-gradient-to-br from-primary to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-white text-[20px]">storefront</span>
                </div>
                <span class="text-2xl font-extrabold gradient-text">TokoQ</span>
            </a>

            <div>
                <h1 class="text-4xl font-extrabold text-gray-800 leading-tight mb-4">
                    Selamat Datang<br/>
                    <span class="gradient-text">Kembali!</span>
                </h1>
                <p class="text-gray-500 text-lg leading-relaxed">
                    Kelola toko UMKM Anda dengan lebih cerdas. Satu dashboard untuk semua kebutuhan bisnis.
                </p>
            </div>

            <!-- Dashboard Preview -->
            <div class="mockup-float bg-white p-3 rounded-2xl shadow-2xl shadow-primary/10 border border-gray-100 animate-float-slow">
                <img alt="Dashboard TokoQ" class="rounded-xl w-full h-auto" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYU9VD48rS3kvGDQYNd9vXImbRCRJ3TCWeSba83rjjHkZLKQbwfl8tZHRlNjeTLnwH4sPnHK0XC89H_lGNDyKkpMldYRTCdrC1LwsG4HOeaJQjtxTrcGebCTprcsnLpUIViTstqlYn90O52s_GAQ1h7I13ISDr9vCQqD4XSGTQl38uQBTAltMUywJXnE2KwN99jA0Z6GGQULPRtek-pIkRxJoD_2kwO0gyT7S5B45p7Kw27GKE7d5E0NpLlN1Ga-XZPoJXULwFsvk"/>
            </div>

            <!-- Stats -->
            <div class="flex items-center gap-6">
                <div class="text-center">
                    <p class="text-2xl font-extrabold gradient-text">10k+</p>
                    <p class="text-xs text-gray-400">UMKM Aktif</p>
                </div>
                <div class="w-px h-10 bg-gray-200"></div>
                <div class="text-center">
                    <p class="text-2xl font-extrabold gradient-text">1M+</p>
                    <p class="text-xs text-gray-400">Transaksi</p>
                </div>
                <div class="w-px h-10 bg-gray-200"></div>
                <div class="text-center">
                    <p class="text-2xl font-extrabold gradient-text">4.9</p>
                    <p class="text-xs text-gray-400">Rating</p>
                </div>
            </div>
        </div>

        <!-- Right: Login Form -->
        <div class="animate-fade-in-right">
            <div class="glass-card rounded-3xl shadow-2xl shadow-primary/10 p-8 border border-white/80 max-w-md mx-auto lg:mx-0 lg:ml-auto">
                <!-- Mobile logo -->
                <div class="lg:hidden text-center mb-6">
                    <a href="/" class="inline-flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-white text-[18px]">storefront</span>
                        </div>
                        <span class="text-xl font-extrabold gradient-text">TokoQ</span>
                    </a>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-extrabold text-gray-800">Masuk ke Akun</h2>
                    <p class="text-sm text-gray-400 mt-1">Kelola toko Anda dengan mudah</p>
                </div>

                @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 mb-6 flex items-center gap-2 animate-fade-in-up">
                    <span class="material-symbols-outlined text-red-500 text-[18px]">error</span>
                    <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
                </div>
                @endif

                <form method="POST" action="/login" class="space-y-5">
                    @csrf

                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-bold text-gray-700 mb-2">
                            <span class="material-symbols-outlined text-[16px] text-gray-400">mail</span>
                            Email
                        </label>
                        <input name="email" type="email" required value="{{ old('email') }}"
                            class="input-animated w-full px-4 py-3.5 rounded-xl bg-gray-50 focus:bg-white outline-none text-sm"
                            placeholder="email@example.com"/>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-bold text-gray-700 mb-2">
                            <span class="material-symbols-outlined text-[16px] text-gray-400">lock</span>
                            Password
                        </label>
                        <div class="relative">
                            <input name="password" type="password" required id="login-password"
                                class="input-animated w-full px-4 py-3.5 pr-12 rounded-xl bg-gray-50 focus:bg-white outline-none text-sm"
                                placeholder="Masukkan password"/>
                            <button type="button" onclick="toggleLoginPassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <span class="material-symbols-outlined text-[18px]" id="login-eye">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary"/>
                            <span class="text-sm text-gray-500">Ingat saya</span>
                        </label>
                        <a href="#" class="text-xs text-primary font-bold hover:underline">Lupa password?</a>
                    </div>

                    <button type="submit"
                        class="btn-shine w-full py-4 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all text-sm flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">login</span>
                        Masuk Sekarang
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-4 text-xs text-gray-400">atau</span>
                    </div>
                </div>

                <!-- Social login buttons (decorative) -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <button type="button" class="flex items-center justify-center gap-2 px-4 py-3 border-2 border-gray-100 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-200 transition-all">
                        <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                        Google
                    </button>
                    <button type="button" class="flex items-center justify-center gap-2 px-4 py-3 border-2 border-gray-100 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-200 transition-all">
                        <svg class="w-5 h-5" fill="#1877F2" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Facebook
                    </button>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-500">
                        Belum punya akun?
                        <a href="/register" class="text-primary font-bold hover:underline">Daftar Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleLoginPassword() {
    const input = document.getElementById('login-password');
    const eye = document.getElementById('login-eye');
    if (input.type === 'password') {
        input.type = 'text';
        eye.textContent = 'visibility_off';
    } else {
        input.type = 'password';
        eye.textContent = 'visibility';
    }
}
</script>
</body>
</html>
