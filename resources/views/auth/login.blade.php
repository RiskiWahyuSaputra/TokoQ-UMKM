<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - TokoQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fbea] flex items-center justify-center min-h-screen">
    <div class="bg-white p-12 rounded-3xl shadow-xl w-full max-w-md border border-[#dde3d2]">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#40521d]">Masuk ke TokoQ</h1>
            <p class="text-gray-500">Kelola toko Anda dengan mudah</p>
        </div>

        @if($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="/login" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-[#45483d] mb-2">Email</label>
                <input name="email" type="email" required class="w-full px-4 py-3 rounded-xl border border-[#dde3d2] focus:ring-2 focus:ring-[#40521d] outline-none">
            </div>
            <div>
                <label class="block text-sm font-bold text-[#45483d] mb-2">Password</label>
                <input name="password" type="password" required class="w-full px-4 py-3 rounded-xl border border-[#dde3d2] focus:ring-2 focus:ring-[#40521d] outline-none">
            </div>
            <button type="submit" class="w-full bg-[#576b33] text-white py-3 rounded-xl font-bold hover:bg-[#40521d] transition-colors shadow-lg shadow-[#49592A]/20">Masuk</button>
        </form>

        <p class="mt-8 text-center text-sm text-gray-500">
            Belum punya akun? <a href="/register" class="text-[#40521d] font-bold hover:underline">Daftar Sekarang</a>
        </p>
    </div>
</body>
</html>
