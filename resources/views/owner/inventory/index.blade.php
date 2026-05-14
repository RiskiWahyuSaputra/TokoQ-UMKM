<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Inventori - TokoQ</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="/template/tokoq_design_system/responsive.css" rel="stylesheet"/>
<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<script src="/js/tailwind-config.js"></script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="app-shell bg-background text-on-surface font-body-md">
@include('owner.layouts.sidebar', ['activeMenu' => 'inventory'])

@include('owner.layouts.header-simple', ['pageTitle' => 'Inventori'])

@php
    $user = Auth::user();
    $initials = collect(explode(' ', trim($user->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
    $restockItems = $products->where('stock', '<=', 10)->sortBy('stock')->take(5);
@endphp

<main class="app-main lg:ml-64 min-h-screen pt-8">
    <section class="app-page p-container-padding space-y-card-gap">
        @if (session('success'))
            <div class="rounded-2xl border border-primary/20 bg-primary/10 px-5 py-4 text-primary font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-card-gap">
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <p class="font-label-caps text-secondary uppercase tracking-widest">Total Produk</p>
                <h3 class="font-h2 text-h2 text-primary mt-2">{{ $stockSummary['total'] }}</h3>
                <p class="text-body-sm text-on-surface-variant mt-2">Seluruh item yang sudah tercatat.</p>
            </div>
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <p class="font-label-caps text-secondary uppercase tracking-widest">Stok Kritis</p>
                <h3 class="font-h2 text-h2 text-error mt-2">{{ $stockSummary['critical'] }}</h3>
                <p class="text-body-sm text-on-surface-variant mt-2">Produk dengan stok di bawah 5 unit.</p>
            </div>
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <p class="font-label-caps text-secondary uppercase tracking-widest">Stok Menipis</p>
                <h3 class="font-h2 text-h2 text-amber-600 mt-2">{{ $stockSummary['low'] }}</h3>
                <p class="text-body-sm text-on-surface-variant mt-2">Produk yang perlu dipantau segera.</p>
            </div>
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <p class="font-label-caps text-secondary uppercase tracking-widest">Nilai Inventori</p>
                <h3 class="font-h2 text-h2 text-primary mt-2">Rp {{ number_format($stockSummary['inventoryValue'], 0, ',', '.') }}</h3>
                <p class="text-body-sm text-on-surface-variant mt-2">{{ number_format($stockSummary['totalStock']) }} unit stok tersimpan.</p>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-card-gap">
            <div class="col-span-12 xl:col-span-8 bg-white rounded-2xl border border-outline-variant overflow-hidden">
                <div class="p-6 border-b border-outline-variant flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <button data-hamburger-toggle class="lg:hidden text-primary p-2" type="button">
<span class="material-symbols-outlined">menu</span>
</button>
<h2 class=" font-h3 text-h3 text-primary">Daftar Produk</h2>
                        <p class="text-body-sm text-on-surface-variant">Semua data pada tabel ini diambil langsung dari database toko Anda.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('products.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-xl font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined">add</span>
                            Tambah Produk
                        </a>
                        <span class="px-3 py-2 rounded-full bg-error-container text-on-error-container text-body-sm font-bold">Kritis: {{ $stockSummary['critical'] }}</span>
                        <span class="px-3 py-2 rounded-full bg-amber-100 text-amber-800 text-body-sm font-bold">Menipis: {{ $stockSummary['low'] }}</span>
                        <span class="px-3 py-2 rounded-full bg-primary-fixed text-primary text-body-sm font-bold">Aman: {{ $stockSummary['safe'] }}</span>
                    </div>
                </div>

                @if ($products->isEmpty())
                    <div class="px-4 lg:px-8 py-20 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[52px] mb-4 block">inventory_2</span>
                        <h3 class="font-h3 text-h3 text-primary mb-2">Belum ada produk</h3>
                        <p class="max-w-md mx-auto mb-6">Mulai isi data inventori nyata toko Anda dengan menambahkan produk pertama.</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-xl font-bold">
                            <span class="material-symbols-outlined">add</span>
                            Tambah Produk Sekarang
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-white border-b border-outline-variant">
                                <tr>
                                    <th class="px-6 py-4 font-label-caps text-secondary">Produk</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary">Kategori</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary">SKU</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary text-center">Stok</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary text-right">Harga</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary">Status</th>
                                    <th class="px-6 py-4 font-label-caps text-secondary text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @foreach ($products as $product)
                                    @php
                                        $status = $product->status;
                                        $badgeClass = match ($status) {
                                            'kritis' => 'bg-error-container text-on-error-container',
                                            'menipis' => 'bg-amber-100 text-amber-800',
                                            default => 'bg-primary-fixed text-primary',
                                        };
                                    @endphp
                                    <tr class="hover:bg-white transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @if ($product->image_url)
                                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-11 h-11 rounded-xl object-cover border border-outline-variant">
                                                @else
                                                    <div class="w-11 h-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                                                        <span class="material-symbols-outlined">inventory</span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="font-bold text-on-surface">{{ $product->name }}</p>
                                                    <p class="text-body-sm text-on-surface-variant">Ditambahkan {{ $product->created_at->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-on-surface-variant">{{ $product->category?->name ?? 'Tanpa kategori' }}</td>
                                        <td class="px-6 py-4 text-on-surface-variant">{{ $product->sku ?: '-' }}</td>
                                        <td class="px-6 py-4 text-center font-bold {{ $status === 'kritis' ? 'text-error' : ($status === 'menipis' ? 'text-amber-600' : 'text-primary') }}">{{ $product->stock }}</td>
                                        <td class="px-6 py-4 text-right font-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-body-sm font-bold {{ $badgeClass }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('products.edit', $product) }}" class="px-3 py-2 rounded-xl border border-outline-variant text-primary font-bold text-body-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-2 rounded-xl bg-error-container text-on-error-container font-bold text-body-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <aside class="col-span-12 xl:col-span-4 space-y-card-gap">
                <div class="bg-white rounded-2xl border border-outline-variant p-6">
                    <h3 class="font-h3 text-h3 text-primary mb-4">Kategori Tersedia</h3>
                    @if ($categories->isEmpty())
                        <p class="text-body-sm text-on-surface-variant mb-4">Belum ada kategori. Anda bisa membuat kategori saat membuka form tambah produk.</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 text-primary font-bold">
                            <span class="material-symbols-outlined">category</span>
                            Buka Form Produk
                        </a>
                    @else
                        <div class="flex flex-wrap gap-2">
                            @foreach ($categories as $category)
                                <span class="px-3 py-2 rounded-full bg-white text-on-surface text-body-sm">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl border border-outline-variant p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="material-symbols-outlined text-tertiary">warning</span>
                        <h3 class="font-h3 text-h3 text-primary">Perlu Restock</h3>
                    </div>
                    @if ($restockItems->isEmpty())
                        <p class="text-body-sm text-on-surface-variant">Tidak ada produk yang mendekati habis. Inventori dalam kondisi aman.</p>
                    @else
                        <div class="space-y-3">
                            @foreach ($restockItems as $item)
                                <div class="rounded-xl border border-outline-variant bg-white p-4">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="font-bold text-on-surface">{{ $item->name }}</p>
                                            <p class="text-body-sm text-on-surface-variant">{{ $item->category?->name ?? 'Tanpa kategori' }}</p>
                                        </div>
                                        <span class="font-bold {{ $item->stock < 5 ? 'text-error' : 'text-amber-600' }}">{{ $item->stock }} unit</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </section>
</main>

<script src="/template/tokoq_design_system/responsive.js"></script>
</body>
</html>
