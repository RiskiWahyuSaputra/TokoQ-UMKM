@php
    // Detect active menu and page title from current route
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
    $pageTitle = match(true) {
        str_starts_with($routeName, 'pos') => 'Kasir POS',
        str_starts_with($routeName, 'sales') => 'Penjualan',
        $routeName === 'products.create' => 'Tambah Produk',
        $routeName === 'products.edit' => 'Edit Produk',
        str_starts_with($routeName, 'products'), str_starts_with($routeName, 'categories') => 'Inventori',
        str_starts_with($routeName, 'ai') => 'Prediksi AI',
        str_starts_with($routeName, 'reports') => 'Laporan',
        str_starts_with($routeName, 'settings') => 'Pengaturan',
        default => 'Dashboard',
    };
@endphp

<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'TokoQ - UMKM Management')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- TokoQ Color Palette -->
    <link href="{{ asset('css/tokoq-colors.css') }}" rel="stylesheet"/>

    <!-- Tailwind Config -->
    <script src="{{ asset('js/tailwind-config.js') }}"></script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: #ECFDF5;
            color: #374151;
        }
        .active-nav-border {
            box-shadow: inset 4px 0 0 0 #10B981;
        }
    </style>

    @yield('styles')
</head>
<body class="app-shell bg-secondary text-text font-body-md overflow-x-hidden">
    <!-- Sidebar -->
    @include('owner.layouts.sidebar')

    <!-- Main Content Area -->
    <main class="app-main lg:ml-64 min-h-screen">
        <!-- Top Navbar -->
        @include('owner.layouts.header')

        <!-- Page Content -->
        @yield('content')
    </main>

    @yield('scripts')
    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>
</body>
</html>
