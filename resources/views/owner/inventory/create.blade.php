@extends('owner.layouts.app')

@section('title', 'Tambah Produk - TokoQ')

@section('content')
<section class="app-page p-container-padding">
    <div class="grid grid-cols-12 gap-card-gap">
        <div class="col-span-12 xl:col-span-8 bg-white rounded-2xl border border-outline-variant p-8">
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
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
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

            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <h3 class="font-h3 text-h3 text-primary mb-4">Kategori Saat Ini</h3>
                @if ($categories->isEmpty())
                    <p class="text-body-sm text-on-surface-variant">Belum ada kategori yang tersimpan.</p>
                @else
                    <div class="flex flex-wrap gap-2">
                        @foreach ($categories as $category)
                            <span class="px-3 py-2 rounded-full bg-white text-on-surface text-body-sm">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </aside>
    </div>
</section>
@endsection
