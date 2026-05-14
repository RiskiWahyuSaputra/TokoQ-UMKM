@php
    $activeMenu = $activeMenu ?? '';
    $user = auth()->user();
    $shop = $user?->shop;
    $menuItems = [
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'route' => route('dashboard')],
        ['key' => 'pos', 'label' => 'Kasir POS', 'icon' => 'point_of_sale', 'route' => route('pos.index')],
        ['key' => 'sales', 'label' => 'Penjualan', 'icon' => 'analytics', 'route' => route('sales.index')],
        ['key' => 'inventory', 'label' => 'Inventori', 'icon' => 'inventory_2', 'route' => route('products.index')],
        ['key' => 'ai', 'label' => 'Prediksi AI', 'icon' => 'psychology', 'route' => route('ai.index')],
        ['key' => 'reports', 'label' => 'Laporan', 'icon' => 'description', 'route' => route('reports.index')],
        ['key' => 'settings', 'label' => 'Pengaturan', 'icon' => 'settings', 'route' => route('settings.index')],
    ];
@endphp

<!-- Sidebar -->
<aside id="sidebar" class="app-sidebar bg-white h-screen w-64 fixed left-0 top-0 shadow-lg flex flex-col py-8 px-4 z-50 border-r border-outline transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="mb-10 px-4">
        <h1 class="font-h2 text-h2 font-bold text-primary">TokoQ</h1>
        <p class="text-body-sm text-text-light">{{ $shop?->name ?? 'Manajemen UMKM' }}</p>
    </div>

    <nav class="flex-1 space-y-2 overflow-y-auto">
        @foreach ($menuItems as $item)
            @php $isActive = $activeMenu === $item['key']; @endphp
            <a
                class="{{ $isActive ? 'bg-primary text-white rounded-xl' : 'text-text hover:text-primary hover:bg-secondary' }} flex items-center gap-3 px-4 py-3 transition-colors duration-200 active:scale-95 transition-transform"
                href="{{ $item['route'] }}"
            >
                <span class="material-symbols-outlined" @if ($isActive) style="font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24;" @endif>{{ $item['icon'] }}</span>
                <span class="font-body-md font-medium">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="mt-auto space-y-2 border-t border-outline pt-6">
        <button class="w-full bg-action text-white py-3 rounded-xl font-bold mb-4 hover:bg-action-dark active:scale-95 transition-all" type="button">
            Upgrade Plan
        </button>
        <button class="flex w-full items-center gap-3 px-4 py-2 text-left text-text hover:text-primary hover:bg-secondary rounded-lg transition-colors" type="button">
            <span class="material-symbols-outlined">help</span>
            <span class="font-body-md">Bantuan</span>
        </button>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-2 text-error hover:bg-red-50 w-full text-left rounded-lg transition-colors">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-body-md">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<!-- Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const hamburgerBtns = document.querySelectorAll('[data-hamburger-toggle]');

    function toggleSidebar() {
        const isOpen = !sidebar.classList.contains('-translate-x-full');
        
        if (isOpen) {
            // Close sidebar
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
            
            // Change all hamburger icons back to menu
            hamburgerBtns.forEach(btn => {
                const icon = btn.querySelector('.material-symbols-outlined');
                if (icon) icon.textContent = 'menu';
            });
        } else {
            // Open sidebar
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Change all hamburger icons to close
            hamburgerBtns.forEach(btn => {
                const icon = btn.querySelector('.material-symbols-outlined');
                if (icon) icon.textContent = 'close';
            });
        }
    }

    hamburgerBtns.forEach(btn => {
        btn.addEventListener('click', toggleSidebar);
    });

    overlay?.addEventListener('click', toggleSidebar);

    // Close sidebar when clicking a link on mobile
    const sidebarLinks = sidebar.querySelectorAll('a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                toggleSidebar();
            }
        });
    });
});
</script>
