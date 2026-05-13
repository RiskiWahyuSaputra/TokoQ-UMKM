<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Validasi UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fbea] p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-[#40521d] mb-8">Validasi Pendaftaran UMKM</h1>

        <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-[#dde3d2]">
            <table class="w-full text-left">
                <thead class="bg-[#f2f5e4] text-[#45483d] font-bold uppercase text-sm">
                    <tr>
                        <th class="px-8 py-4">Nama Owner</th>
                        <th class="px-8 py-4">Email</th>
                        <th class="px-8 py-4">Nama Toko</th>
                        <th class="px-8 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#dde3d2]">
                    @forelse($pendingUsers as $user)
                    <tr>
                        <td class="px-8 py-4">{{ $user->name }}</td>
                        <td class="px-8 py-4">{{ $user->email }}</td>
                        <td class="px-8 py-4">{{ $user->shop->name ?? '-' }}</td>
                        <td class="px-8 py-4">
                            <form method="POST" action="/admin/validate/{{ $user->id }}">
                                @csrf
                                <button type="submit" class="bg-[#576b33] text-white px-4 py-2 rounded-xl font-bold hover:bg-[#40521d] transition-colors">Aktifkan</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-8 text-center text-gray-500 italic">Tidak ada pendaftaran tertunda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
