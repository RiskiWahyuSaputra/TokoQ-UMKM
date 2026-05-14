<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Daftar UMKM - TokoQ</title>
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
@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes pulse-ring {
    0% { transform: scale(0.9); opacity: 1; }
    80%, 100% { transform: scale(1.3); opacity: 0; }
}
@keyframes bounce-subtle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}
@keyframes checkmark {
    0% { stroke-dashoffset: 50; }
    100% { stroke-dashoffset: 0; }
}

.animate-fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }
.animate-fade-in-left { animation: fadeInLeft 0.7s ease-out forwards; }
.animate-fade-in-right { animation: fadeInRight 0.7s ease-out forwards; }
.animate-scale-in { animation: scaleIn 0.5s ease-out forwards; }
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-float-slow { animation: floatSlow 8s ease-in-out infinite; }
.animate-gradient { 
    background-size: 200% 200%;
    animation: gradient-shift 4s ease infinite; 
}
.animate-bounce-subtle { animation: bounce-subtle 2s ease-in-out infinite; }

/* Gradient text */
.gradient-text {
    background: linear-gradient(135deg, #10B981 0%, #059669 50%, #047857 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Input focus animation */
.input-animated {
    transition: all 0.3s ease;
    border: 2px solid #E5E7EB;
}
.input-animated:focus {
    border-color: #10B981;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    transform: translateY(-1px);
}
.input-animated:not(:placeholder-shown):not(:focus) {
    border-color: #D1D5DB;
}

/* Floating label */
.floating-input-group {
    position: relative;
}
.floating-input-group input:focus + label,
.floating-input-group input:not(:placeholder-shown) + label {
    transform: translateY(-28px) scale(0.85);
    color: #10B981;
}

/* Step indicator */
.step-line {
    position: relative;
}
.step-line::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 100%;
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, #10B981, #D1FAE5);
    transform: translateY(-50%);
}

/* Card glass */
.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

/* Button shine */
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

/* Particle */
.particle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

/* Password strength meter */
.strength-bar {
    height: 3px;
    border-radius: 2px;
    transition: all 0.3s ease;
}

/* Avatar upload */
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
    background: rgba(0,0,0,0.4);
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

/* Scrollbar */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #ECFDF5; }
::-webkit-scrollbar-thumb { background: #10B981; border-radius: 10px; }
</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#ECFDF5] via-[#D1FAE5] to-[#ECFDF5] relative overflow-x-hidden">

<!-- Background decorations -->
<div class="particle w-72 h-72 bg-primary/5 rounded-full -top-36 -right-36 blur-3xl fixed"></div>
<div class="particle w-96 h-96 bg-emerald-200/15 rounded-full -bottom-48 -left-48 blur-3xl fixed"></div>
<div class="particle w-4 h-4 bg-primary/20 top-1/4 left-[8%] animate-float fixed" style="animation-delay: 0s;"></div>
<div class="particle w-3 h-3 bg-emerald-400/25 top-1/3 right-[12%] animate-float fixed" style="animation-delay: 1.5s;"></div>
<div class="particle w-5 h-5 bg-teal-300/15 bottom-1/4 left-[15%] animate-float-slow fixed" style="animation-delay: 0.8s;"></div>

<div class="min-h-screen flex items-center justify-center py-12 px-4 relative z-10">
    <div class="w-full max-w-5xl grid lg:grid-cols-2 gap-8 items-center">

        <!-- Left: Branding & Info -->
        <div class="hidden lg:block space-y-8 animate-fade-in-left">
            <a href="/" class="inline-flex items-center gap-2.5 group">
                <div class="w-11 h-11 bg-gradient-to-br from-primary to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-white text-[20px]">storefront</span>
                </div>
                <span class="text-2xl font-extrabold gradient-text">TokoQ</span>
            </a>

            <div>
                <h1 class="text-4xl font-extrabold text-gray-800 leading-tight mb-4">
                    Mulai Perjalanan<br/>
                    <span class="gradient-text">Digital UMKM</span><br/>
                    Anda Hari Ini
                </h1>
                <p class="text-gray-500 text-lg leading-relaxed">
                    Bergabung dengan 10.000+ UMKM yang sudah merasakan kemudahan mengelola toko dengan teknologi AI.
                </p>
            </div>

            <!-- Feature highlights -->
            <div class="space-y-4">
                <div class="flex items-center gap-3 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary text-[20px]">check_circle</span>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Gratis 14 Hari</p>
                        <p class="text-xs text-gray-400">Tanpa perlu kartu kredit</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 animate-fade-in-up" style="animation-delay: 0.3s;">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-blue-500 text-[20px]">psychology</span>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Prediksi AI</p>
                        <p class="text-xs text-gray-400">Tahu kapan harus restok barang</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-purple-500 text-[20px]">dashboard</span>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Dashboard Lengkap</p>
                        <p class="text-xs text-gray-400">Kasir, stok, laporan dalam satu tempat</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial mini -->
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-5 border border-white/80 animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="flex items-center gap-1 mb-2">
                    <span class="material-symbols-outlined text-amber-400 text-[16px]">star</span>
                    <span class="material-symbols-outlined text-amber-400 text-[16px]">star</span>
                    <span class="material-symbols-outlined text-amber-400 text-[16px]">star</span>
                    <span class="material-symbols-outlined text-amber-400 text-[16px]">star</span>
                    <span class="material-symbols-outlined text-amber-400 text-[16px]">star</span>
                </div>
                <p class="text-sm text-gray-600 italic leading-relaxed">"Sejak pakai TokoQ, stok barang saya selalu terkontrol. Tidak ada lagi pelanggan kecewa."</p>
                <div class="flex items-center gap-2 mt-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-xs">S</div>
                    <div>
                        <p class="font-bold text-xs text-gray-800">Sari Dewi</p>
                        <p class="text-[10px] text-gray-400">Pemilik Toko Kelontong</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Registration Form -->
        <div class="animate-fade-in-right">
            <div class="glass-card rounded-3xl shadow-2xl shadow-primary/10 p-8 border border-white/80">
                <!-- Mobile logo -->
                <div class="lg:hidden text-center mb-6">
                    <a href="/" class="inline-flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-white text-[18px]">storefront</span>
                        </div>
                        <span class="text-xl font-extrabold gradient-text">TokoQ</span>
                    </a>
                </div>

                <div class="mb-6">
                    <h2 class="text-2xl font-extrabold text-gray-800">Daftar Akun Baru</h2>
                    <p class="text-sm text-gray-400 mt-1">Isi data berikut untuk memulai</p>
                </div>

                <!-- Step indicators -->
                <div class="flex items-center gap-2 mb-8">
                    <div class="flex items-center gap-2 flex-1">
                        <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-xs font-bold shadow-lg shadow-primary/30 shrink-0">1</div>
                        <span class="text-xs font-bold text-primary hidden sm:inline">Pemilik</span>
                    </div>
                    <div class="flex-1 h-0.5 bg-gradient-to-r from-primary to-emerald-200 rounded-full"></div>
                    <div class="flex items-center gap-2 flex-1">
                        <div class="w-8 h-8 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center text-xs font-bold shrink-0" id="step-2-circle">2</div>
                        <span class="text-xs font-medium text-gray-400 hidden sm:inline" id="step-2-label">Toko</span>
                    </div>
                    <div class="flex-1 h-0.5 bg-gray-200 rounded-full" id="step-line"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center text-xs font-bold shrink-0" id="step-3-circle">3</div>
                        <span class="text-xs font-medium text-gray-400 hidden sm:inline" id="step-3-label">Selesai</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                    @csrf

                    <!-- Step 1: Data Pemilik -->
                    <div id="step-1-panel" class="space-y-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-primary text-[18px]">person</span>
                            <h3 class="font-bold text-gray-800">Data Pemilik</h3>
                        </div>

                        <!-- Avatar Upload -->
                        <div class="flex justify-center mb-4">
                            <div class="avatar-upload" onclick="document.getElementById('profile_photo').click()">
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary/10 to-emerald-100 flex items-center justify-center border-2 border-dashed border-primary/30 overflow-hidden" id="avatar-preview">
                                    <span class="material-symbols-outlined text-primary/40 text-[32px]">person</span>
                                </div>
                                <div class="avatar-overlay rounded-full">
                                    <span class="material-symbols-outlined text-white text-[20px]">camera_alt</span>
                                </div>
                            </div>
                            <input type="file" name="profile_photo" id="profile_photo" accept=".jpg,.jpeg,.png,.webp" class="hidden" onchange="previewAvatar(this)"/>
                        </div>

                        <div>
                            <input name="name" type="text" value="{{ old('name') }}" required
                                class="input-animated w-full px-4 py-3.5 rounded-xl bg-gray-50 focus:bg-white outline-none text-sm"
                                placeholder="Nama lengkap"/>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input name="email" type="email" value="{{ old('email') }}" required
                                class="input-animated w-full px-4 py-3.5 rounded-xl bg-gray-50 focus:bg-white outline-none text-sm"
                                placeholder="Email"/>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative">
                            <input name="password" type="password" required id="reg-password"
                                class="input-animated w-full px-4 py-3.5 pr-12 rounded-xl bg-gray-50 focus:bg-white outline-none text-sm"
                                placeholder="Password (min. 8 karakter)" oninput="checkPasswordStrength(this.value)"/>
                            <button type="button" onclick="togglePassword('reg-password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                            <!-- Strength meter -->
                            <div class="flex gap-1 mt-2">
                                <div class="strength-bar flex-1 bg-gray-200" id="strength-1"></div>
                                <div class="strength-bar flex-1 bg-gray-200" id="strength-2"></div>
                                <div class="strength-bar flex-1 bg-gray-200" id="strength-3"></div>
                                <div class="strength-bar flex-1 bg-gray-200" id="strength-4"></div>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1" id="strength-text">Kekuatan password</p>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative">
                            <input name="password_confirmation" type="password" required id="reg-password-confirm"
                                class="input-animated w-full px-4 py-3.5 pr-12 rounded-xl bg-gray-50 focus:bg-white outline-none text-sm"
                                placeholder="Konfirmasi password"/>
                            <button type="button" onclick="togglePassword('reg-password-confirm')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>

                        <button type="button" onclick="goToStep(2)"
                            class="btn-shine w-full py-4 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all text-sm">
                            Lanjut ke Data Toko
                            <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
                        </button>
                    </div>

                    <!-- Step 2: Data Toko -->
                    <div id="step-2-panel" class="space-y-4 hidden">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-primary text-[18px]">store</span>
                            <h3 class="font-bold text-gray-800">Data Toko</h3>
                        </div>

                        <div>
                            <input name="shop_name" type="text" value="{{ old('shop_name') }}" required
                                class="input-animated w-full px-4 py-3.5 rounded-xl bg-gray-50 focus:bg-white outline-none text-sm"
                                placeholder="Nama toko (contoh: Warung Maju Jaya)"/>
                            @error('shop_name')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <textarea name="shop_address" rows="3" required
                                class="input-animated w-full px-4 py-3.5 rounded-xl bg-gray-50 focus:bg-white outline-none text-sm resize-none"
                                placeholder="Alamat lengkap toko">{{ old('shop_address') }}</textarea>
                            @error('shop_address')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="button" onclick="goToStep(1)"
                                class="px-6 py-4 border-2 border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition-all text-sm">
                                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                            </button>
                            <button type="submit"
                                class="btn-shine flex-1 py-4 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all text-sm">
                                Daftar Sekarang
                                <span class="material-symbols-outlined text-[16px] ml-1">rocket_launch</span>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="text-center mt-6 pt-6 border-t border-gray-100">
                    <p class="text-sm text-gray-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Login di sini</a>
                    </p>
                </div>

                <!-- Info -->
                <div class="mt-4 p-3 bg-blue-50 rounded-xl">
                    <p class="text-xs text-blue-600 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px]">info</span>
                        Akun akan divalidasi admin dalam 1x24 jam
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Step navigation
function goToStep(step) {
    const step1Panel = document.getElementById('step-1-panel');
    const step2Panel = document.getElementById('step-2-panel');
    const step2Circle = document.getElementById('step-2-circle');
    const step3Circle = document.getElementById('step-3-circle');
    const step2Label = document.getElementById('step-2-label');
    const step3Label = document.getElementById('step-3-label');
    const stepLine = document.getElementById('step-line');

    if (step === 2) {
        step1Panel.classList.add('hidden');
        step2Panel.classList.remove('hidden');
        step2Circle.classList.remove('bg-gray-100', 'text-gray-400');
        step2Circle.classList.add('bg-primary', 'text-white', 'shadow-lg', 'shadow-primary/30');
        step2Label.classList.remove('text-gray-400');
        step2Label.classList.add('text-primary', 'font-bold');
        stepLine.classList.remove('bg-gray-200');
        stepLine.classList.add('bg-gradient-to-r', 'from-primary', 'to-emerald-200');
    } else if (step === 1) {
        step2Panel.classList.add('hidden');
        step1Panel.classList.remove('hidden');
        step2Circle.classList.add('bg-gray-100', 'text-gray-400');
        step2Circle.classList.remove('bg-primary', 'text-white', 'shadow-lg', 'shadow-primary/30');
        step2Label.classList.add('text-gray-400');
        step2Label.classList.remove('text-primary', 'font-bold');
        stepLine.classList.add('bg-gray-200');
        stepLine.classList.remove('bg-gradient-to-r', 'from-primary', 'to-emerald-200');
    }
}

// Toggle password visibility
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}

// Password strength checker
function checkPasswordStrength(value) {
    let strength = 0;
    if (value.length >= 8) strength++;
    if (/[a-z]/.test(value) && /[A-Z]/.test(value)) strength++;
    if (/[0-9]/.test(value)) strength++;
    if (/[^a-zA-Z0-9]/.test(value)) strength++;

    const colors = ['bg-gray-200', 'bg-red-400', 'bg-amber-400', 'bg-blue-400', 'bg-emerald-500'];
    const texts = ['', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];

    for (let i = 1; i <= 4; i++) {
        const bar = document.getElementById('strength-' + i);
        if (i <= strength) {
            bar.className = 'strength-bar flex-1 ' + colors[strength];
        } else {
            bar.className = 'strength-bar flex-1 bg-gray-200';
        }
    }
    document.getElementById('strength-text').textContent = strength > 0 ? texts[strength] : 'Kekuatan password';
}

// Avatar preview
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-full">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
