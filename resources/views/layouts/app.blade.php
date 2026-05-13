<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
        
        @yield('styles')
    </style>
    
    @stack('head-scripts')
</head>
<body class="bg-secondary text-text">
    @yield('content')
    
    @stack('scripts')
</body>
</html>
