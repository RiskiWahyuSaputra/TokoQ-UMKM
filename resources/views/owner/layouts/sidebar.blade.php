@php
    $user = auth()->user();
    $shop = $user?->shop;
    
    // Determine active menu from current route name
    $routeName = Route::currentRouteName();
    $activeMenu = match(true) {
        str_starts_with($routeName, 'pos') => 'pos',
        str_starts_with($routeName, 'sales') => 'sales',
        str_starts_with($routeName, 'products'), str_starts_with($routeName, 'categories') => 'inventory',
        str_starts_with($routeName, 'ai') => 'ai',
        str_starts_with($routeName, 'reports') => 'reports',
        str_starts_with($routeName, 'settings') => 'settings',
        default => 'dashboard',
    };
    
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
<aside id="sidebar" class="app-sidebar bg-white h-screen w-64 fixed left-0 top-0 shadow-lg flex flex-col  px-4 z-50 border-r border-outline transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="mb-10 px-4 pt-6">
        @if ($shop && $shop->logo_url)
            <img src="{{ $shop->logo_url }}?v={{ $shop->updated_at?->timestamp ?? time() }}" alt="{{ $shop->name }}" class="w-full max-w-[180px] h-auto max-h-[80px] object-contain mb-2">
        @else
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">store</span>
                </div>
                <span class="font-bold text-primary text-lg">{{ $shop?->name ?? 'TokoQ' }}</span>
            </div>
        @endif
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
        <a href="{{ route('upgrade') }}" class="w-full bg-action text-white py-3 rounded-xl font-bold mb-4 hover:bg-action-dark active:scale-95 transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[18px]">workspace_premium</span>
            Upgrade Plan
        </a>
        <a href="{{ route('help') }}" class="flex w-full items-center gap-3 px-4 py-2 text-left text-text hover:text-primary hover:bg-secondary rounded-lg transition-colors">
            <span class="material-symbols-outlined">help</span>
            <span class="font-body-md">Bantuan</span>
        </a>
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
