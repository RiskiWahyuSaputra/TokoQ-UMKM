@extends('owner.layouts.app')

@section('title', 'Inventori - TokoQ')

@section('styles')
<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fadeInUp 0.5s ease-out forwards; }
.animate-fade-in-delay-1 { animation: fadeInUp 0.5s ease-out 0.1s forwards; opacity: 0; }
.animate-fade-in-delay-2 { animation: fadeInUp 0.5s ease-out 0.2s forwards; opacity: 0; }
.animate-fade-in-delay-3 { animation: fadeInUp 0.5s ease-out 0.3s forwards; opacity: 0; }

.gradient-success { background: linear-gradient(135deg, #10B981 0%, #34D399 100%); }
.gradient-danger { background: linear-gradient(135deg, #EF4444 0%, #F87171 100%); }
.gradient-warning { background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%); }
.gradient-info { background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%); }

.card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.card-hover:hover { transform: translateY(-3px); box-shadow: 0 15px 30px -8px rgba(16, 185, 129, 0.12); }

.scrollbar-thin::-webkit-scrollbar { width: 4px; }
.scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
.scrollbar-thin::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 10px; }

@keyframes pulse-dot {
    0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
    50% { box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
}
.pulse-dot { animation: pulse-dot 2s infinite; }
</style>
@endsection

@section('content')
@php
    $user = Auth::user();
    $restockItems = $products->where('stock', '<=', 10)->sortBy('stock')->take(5);
    $totalProducts = $stockSummary['total'] ?? 0;
    $criticalCount = $stockSummary['critical'] ?? 0;
    $lowCount = $stockSummary['low'] ?? 0;
    $safeCount = $stockSummary['safe'] ?? 0;
@endphp

<div class="p-4 lg:p-6 space-y-5">

    <!-- Success Message -->
    @if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-5 py-4 flex items-center gap-3 animate-fade-in">
        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-emerald-500 text-[18px]">check</span>
        </div>
        <p class="text-emerald-700 font-medium text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <!-- Total Produk -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover animate-fade-in">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-info rounded-xl flex items-center justify-center shadow-lg shadow-info/20">
                    <span class="material-symbols-outlined text-white text-[20px]">inventory_2</span>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">{{ $totalProducts }}</p>
            <p class="text-xs text-gray-400 mt-1">Total Produk</p>
        </div>

        <!-- Stok Kritis -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover animate-fade-in-delay-1">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-danger rounded-xl flex items-center justify-center shadow-lg shadow-danger/20 relative">
                    <span class="material-symbols-outlined text-white text-[20px]">warning</span>
                    @if($criticalCount > 0)
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full pulse-dot"></span>
                    @endif
                </div>
            </div>
            <p class="text-2xl font-extrabold {{ $criticalCount > 0 ? 'text-red-500' : 'text-on-surface' }}">{{ $criticalCount }}</p>
            <p class="text-xs text-gray-400 mt-1">Stok Kritis</p>
        </div>

        <!-- Stok Menipis -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover animate-fade-in-delay-2">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-warning rounded-xl flex items-center justify-center shadow-lg shadow-warning/20">
                    <span class="material-symbols-outlined text-white text-[20px]">trending_down</span>
                </div>
            </div>
            <p class="text-2xl font-extrabold {{ $lowCount > 0 ? 'text-amber-500' : 'text-on-surface' }}">{{ $lowCount }}</p>
            <p class="text-xs text-gray-400 mt-1">Stok Menipis</p>
        </div>

        <!-- Nilai Inventori -->
        <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover animate-fade-in-delay-3">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-success rounded-xl flex items-center justify-center shadow-lg shadow-success/20">
                    <span class="material-symbols-outlined text-white text-[20px]">account_balance</span>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-on-surface">Rp {{ number_format($stockSummary['inventoryValue'] ?? 0, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Nilai Jual Inventori</p>
            <div class="mt-2 pt-2 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-400">Modal: Rp {{ number_format($stockSummary['inventoryCost'] ?? 0, 0, ',', '.') }}</span>
                <span class="text-xs font-bold text-emerald-600">Potensi Laba: Rp {{ number_format($stockSummary['potentialProfit'] ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Alert Banner -->
    @if($criticalCount > 0)
    <div class="bg-gradient-to-r from-red-50 to-orange-50 border border-red-200 rounded-2xl p-4 flex items-center gap-4 animate-fade-in">
        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-red-500">error</span>
        </div>
        <div class="flex-1 min-w-0">
            <p class="font-bold text-red-700 text-sm">{{ $criticalCount }} Produk Stok Kritis!</p>
            <p class="text-xs text-red-600">Segera restok produk berikut agar tidak kehabisan stok.</p>
        </div>
        <a href="{{ route('ai.index') }}" class="shrink-0 px-4 py-2 bg-red-500 text-white rounded-xl text-xs font-bold hover:bg-red-600 transition-colors">
            Lihat Rekomendasi
        </a>
    </div>
    @endif

    <!-- Main Content Grid -->
    <div class="grid grid-cols-12 gap-4">

        <!-- Product Table -->
        <div class="col-span-12 xl:col-span-8">
            <div class="bg-white rounded-2xl border border-outline-variant overflow-hidden">
                <!-- Table Header -->
                <div class="p-5 border-b border-outline-variant flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-500 text-[20px]">inventory</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface">Daftar Produk</h3>
                            <p class="text-xs text-gray-400">{{ $totalProducts }} produk tercatat</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="px-2.5 py-1 rounded-full bg-red-100 text-red-600 text-[10px] font-bold">Kritis: {{ $criticalCount }}</span>
                        <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-700 text-[10px] font-bold">Menipis: {{ $lowCount }}</span>
                        <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">Aman: {{ $safeCount }}</span>
                        <a href="{{ route('products.create') }}" class="ml-auto sm:ml-0 px-4 py-2 bg-primary text-white rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-primary-dark transition-colors">
                            <span class="material-symbols-outlined text-[16px]">add</span>
                            Tambah
                        </a>
                    </div>
                </div>

                @if ($products->isEmpty())
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="material-symbols-outlined text-4xl text-gray-200">inventory_2</span>
                        </div>
                        <h4 class="font-bold text-on-surface mb-1">Belum Ada Produk</h4>
                        <p class="text-sm text-gray-400 mb-4 max-w-sm mx-auto">Mulai isi data inventori toko Anda dengan menambahkan produk pertama.</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-bold text-sm">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Tambah Produk Pertama
                        </a>
                    </div>
                @else
                    <!-- Table -->
                    <div class="overflow-x-auto scrollbar-thin">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                                <tr>
                                    <th class="px-5 py-3">Produk</th>
                                    <th class="px-5 py-3 hidden sm:table-cell">Kategori</th>
                                    <th class="px-5 py-3 hidden md:table-cell">SKU</th>
                                    <th class="px-5 py-3 text-center">Stok</th>
                                    <th class="px-5 py-3 text-right">Harga</th>
                                    <th class="px-5 py-3 text-right hidden sm:table-cell">Modal</th>
                                    <th class="px-5 py-3 text-right hidden sm:table-cell">Laba/unit</th>
                                    <th class="px-5 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($products as $product)
                                    @php
                                        $status = $product->status;
                                        $badgeClass = match ($status) {
                                            'kritis' => 'bg-red-100 text-red-600',
                                            'menipis' => 'bg-amber-100 text-amber-700',
                                            default => 'bg-emerald-100 text-emerald-700',
                                        };
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-5 py-3">
                                            <div class="flex items-center gap-3">
                                                @if ($product->image_url)
                                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-xl object-cover border border-gray-200 shrink-0">
                                                @else
                                                    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                                        <span class="material-symbols-outlined text-[18px]">inventory</span>
                                                    </div>
                                                @endif
                                                <div class="min-w-0">
                                                    <p class="font-bold text-sm text-on-surface truncate">{{ $product->name }}</p>
                                                    <p class="text-xs text-gray-400 sm:hidden">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3 text-sm text-gray-500 hidden sm:table-cell">{{ $product->category?->name ?? '-' }}</td>
                                        <td class="px-5 py-3 text-sm text-gray-400 hidden md:table-cell">{{ $product->sku ?: '-' }}</td>
                                        <td class="px-5 py-3 text-center">
                                            <span class="font-bold text-sm {{ $status === 'kritis' ? 'text-red-500' : ($status === 'menipis' ? 'text-amber-500' : 'text-emerald-500') }}">{{ $product->stock }}</span>
                                            <span class="text-xs text-gray-400"> unit</span>
                                        </td>
                                        <td class="px-5 py-3 text-right font-bold text-sm text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-5 py-3 text-right text-sm text-gray-500 hidden sm:table-cell">Rp {{ number_format($product->cost_price, 0, ',', '.') }}</td>
                                        <td class="px-5 py-3 text-right hidden sm:table-cell">
                                            @if($product->cost_price > 0)
                                                <span class="text-sm font-bold {{ $product->profitPerUnit > 0 ? 'text-emerald-600' : 'text-red-500' }}">Rp {{ number_format($product->profitPerUnit, 0, ',', '.') }}</span>
                                                <span class="text-[10px] text-gray-400 block">{{ $product->profitMargin }}%</span>
                                            @else
                                                <span class="text-xs text-gray-300">-</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('products.edit', $product) }}" class="px-3 py-1.5 rounded-lg border border-gray-200 text-primary font-bold text-xs hover:bg-gray-50 transition-colors">Edit</a>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-500 font-bold text-xs hover:bg-red-100 transition-colors">Hapus</button>
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
        </div>

        <!-- Sidebar -->
        <aside class="col-span-12 xl:col-span-4 space-y-4">

            <!-- Kategori -->
            <div class="bg-white rounded-2xl border border-outline-variant p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-purple-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-purple-500 text-[20px]">category</span>
                    </div>
                    <h3 class="font-bold text-on-surface">Kategori</h3>
                </div>
                @if ($categories->isEmpty())
                    <p class="text-sm text-gray-400 mb-3">Belum ada kategori.</p>
                    <a href="{{ route('products.create') }}" class="text-primary font-bold text-xs hover:underline">+ Buat kategori</a>
                @else
                    <div class="flex flex-wrap gap-2">
                        @foreach ($categories as $category)
                            <span class="px-3 py-1.5 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Perlu Restock -->
            <div class="bg-white rounded-2xl border border-outline-variant p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-500 text-[20px]">warning</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-on-surface">Perlu Restock</h3>
                        <p class="text-xs text-gray-400">Stok ≤ 10 unit</p>
                    </div>
                </div>
                @if ($restockItems->isEmpty())
                    <div class="text-center py-6">
                        <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-2">
                            <span class="material-symbols-outlined text-emerald-500 text-[24px]">check_circle</span>
                        </div>
                        <p class="text-sm text-gray-400">Semua stok aman ✓</p>
                    </div>
                @else
                    <div class="space-y-2">
                        @foreach ($restockItems as $item)
                            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="min-w-0 flex-1">
                                    <p class="font-bold text-sm text-on-surface truncate">{{ $item->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $item->category?->name ?? 'Tanpa kategori' }}</p>
                                </div>
                                <div class="text-right shrink-0 ml-3">
                                    <p class="font-bold text-sm {{ $item->stock < 5 ? 'text-red-500' : 'text-amber-500' }}">{{ $item->stock }}</p>
                                    <p class="text-[10px] text-gray-400">unit</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('ai.index') }}" class="block w-full mt-3 py-2 text-center text-primary font-bold text-xs border border-primary/20 rounded-xl hover:bg-primary/5 transition-colors">
                        Lihat Rekomendasi AI →
                    </a>
                @endif
            </div>

            <!-- Stok Distribution -->
            <div class="bg-white rounded-2xl border border-outline-variant p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-500 text-[20px]">pie_chart</span>
                    </div>
                    <h3 class="font-bold text-on-surface">Distribusi Stok</h3>
                </div>
                @if($totalProducts > 0)
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-emerald-600 font-medium">Aman</span>
                                <span class="text-gray-400">{{ $safeCount }} produk</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ ($safeCount / $totalProducts) * 100 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-amber-600 font-medium">Menipis</span>
                                <span class="text-gray-400">{{ $lowCount }} produk</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 rounded-full" style="width: {{ ($lowCount / $totalProducts) * 100 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-red-600 font-medium">Kritis</span>
                                <span class="text-gray-400">{{ $criticalCount }} produk</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-red-500 rounded-full" style="width: {{ ($criticalCount / $totalProducts) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-gray-400 text-center py-4">Belum ada data</p>
                @endif
            </div>
        </aside>
    </div>

    <!-- Footer -->
    <footer class="pb-4 flex flex-col sm:flex-row justify-between items-center gap-2 opacity-40">
        <p class="text-xs">&copy; 2025 TokoQ. All rights reserved.</p>
    </footer>
</div>
@endsection
