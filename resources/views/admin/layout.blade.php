<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - TokoQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fbea]">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#576b33] text-white flex flex-col">
            <div class="p-6 border-b border-[#40521d]">
                <h1 class="text-2xl font-bold">TokoQ Admin</h1>
            </div>
            <nav class="flex-1 p-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg mb-2 {{ request()->routeIs('admin.dashboard') ? 'bg-[#40521d]' : 'hover:bg-[#40521d]' }} transition-colors">
                    Dashboard
                </a>
                <a href="{{ route('admin.validate') }}" class="block px-4 py-3 rounded-lg mb-2 {{ request()->routeIs('admin.validate') ? 'bg-[#40521d]' : 'hover:bg-[#40521d]' }} transition-colors">
                    Validasi UMKM
                </a>
            </nav>
            <div class="p-4 border-t border-[#40521d]">
                <div class="mb-3 px-4 py-2 text-sm">
                    <div class="font-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-gray-300">{{ auth()->user()->email }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 bg-red-600 hover:bg-red-700 rounded-lg transition-colors font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
