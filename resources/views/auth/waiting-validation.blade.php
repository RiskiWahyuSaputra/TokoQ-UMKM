<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menunggu Validasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fbea] flex items-center justify-center min-h-screen">
    <div class="bg-white p-12 rounded-3xl shadow-xl text-center max-w-md">
        <h1 class="text-3xl font-bold text-[#40521d] mb-4">Akun Menunggu Validasi</h1>
        <p class="text-gray-600 mb-8">Terima kasih telah mendaftar! Admin kami sedang meninjau toko Anda. Anda akan dapat mengakses dashboard setelah akun Anda diaktifkan.</p>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="text-[#40521d] font-bold hover:underline">Keluar</button>
        </form>
    </div>
</body>
</html>
