<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Tambah Produk - TokoQ</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="/template/tokoq_design_system/responsive.css" rel="stylesheet"/>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: { extend: { "colors": { "inverse-primary": "#b8cf8c","tertiary-fixed": "#dae9ac","surface-bright": "#f8fbea","primary-fixed-dim": "#b8cf8c","primary-fixed": "#d3eba6","on-surface": "#191d13","inverse-on-surface": "#f0f2e2","surface-tint": "#51652e","outline": "#75786b","background": "#f8fbea","surface-variant": "#e1e4d4","on-secondary-container": "#596841","on-tertiary": "#ffffff","secondary-fixed-dim": "#bccd9e","on-error-container": "#93000a","inverse-surface": "#2e3227","secondary": "#55633d","surface-dim": "#d9dccb","secondary-fixed": "#d8e9b9","error-container": "#ffdad6","surface-container-highest": "#e1e4d4","on-tertiary-fixed": "#161f00","primary-container": "#576b33","surface-container-high": "#e7ead9","on-background": "#191d13","on-error": "#ffffff","surface-container-low": "#f2f5e4","tertiary": "#445122","secondary-container": "#d5e6b6","on-primary-container": "#d3eba5","tertiary-container": "#5c6938","on-secondary-fixed": "#131f02","outline-variant": "#c5c8b9","on-secondary": "#ffffff","on-primary-fixed": "#131f00","on-secondary-fixed-variant": "#3d4b28","surface": "#f8fbea","tertiary-fixed-dim": "#becd92","surface-container-lowest": "#ffffff","on-tertiary-container": "#d9e8aa","on-surface-variant": "#45483d","surface-container": "#edefdf","on-primary": "#ffffff","primary": "#40521d","on-primary-fixed-variant": "#3a4d18","error": "#ba1a1a","on-tertiary-fixed-variant": "#3f4b1d" }, "borderRadius": { "DEFAULT": "0.25rem","lg": "0.5rem","xl": "0.75rem","full": "9999px" }, "spacing": { "container-padding": "32px","section-margin": "48px","gutter": "24px","unit": "8px","card-gap": "24px" }, "fontSize": { "h2-mobile": ["24px", {"lineHeight": "1.3","fontWeight": "700"}],"h1-mobile": ["28px", {"lineHeight": "1.2","fontWeight": "700"}],"body-md": ["16px", {"lineHeight": "1.6","fontWeight": "400"}],"body-lg": ["18px", {"lineHeight": "1.6","fontWeight": "400"}],"body-sm": ["14px", {"lineHeight": "1.5","fontWeight": "400"}],"h1": ["40px", {"lineHeight": "1.2","letterSpacing": "-0.02em","fontWeight": "700"}],"h3": ["24px", {"lineHeight": "1.4","fontWeight": "600"}],"label-caps": ["12px", {"lineHeight": "1.2","letterSpacing": "0.05em","fontWeight": "700"}],"h2": ["32px", {"lineHeight": "1.3","letterSpacing": "-0.01em","fontWeight": "700"}] } } }
}
</script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="app-shell bg-background text-on-surface font-body-md">
@include('owner.layouts.sidebar', ['activeMenu' => 'inventory'])

<main class="app-main ml-64 min-h-screen">
    <header class="app-header h-20 w-full sticky top-0 z-40 bg-surface border-b border-outline-variant flex justify-between items-center px-container-padding">
        <div class="flex items-center gap-4">
            <button aria-label="Buka menu" class="mobile-nav-trigger lg:hidden" data-sidebar-toggle type="button">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div>
                <h1 class="font-h3 text-h3 font-bold text-primary">Tambah Produk</h1>
                <p class="text-body-sm text-on-surface-variant">Masukkan data produk nyata yang akan tampil di inventori dan POS.</p>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="text-primary font-bold">Kembali ke Inventori</a>
    </header>

    <section class="app-page p-container-padding">
        <div class="grid grid-cols-12 gap-card-gap">
            <div class="col-span-12 xl:col-span-8 bg-surface-container-lowest rounded-2xl border border-outline-variant p-8">
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-error/20 bg-error-container px-4 py-4 text-on-error-container">
                        <p class="font-bold mb-2">Data belum lengkap:</p>
                        <ul class="list-disc pl-5 text-body-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="name" class="block mb-2 font-bold text-body-sm">Nama Produk</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" placeholder="Contoh: Kopi Arabika 200gr" required>
                        </div>

                        <div>
                            <label for="category_id" class="block mb-2 font-bold text-body-sm">Kategori</label>
                            <select id="category_id" name="category_id" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary">
                                <option value="">Tanpa kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="sku" class="block mb-2 font-bold text-body-sm">SKU</label>
                            <input id="sku" name="sku" type="text" value="{{ old('sku') }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" placeholder="Opsional">
                        </div>

                        <div>
                            <label for="price" class="block mb-2 font-bold text-body-sm">Harga Jual</label>
                            <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price') }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" placeholder="0" required>
                        </div>

                        <div>
                            <label for="stock" class="block mb-2 font-bold text-body-sm">Stok Awal</label>
                            <input id="stock" name="stock" type="number" min="0" value="{{ old('stock') }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" placeholder="0" required>
                        </div>

                        <div class="md:col-span-2">
                            <label for="image" class="block mb-2 font-bold text-body-sm">Foto Produk</label>
                            <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary">
                            <p class="mt-2 text-body-sm text-on-surface-variant">Format `jpg`, `jpeg`, `png`, atau `webp`. Maksimal 2MB.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('products.index') }}" class="px-5 py-3 rounded-xl border border-outline-variant font-bold text-on-surface">Batal</a>
                        <button type="submit" class="px-6 py-3 rounded-xl bg-primary text-on-primary font-bold">Simpan Produk</button>
                    </div>
                </form>
            </div>

            <aside class="col-span-12 xl:col-span-4 space-y-card-gap">
                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant p-6">
                    <h2 class="font-h3 text-h3 text-primary mb-3">Kategori Cepat</h2>
                    <p class="text-body-sm text-on-surface-variant mb-5">Kalau kategori belum ada, tambahkan di sini tanpa keluar dari halaman.</p>
                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="quick_category" class="block mb-2 font-bold text-body-sm">Nama Kategori</label>
                            <input id="quick_category" name="name" type="text" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" placeholder="Contoh: Minuman">
                        </div>
                        <button type="submit" class="w-full px-5 py-3 rounded-xl bg-secondary text-on-secondary font-bold">Tambah Kategori</button>
                    </form>
                </div>

                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant p-6">
                    <h3 class="font-h3 text-h3 text-primary mb-4">Kategori Saat Ini</h3>
                    @if ($categories->isEmpty())
                        <p class="text-body-sm text-on-surface-variant">Belum ada kategori yang tersimpan.</p>
                    @else
                        <div class="flex flex-wrap gap-2">
                            @foreach ($categories as $category)
                                <span class="px-3 py-2 rounded-full bg-surface-container text-on-surface text-body-sm">{{ $category->name }}</span>
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
