<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Menunggu Validasi - TokoQ</title>
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
@keyframes fadeInScale {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-12px); }
}
@keyframes pulse-ring {
    0% { transform: scale(0.8); opacity: 1; }
    80%, 100% { transform: scale(1.4); opacity: 0; }
}
@keyframes progress-stripe {
    0% { background-position: 0 0; }
    100% { background-position: 40px 0; }
}
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes checkmark-pop {
    0% { transform: scale(0); opacity: 0; }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); opacity: 1; }
}
@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

.animate-fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }
.animate-fade-in-scale { animation: fadeInScale 0.6s ease-out forwards; }
.animate-float { animation: float 5s ease-in-out infinite; }
.animate-gradient { 
    background-size: 200% 200%;
    animation: gradient-shift 4s ease infinite; 
}
.animate-checkmark { animation: checkmark-pop 0.5s ease-out forwards; }

/* Glass card */
.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

/* Progress bar animated */
.progress-animated {
    background-image: linear-gradient(
        45deg,
        rgba(255,255,255,0.15) 25%,
        transparent 25%,
        transparent 50%,
        rgba(255,255,255,0.15) 50%,
        rgba(255,255,255,0.15) 75%,
        transparent 75%,
        transparent
    );
    background-size: 40px 40px;
    animation: progress-stripe 1s linear infinite;
}

/* Particle */
.particle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

/* Step connector */
.step-connector {
    position: relative;
}
.step-connector::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 100%;
    width: 40px;
    height: 2px;
    background: linear-gradient(90deg, #10B981, #D1FAE5);
    transform: translateY(-50%);
}

/* Gradient text */
.gradient-text {
    background: linear-gradient(135deg, #10B981 0%, #059669 50%, #047857 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Scrollbar */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #ECFDF5; }
::-webkit-scrollbar-thumb { background: #10B981; border-radius: 10px; }
</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#ECFDF5] via-[#D1FAE5] to-[#ECFDF5] relative overflow-x-hidden">

<!-- Background decorations -->
<div class="particle w-80 h-80 bg-primary/5 rounded-full -top-40 -right-40 blur-3xl fixed"></div>
<div class="particle w-96 h-96 bg-emerald-200/15 rounded-full -bottom-48 -left-48 blur-3xl fixed"></div>
<div class="particle w-4 h-4 bg-primary/20 top-[10%] left-[5%] animate-float fixed" style="animation-delay: 0s;"></div>
<div class="particle w-3 h-3 bg-emerald-400/25 top-[20%] right-[8%] animate-float fixed" style="animation-delay: 1.5s;"></div>
<div class="particle w-5 h-5 bg-teal-300/15 bottom-[15%] left-[12%] animate-float fixed" style="animation-delay: 0.8s;"></div>

<div class="min-h-screen flex items-center justify-center py-12 px-4 relative z-10">
    <div class="w-full max-w-lg">

        <!-- Main Card -->
        <div class="glass-card rounded-3xl shadow-2xl shadow-primary/10 border border-white/80 overflow-hidden animate-fade-in-up">

            <!-- Top: Animated Icon -->
            <div class="pt-10 pb-6 text-center relative">
                <!-- Pulse rings -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-28 h-28">
                    <div class="absolute inset-0 rounded-full border-2 border-primary/10" style="animation: pulse-ring 2s ease-out infinite;"></div>
                    <div class="absolute inset-0 rounded-full border-2 border-primary/10" style="animation: pulse-ring 2s ease-out infinite 0.5s;"></div>
                </div>

                <!-- Icon -->
                <div class="relative inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-primary/10 to-emerald-100 rounded-3xl animate-float">
                    <span class="material-symbols-outlined text-4xl text-primary">hourglass_top</span>
                </div>
            </div>

            <!-- Content -->
            <div class="px-8 pb-8 text-center">
                <h1 class="text-2xl font-extrabold text-gray-800 mb-2">Akun Sedang Ditinjau</h1>
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    Terima kasih telah mendaftar di TokoQ! Admin kami sedang memverifikasi data toko Anda. Proses ini biasanya memakan waktu <strong class="text-gray-700">1x24 jam</strong>.
                </p>

                <!-- Progress Steps -->
                <div class="bg-gray-50 rounded-2xl p-5 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Status Pendaftaran</span>
                        <span class="text-xs font-bold text-primary">60%</span>
                    </div>

                    <!-- Progress bar -->
                    <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden mb-6">
                        <div class="h-full bg-gradient-to-r from-primary to-emerald-400 rounded-full progress-animated" style="width: 60%;"></div>
                    </div>

                    <!-- Steps -->
                    <div class="space-y-3">
                        <!-- Step 1: Done -->
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center shrink-0 shadow-lg shadow-primary/30">
                                <span class="material-symbols-outlined text-white text-[16px]">check</span>
                            </div>
                            <div class="flex-1 text-left">
                                <p class="text-sm font-bold text-gray-800">Pendaftaran Berhasil</p>
                                <p class="text-[10px] text-gray-400">Akun Anda telah dibuat</p>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">Selesai</span>
                        </div>

                        <!-- Step 2: In Progress -->
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary to-emerald-400 rounded-full flex items-center justify-center shrink-0 shadow-lg shadow-primary/30 relative">
                                <span class="material-symbols-outlined text-white text-[16px]">search</span>
                                <div class="absolute inset-0 rounded-full border-2 border-primary/30" style="animation: pulse-ring 1.5s ease-out infinite;"></div>
                            </div>
                            <div class="flex-1 text-left">
                                <p class="text-sm font-bold text-gray-800">Verifikasi Admin</p>
                                <p class="text-[10px] text-gray-400">Sedang meninjau data toko Anda</p>
                            </div>
                            <span class="text-[10px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded-full">Proses</span>
                        </div>

                        <!-- Step 3: Pending -->
                        <div class="flex items-center gap-3 opacity-50">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-gray-400 text-[16px]">dashboard</span>
                            </div>
                            <div class="flex-1 text-left">
                                <p class="text-sm font-medium text-gray-500">Akses Dashboard</p>
                                <p class="text-[10px] text-gray-400">Tersedia setelah verifikasi</p>
                            </div>
                            <span class="text-[10px] font-medium text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">Menunggu</span>
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 rounded-2xl p-4 mb-6 text-left">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-blue-500 text-[18px]">info</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-blue-700 mb-1">Apa yang terjadi selanjutnya?</p>
                            <ul class="text-xs text-blue-600 space-y-1">
                                <li>• Admin akan memverifikasi data toko Anda</li>
                                <li>• Anda akan menerima notifikasi via email</li>
                                <li>• Setelah diverifikasi, Anda bisa login dan mulai berjualan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="bg-amber-50 rounded-2xl p-4 mb-6 text-left">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-amber-500 text-[18px]">support_agent</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-amber-700 mb-1">Butuh bantuan?</p>
                            <p class="text-xs text-amber-600">Jika verifikasi memakan waktu lebih dari 24 jam, hubungi kami di <strong>support@tokooq.id</strong></p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <form method="POST" action="/logout" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full py-3.5 border-2 border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all text-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">logout</span>
                            Keluar
                        </button>
                    </form>
                    <a href="/" class="flex-1 py-3.5 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all text-sm flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">home</span>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom: Branding -->
        <div class="text-center mt-6 animate-fade-in-up" style="animation-delay: 0.3s;">
            <a href="/" class="inline-flex items-center gap-2 group">
                <div class="w-8 h-8 bg-gradient-to-br from-primary to-emerald-600 rounded-lg flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-white text-[14px]">storefront</span>
                </div>
                <span class="text-sm font-bold gradient-text">TokoQ</span>
            </a>
            <p class="text-xs text-gray-400 mt-2">Mendigitalisasi UMKM Indonesia</p>
        </div>
    </div>
</div>

<script>
// Auto-refresh page every 60 seconds to check validation status
setTimeout(() => {
    window.location.reload();
}, 60000);

// Countdown timer for next check
let seconds = 60;
const countdownEl = document.createElement('div');
countdownEl.className = 'text-center mt-4';
countdownEl.innerHTML = `<p class="text-xs text-gray-400">Halaman akan diperbarui otomatis dalam <span id="countdown" class="font-bold text-primary">60</span> detik</span></p>`;
document.querySelector('.glass-card').parentElement.appendChild(countdownEl);

setInterval(() => {
    seconds--;
    const el = document.getElementById('countdown');
    if (el) el.textContent = seconds;
    if (seconds <= 0) seconds = 60;
}, 1000);
</script>
</body>
</html>
