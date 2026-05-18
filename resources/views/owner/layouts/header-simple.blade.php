@php
    $user = Auth::user();
    $shop = $user->shop;
    $pageTitle = $pageTitle ?? 'Dashboard';
@endphp

<header class="app-header h-20 w-full sticky top-0 z-40 bg-white flex justify-between items-center px-4 lg:px-container-padding border-b border-outline-variant">
    <div class="app-header-left flex items-center gap-6">
        <h2 class="font-h3 text-h3 font-bold text-primary">{{ $pageTitle }}</h2>
    </div>

    <div class="app-header-right flex items-center gap-6">
        <a href="{{ route('pos.index') }}" class="app-header-cta flex items-center gap-2 bg-primary text-white px-6 py-2.5 rounded-full font-bold hover:bg-primary-dark active:opacity-80 transition-all">
            <span class="material-symbols-outlined text-[20px]">point_of_sale</span>
            <span class="hidden sm:inline">Buka Kasir</span>
        </a>

        <div class="flex items-center gap-3 pl-4 border-l border-outline-variant">
            <div class="app-user-copy text-right hidden lg:block">
                <p class="font-bold text-text leading-none">{{ $user->name }}</p>
                <p class="text-body-sm text-text-light">{{ $user->shop?->name ?? 'Toko Anda' }}</p>
            </div>
            @if ($shop?->logo_url)
                <img data-shop-logo-preview src="{{ $shop->logo_url }}?v={{ $shop->updated_at?->timestamp ?? time() }}" alt="{{ $shop->name }}" class="w-10 h-10 rounded-xl object-cover border-2 border-primary/20 shadow-sm"/>
            @else
                <div data-shop-logo-fallback data-shop-logo-alt="{{ $shop?->name ?? 'Logo Toko' }}" data-shop-logo-class="w-10 h-10 rounded-xl object-cover border-2 border-primary/20 shadow-sm" class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center border border-primary/20">
                    <span class="material-symbols-outlined text-[22px]">storefront</span>
                </div>
            @endif
        </div>
    </div>
</header>
