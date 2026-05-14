@php
    $user = Auth::user();
    $initials = collect(explode(' ', trim($user->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
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
            @if ($user->profile_photo_url)
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-primary shadow-sm"/>
            @else
                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm">{{ $initials }}</div>
            @endif
        </div>
    </div>
</header>