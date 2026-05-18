<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>@yield('title', 'Admin') - TokoQ</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<script src="/js/tailwind-config.js"></script>
<style>
.material-symbols-outlined {
    font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
}

/* Sidebar scrollbar */
.sidebar-scroll::-webkit-scrollbar { width: 4px; }
.sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
.sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }

/* Card hover */
.card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.card-hover:hover { transform: translateY(-4px); box-shadow: 0 15px 30px -8px rgba(16, 185, 129, 0.15); }

/* Pulse dot */
@keyframes pulse-dot {
    0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
    50% { box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
}
.pulse-dot { animation: pulse-dot 2s infinite; }

/* Fade in */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }

/* Scrollbar */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #f1f5f9; }
::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
</head>
<body class="bg-gray-50 min-h-screen">

<div class="flex h-screen overflow-hidden relative">

    <!-- ===== MOBILE OVERLAY ===== -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity duration-300 opacity-0" onclick="closeSidebar()"></div>

    <!-- ===== SIDEBAR ===== -->
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white flex flex-col shrink-0 transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0">
        <!-- Logo -->
        <div class="p-5 border-b border-white/10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-emerald-400 rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
                        <span class="material-symbols-outlined text-white text-[24px]">admin_panel_settings</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold text-white">TokoQ</h1>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider">Admin Panel</p>
                    </div>
                </div>
                <!-- Close button (mobile only) -->
                <button onclick="closeSidebar()" class="lg:hidden w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-white/10 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-3 space-y-1 overflow-y-auto sidebar-scroll">
            <p class="px-3 pt-2 pb-1 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                Dashboard
            </a>

            <a href="{{ route('admin.validate') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.validate') ? 'bg-primary/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                Validasi UMKM
                @if(isset($pendingCount) && $pendingCount > 0)
                    <span class="ml-auto w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center pulse-dot">{{ $pendingCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.shops') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.shops') ? 'bg-primary/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">store</span>
                Semua Toko
            </a>

            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.users') ? 'bg-primary/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">group</span>
                Pengguna
            </a>

            <p class="px-3 pt-4 pb-1 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Analitik</p>

            <a href="{{ route('admin.transactions') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.transactions') ? 'bg-primary/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                Transaksi
            </a>

            <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.reports') ? 'bg-primary/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">bar_chart</span>
                Laporan
            </a>

            <p class="px-3 pt-4 pb-1 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Sistem</p>

            <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.settings') ? 'bg-primary/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">settings</span>
                Pengaturan
            </a>

            <a href="{{ route('admin.logs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.logs') ? 'bg-primary/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">history</span>
                Log Aktivitas
            </a>
        </nav>

        <!-- User Profile -->
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 bg-gradient-to-br from-primary to-emerald-400 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gray-400 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-white/5 hover:bg-red-500/20 text-gray-400 hover:text-red-400 rounded-xl transition-all text-xs font-medium">
                    <span class="material-symbols-outlined text-[16px]">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-1 overflow-y-auto w-full min-w-0">
        <!-- Top Bar -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-xl border-b border-gray-100 px-4 sm:px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button id="sidebar-toggle" class="lg:hidden w-9 h-9 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors" onclick="openSidebar()">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <div>
                        <h2 class="text-sm font-bold text-gray-800">@yield('title', 'Dashboard')</h2>
                        <p class="text-[10px] text-gray-400 hidden sm:block">{{ now()->locale('id')->format('l, j F Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="/" target="_blank" class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-primary transition-all" title="Lihat Website">
                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                    </a>
                    <div class="w-9 h-9 bg-gradient-to-br from-primary to-emerald-400 rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-4 sm:p-6 animate-fade-in">
            @yield('content')
        </div>
    </main>
</div>

<script>
// Sidebar toggle for mobile
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');

function openSidebar() {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    // Small delay to allow display:block to apply before opacity transition
    setTimeout(() => {
        overlay.classList.remove('opacity-0');
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeSidebar() {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('opacity-0');
    setTimeout(() => {
        overlay.classList.add('hidden');
    }, 300);
    document.body.style.overflow = '';
}

// Close sidebar when clicking a nav link on mobile
sidebar.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            closeSidebar();
        }
    });
});

// Handle resize: reset sidebar state when going to desktop
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        overlay.classList.add('hidden', 'opacity-0');
        document.body.style.overflow = '';
    }
});
</script>
</body>
</html>
