<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar UMKM - TokoQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fbea] min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-[#40521d] mb-2">Daftar TokoQ</h1>
            <p class="text-gray-600">Mulai kelola toko UMKM Anda dengan mudah</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-[#dde3d2]">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Data Pemilik -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-[#40521d] mb-4">Data Pemilik</h2>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input name="name" type="text" value="{{ old('name') }}" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#576b33]"
                            placeholder="Masukkan nama lengkap">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#576b33]"
                            placeholder="email@example.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input name="password" type="password" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#576b33]"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                        <input name="password_confirmation" type="password" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#576b33]"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <!-- Data Toko -->
                <div class="mb-6 pt-6 border-t border-gray-200">
                    <h2 class="text-xl font-bold text-[#40521d] mb-4">Data Toko</h2>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Toko</label>
                        <input name="shop_name" type="text" value="{{ old('shop_name') }}" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#576b33]"
                            placeholder="Contoh: Warung Maju Jaya">
                        @error('shop_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full bg-[#576b33] text-white py-4 rounded-xl font-bold text-lg hover:bg-[#40521d] transition-colors">
                    Daftar Sekarang
                </button>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-[#576b33] font-bold hover:underline">Login di sini</a>
                </p>
            </div>
        </div>

        <!-- Info -->
        <div class="mt-6 text-center text-sm text-gray-600">
            <p>Setelah mendaftar, akun Anda akan divalidasi oleh admin dalam 1x24 jam</p>
        </div>
    </div>
</body>
</html>
