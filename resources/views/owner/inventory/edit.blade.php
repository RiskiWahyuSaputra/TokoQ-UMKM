@extends('owner.layouts.app')

@section('title', 'Edit Produk - TokoQ')

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

            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block mb-2 font-bold text-body-sm">Nama Produk</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $product->name) }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" required>
                    </div>

                    <div>
                        <label for="category_id" class="block mb-2 font-bold text-body-sm">Kategori</label>
                        <select id="category_id" name="category_id" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary">
                            <option value="">Tanpa kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="sku" class="block mb-2 font-bold text-body-sm">SKU</label>
                        <input id="sku" name="sku" type="text" value="{{ old('sku', $product->sku) }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" placeholder="Opsional">
                    </div>

                    <div>
                        <label for="price" class="block mb-2 font-bold text-body-sm">Harga Jual</label>
                        <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price) }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" required>
                    </div>

                    <div>
                        <label for="cost_price" class="block mb-2 font-bold text-body-sm">Harga Pokok (Modal)</label>
                        <input id="cost_price" name="cost_price" type="number" min="0" step="0.01" value="{{ old('cost_price', $product->cost_price) }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" placeholder="0">
                        <p class="mt-1 text-xs text-on-surface-variant">Kosongkan jika tidak ingin menghitung keuntungan.</p>
                    </div>

                    <div>
                        <label for="stock" class="block mb-2 font-bold text-body-sm">Stok</label>
                        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $product->stock) }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary" required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="image" class="block mb-2 font-bold text-body-sm">Ganti Foto Produk</label>
                        <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary">
                        <p class="mt-2 text-body-sm text-on-surface-variant">Kosongkan jika tidak ingin mengganti foto.</p>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('products.index') }}" class="px-5 py-3 rounded-xl border border-outline-variant font-bold text-on-surface">Batal</a>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-primary text-on-primary font-bold">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <aside class="col-span-12 xl:col-span-4">
            <div class="bg-white rounded-2xl border border-outline-variant p-6">
                <h3 class="font-h3 text-h3 text-primary mb-3">Info Produk</h3>
                @if ($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-2xl mb-4 border border-outline-variant">
                @else
                    <div class="w-full h-48 rounded-2xl mb-4 border border-dashed border-outline-variant bg-surface flex items-center justify-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[40px]">image</span>
                    </div>
                @endif
                <div class="space-y-3 text-body-sm">
                    <div>
                        <p class="text-on-surface-variant">Dibuat</p>
                        <p class="font-bold text-on-surface">{{ $product->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-on-surface-variant">Kategori Saat Ini</p>
                        <p class="font-bold text-on-surface">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>
                    </div>
                    <div>
                        <p class="text-on-surface-variant">Status Stok</p>
                        <p class="font-bold text-on-surface">{{ ucfirst($product->status) }}</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection
