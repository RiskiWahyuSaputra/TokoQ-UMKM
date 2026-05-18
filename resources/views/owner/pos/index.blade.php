@extends('owner.layouts.app')

@section('title', 'Kasir POS - TokoQ')

@section('styles')
<style>
.qris-pixel:nth-child(1), .qris-pixel:nth-child(2), .qris-pixel:nth-child(3),
.qris-pixel:nth-child(5), .qris-pixel:nth-child(7), .qris-pixel:nth-child(8),
.qris-pixel:nth-child(9), .qris-pixel:nth-child(11), .qris-pixel:nth-child(13),
.qris-pixel:nth-child(15), .qris-pixel:nth-child(16), .qris-pixel:nth-child(19),
.qris-pixel:nth-child(20), .qris-pixel:nth-child(21), .qris-pixel:nth-child(23),
.qris-pixel:nth-child(25), .qris-pixel:nth-child(26), .qris-pixel:nth-child(27),
.qris-pixel:nth-child(29), .qris-pixel:nth-child(30), .qris-pixel:nth-child(33),
.qris-pixel:nth-child(35), .qris-pixel:nth-child(36), .qris-pixel:nth-child(37),
.qris-pixel:nth-child(39), .qris-pixel:nth-child(40), .qris-pixel:nth-child(42),
.qris-pixel:nth-child(43), .qris-pixel:nth-child(45), .qris-pixel:nth-child(46),
.qris-pixel:nth-child(48), .qris-pixel:nth-child(49) {
    background-color: #374151;
}

/* Mobile sticky cart */
.mobile-cart-bar {
    display: none;
}
@media (max-width: 1279px) {
    .mobile-cart-bar {
        display: flex;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 60;
        background: white;
        border-top: 1px solid #E5E7EB;
        box-shadow: 0 -4px 20px rgba(0,0,0,0.08);
        padding: 12px 16px;
        align-items: center;
        gap: 12px;
    }
    .mobile-cart-bar + .xl\:flex-row {
        padding-bottom: 80px;
    }
    /* Hide desktop cart on mobile */
    .xl\:w-\[28rem\] {
        display: none !important;
    }
    /* Show mobile product grid full width */
    .xl\:flex-row {
        flex-direction: column !important;
    }
}

/* Confirmation modal */
.confirm-overlay {
    position: fixed;
    inset: 0;
    z-index: 90;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: flex-end;
    justify-content: center;
}
@media (min-width: 640px) {
    .confirm-overlay {
        align-items: center;
    }
}
.confirm-modal {
    background: white;
    width: 100%;
    max-width: 480px;
    border-radius: 24px 24px 0 0;
    padding: 24px;
    max-height: 90vh;
    overflow-y: auto;
}
@media (min-width: 640px) {
    .confirm-modal {
        border-radius: 24px;
    }
}

/* Discount input */
.discount-input::-webkit-inner-spin-button,
.discount-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.discount-input {
    -moz-appearance: textfield;
}

@keyframes slide-up {
    from { transform: translateY(100%); }
    to { transform: translateY(0); }
}
.animate-slide-up { animation: slide-up 0.3s ease-out; }

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(20px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes bounceIn {
    0% { transform: scale(0.3); opacity: 0; }
    50% { transform: scale(1.05); }
    70% { transform: scale(0.9); }
    100% { transform: scale(1); opacity: 1; }
}
@keyframes pulse-green {
    0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
    50% { box-shadow: 0 0 0 12px rgba(16, 185, 129, 0); }
}
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
}
.animate-slide-in { animation: slideInRight 0.3s ease-out; }
.animate-bounce-in { animation: bounceIn 0.5s ease-out; }
.animate-pulse-green { animation: pulse-green 2s infinite; }
.animate-shake { animation: shake 0.3s ease-in-out; }

.product-card { transition: all 0.2s ease; }
.product-card:active { transform: scale(0.97); }
.product-card:hover { box-shadow: 0 8px 25px -5px rgba(16, 185, 129, 0.15); }

.cart-item { animation: slideInRight 0.3s ease-out; }

.gradient-success { background: linear-gradient(135deg, #10B981 0%, #34D399 100%); }
.gradient-danger { background: linear-gradient(135deg, #EF4444 0%, #F87171 100%); }

.payment-btn { transition: all 0.2s ease; }
.payment-btn:hover { transform: translateY(-2px); }

.scrollbar-thin::-webkit-scrollbar { width: 4px; }
.scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
.scrollbar-thin::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 10px; }
</style>
@endsection

@section('content')
@php
    $user = Auth::user();
    $posProducts = $products->map(function ($product) {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => (float) $product->price,
            'stock' => (int) $product->stock,
            'category_id' => $product->category_id,
            'image_url' => $product->image_url,
        ];
    })->values();
@endphp

<div class="flex flex-col xl:flex-row gap-4 p-4 lg:p-6 pt-6">
    <!-- Product Grid Section -->
    <section class="flex-1 space-y-4">
        <!-- Search & Filter Bar -->
        <div class="bg-white rounded-2xl border border-outline-variant p-4 shadow-sm">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    <input id="product-search" type="text" placeholder="Cari nama produk..."
                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white outline-none transition-all text-sm"/>
                </div>
                <a href="{{ route('products.create') }}" class="px-4 py-3 rounded-xl border-2 border-dashed border-gray-300 text-gray-500 font-bold text-sm flex items-center gap-2 hover:border-primary hover:text-primary transition-colors justify-center sm:justify-start">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    <span class="hidden sm:inline">Produk Baru</span>
                </a>
            </div>
            <div class="flex flex-wrap gap-2 mt-3" id="category-filters">
                <button type="button" data-category-filter="all" class="category-filter px-4 py-1.5 rounded-full bg-primary text-white text-xs font-bold transition-all">Semua</button>
                @foreach ($categories as $category)
                    <button type="button" data-category-filter="{{ $category->id }}" class="category-filter px-4 py-1.5 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-gray-200 transition-all">{{ $category->name }}</button>
                @endforeach
            </div>
        </div>

        @if ($products->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl border border-outline-variant p-12 text-center">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-5">
                    <span class="material-symbols-outlined text-4xl text-primary">inventory_2</span>
                </div>
                <h2 class="font-h3 text-h3 text-on-surface mb-2">Belum Ada Produk</h2>
                <p class="text-body-sm text-on-surface-variant max-w-sm mx-auto mb-6">Tambahkan produk pertama Anda agar bisa mulai berjualan di kasir.</p>
                <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-dark transition-colors">
                    <span class="material-symbols-outlined">add</span>
                    Tambah Produk Sekarang
                </a>
            </div>
        @else
            <!-- Product Grid -->
            <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-3">
                @foreach ($products as $product)
                    @php
                        $statusClass = match ($product->status) {
                            'kritis' => 'bg-red-100 text-red-600',
                            'menipis' => 'bg-amber-100 text-amber-700',
                            default => 'bg-emerald-100 text-emerald-700',
                        };
                        $statusLabel = match ($product->status) {
                            'kritis' => 'Kritis',
                            'menipis' => 'Menipis',
                            default => 'Aman',
                        };
                    @endphp
                    <article
                        class="product-card bg-white rounded-2xl border border-outline-variant p-4 cursor-pointer group relative overflow-hidden"
                        data-product-card
                        data-product-id="{{ $product->id }}"
                        data-product-name="{{ strtolower($product->name) }}"
                        data-category-id="{{ $product->category_id ?? '' }}"
                        data-stock="{{ $product->stock }}"
                        data-price="{{ $product->price }}"
                    >
                        <!-- Stock badge -->
                        <div class="absolute top-3 right-3 z-10">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $statusClass }}">{{ $statusLabel }}</span>
                        </div>

                        <!-- Product Image -->
                        <div class="aspect-square rounded-xl overflow-hidden mb-3 bg-gray-50 flex items-center justify-center">
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary/5 to-primary/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-primary/30">inventory_2</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <h3 class="font-bold text-on-surface text-sm truncate mb-1">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-400 mb-2">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>

                        <div class="flex items-end justify-between">
                            <div>
                                <p class="font-bold text-primary text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-[11px] text-gray-400">Stok: {{ $product->stock }}</p>
                            </div>
                            <button
                                type="button"
                                class="add-to-cart w-9 h-9 rounded-xl gradient-success text-white flex items-center justify-center shadow-lg shadow-success/20 hover:shadow-success/40 transition-all active:scale-90 {{ $product->stock < 1 ? 'opacity-40 cursor-not-allowed' : '' }}"
                                data-add-product
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-price="{{ $product->price }}"
                                data-product-stock="{{ $product->stock }}"
                                @disabled($product->stock < 1)
                            >
                                <span class="material-symbols-outlined text-[18px]">{{ $product->stock < 1 ? 'block' : 'add' }}</span>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <!-- Cart Sidebar -->
    <aside class="w-full xl:w-[28rem] shrink-0">
        <div class="bg-white rounded-2xl border border-outline-variant shadow-lg overflow-hidden sticky top-24">
            <!-- Cart Header -->
            <div class="p-4 border-b border-outline-variant bg-gradient-to-r from-primary to-emerald-600 text-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined">shopping_cart</span>
                        </div>
                        <div>
                            <h2 class="font-bold">Keranjang</h2>
                            <p class="text-white/70 text-xs" id="cart-item-count">0 item</p>
                        </div>
                    </div>
                    <button id="clear-cart" type="button" class="text-white/70 hover:text-white text-xs font-bold flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[16px]">delete_sweep</span>
                        Hapus Semua
                    </button>
                </div>
            </div>

            <!-- Message -->
            <div id="checkout-message" class="hidden mx-4 mt-4 rounded-xl px-4 py-3 text-sm"></div>

            <!-- Cart Items -->
            <div id="cart-items" class="max-h-[300px] xl:max-h-[400px] overflow-y-auto p-4 space-y-3 scrollbar-thin">
                <div id="cart-empty" class="text-center py-10">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="material-symbols-outlined text-3xl text-gray-300">shopping_basket</span>
                    </div>
                    <p class="text-sm text-gray-400">Keranjang kosong</p>
                    <p class="text-xs text-gray-300 mt-1">Tap produk untuk menambah</p>
                </div>
            </div>

            <!-- Payment & Summary -->
            <div class="p-4 border-t border-outline-variant bg-gray-50 space-y-4">
                <!-- Payment Method -->
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Metode Pembayaran</p>
                    <div class="grid grid-cols-3 gap-2">
                        <button type="button" data-payment="tunai" class="payment-btn payment-method px-3 py-2.5 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold text-xs flex flex-col items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">payments</span>
                            Tunai
                        </button>
                        <button type="button" data-payment="qris" class="payment-btn payment-method px-3 py-2.5 rounded-xl border border-gray-200 font-bold text-xs flex flex-col items-center gap-1 text-gray-600 hover:border-gray-300">
                            <span class="material-symbols-outlined text-[18px]">qr_code</span>
                            QRIS
                        </button>
                        <button type="button" data-payment="e-wallet" class="payment-btn payment-method px-3 py-2.5 rounded-xl border border-gray-200 font-bold text-xs flex flex-col items-center gap-1 text-gray-600 hover:border-gray-300">
                            <span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
                            E-Wallet
                        </button>
                    </div>

                    <!-- E-Wallet Picker -->
                    <div id="ewallet-picker" class="hidden mt-3 p-3 bg-white rounded-xl border border-gray-200">
                        <p class="text-xs font-bold text-gray-500 mb-2">Pilih E-Wallet</p>
                        <div class="space-y-2">
                            <button type="button" data-ewallet-provider="dana" data-ewallet-number="085789910963" class="ewallet-option w-full rounded-lg border-2 border-primary bg-primary/5 px-3 py-2.5 text-left flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-xs font-bold">D</div>
                                <div>
                                    <span class="block font-bold text-primary text-xs">DANA</span>
                                    <span class="block text-[10px] text-gray-400">085789910963</span>
                                </div>
                            </button>
                            <button type="button" data-ewallet-provider="gopay" data-ewallet-number="085789910963" class="ewallet-option w-full rounded-lg border border-gray-200 px-3 py-2.5 text-left flex items-center gap-3">
                                <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center text-white text-xs font-bold">G</div>
                                <div>
                                    <span class="block font-bold text-gray-700 text-xs">GoPay</span>
                                    <span class="block text-[10px] text-gray-400">085789910963</span>
                                </div>
                            </button>
                            <button type="button" data-ewallet-provider="ovo" data-ewallet-number="085789910963" class="ewallet-option w-full rounded-lg border border-gray-200 px-3 py-2.5 text-left flex items-center gap-3">
                                <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center text-white text-xs font-bold">O</div>
                                <div>
                                    <span class="block font-bold text-gray-700 text-xs">OVO</span>
                                    <span class="block text-[10px] text-gray-400">085789910963</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="space-y-2 pt-2 border-t border-gray-200">
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-end pt-2">
                        <span class="font-bold text-on-surface">Total Bayar</span>
                        <span id="summary-total" class="text-2xl font-extrabold text-primary">Rp 0</span>
                    </div>
                </div>

                <!-- Checkout Button -->
                <button id="checkout-button" type="button" class="w-full py-4 rounded-xl bg-gradient-to-r from-primary to-emerald-600 text-white font-bold text-base shadow-lg shadow-primary/25 disabled:opacity-40 disabled:cursor-not-allowed disabled:shadow-none hover:shadow-xl hover:shadow-primary/30 transition-all active:scale-[0.98] flex items-center justify-center gap-2" disabled>
                    <span class="material-symbols-outlined">lock</span>
                    Selesaikan Transaksi
                </button>
            </div>
        </div>
    </aside>
</div>

    <!-- Mobile Sticky Cart Bar -->
<div id="mobile-cart-bar" class="mobile-cart-bar cursor-pointer" onclick="openMobileCart()">
    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shrink-0 relative">
        <span class="material-symbols-outlined text-white">shopping_cart</span>
        <span id="mobile-cart-count" class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">0</span>
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-xs text-gray-500 truncate" id="mobile-cart-items-label">Keranjang kosong</p>
        <p class="font-bold text-gray-800" id="mobile-cart-total">Rp 0</p>
    </div>
    <button type="button" class="px-4 py-2 bg-gradient-to-r from-primary to-emerald-600 text-white text-sm font-bold rounded-xl disabled:opacity-40" id="mobile-checkout-btn" disabled>
        Bayar
    </button>
</div>

<!-- Mobile Cart Modal -->
<div id="mobile-cart-modal" class="hidden fixed inset-0 z-[70]">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeMobileCart()"></div>
    <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-3xl max-h-[80vh] flex flex-col animate-slide-up">
        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">shopping_cart</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Keranjang</h3>
                    <p class="text-xs text-gray-400" id="mobile-cart-modal-count">0 item</p>
                </div>
            </div>
            <button type="button" onclick="closeMobileCart()" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-gray-500 text-[18px]">close</span>
            </button>
        </div>
        <div id="mobile-cart-items" class="flex-1 overflow-y-auto p-4 space-y-3 scrollbar-thin">
            <div id="mobile-cart-empty" class="text-center py-10">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-3xl text-gray-300">shopping_basket</span>
                </div>
                <p class="text-sm text-gray-400">Keranjang kosong</p>
                <p class="text-xs text-gray-300 mt-1">Tap produk untuk menambah</p>
            </div>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50 space-y-3">
            <div class="flex justify-between items-center">
                <span class="font-bold text-gray-800">Total Bayar</span>
                <span id="mobile-cart-modal-total" class="text-xl font-extrabold text-primary">Rp 0</span>
            </div>
            <button type="button" id="mobile-modal-checkout-btn" onclick="closeMobileCart(); openConfirmModal();" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-primary to-emerald-600 text-white font-bold text-sm shadow-lg shadow-primary/25 disabled:opacity-40 disabled:cursor-not-allowed flex items-center justify-center gap-2" disabled>
                <span class="material-symbols-outlined text-[18px]">lock</span>
                Selesaikan Transaksi
            </button>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirm-modal" class="confirm-overlay hidden">
    <div class="confirm-modal">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-bold text-gray-800">Konfirmasi Transaksi</h3>
            <button type="button" onclick="closeConfirmModal()" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-gray-500 text-[18px]">close</span>
            </button>
        </div>

        <!-- Customer (optional) -->
        <div class="mb-4">
            <label class="text-xs font-bold text-gray-500 mb-1 block">Nama Pelanggan (opsional)</label>
            <input type="text" id="customer-name" placeholder="Masukkan nama..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none"/>
        </div>

        <!-- Discount -->
        <div class="mb-4">
            <label class="text-xs font-bold text-gray-500 mb-1 block">Diskon (Rp)</label>
            <input type="number" id="discount-amount" placeholder="0" min="0" class="discount-input w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none"/>
        </div>

        <!-- Payment Method -->
        <div class="mb-4">
            <label class="text-xs font-bold text-gray-500 mb-2 block">Metode Pembayaran</label>
            <div class="grid grid-cols-3 gap-2">
                <button type="button" data-confirm-payment="tunai" class="confirm-pay-btn px-3 py-2.5 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold text-xs flex flex-col items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">payments</span> Tunai
                </button>
                <button type="button" data-confirm-payment="qris" class="confirm-pay-btn px-3 py-2.5 rounded-xl border border-gray-200 font-bold text-xs flex flex-col items-center gap-1 text-gray-600">
                    <span class="material-symbols-outlined text-[18px]">qr_code</span> QRIS
                </button>
                <button type="button" data-confirm-payment="e-wallet" class="confirm-pay-btn px-3 py-2.5 rounded-xl border border-gray-200 font-bold text-xs flex flex-col items-center gap-1 text-gray-600">
                    <span class="material-symbols-outlined text-[18px]">account_balance_wallet</span> E-Wallet
                </button>
            </div>
        </div>

        <!-- Cash received (for tunai) -->
        <div id="cash-received-section" class="mb-4">
            <label class="text-xs font-bold text-gray-500 mb-1 block">Uang Diterima</label>
            <input type="number" id="cash-received" placeholder="0" min="0" class="discount-input w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none"/>
            <p id="change-amount" class="text-sm font-bold text-emerald-600 mt-2 hidden">Kembalian: <span id="change-value">Rp 0</span></p>
        </div>

        <!-- Summary -->
        <div class="bg-gray-50 rounded-xl p-4 space-y-2 mb-5">
            <div class="flex justify-between text-sm text-gray-500">
                <span>Subtotal</span>
                <span id="confirm-subtotal">Rp 0</span>
            </div>
            <div class="flex justify-between text-sm text-gray-500" id="confirm-discount-row" style="display:none">
                <span>Diskon</span>
                <span id="confirm-discount" class="text-red-500">- Rp 0</span>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                <span class="font-bold text-gray-800">Total Bayar</span>
                <span id="confirm-total" class="text-xl font-extrabold text-primary">Rp 0</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-3">
            <button type="button" onclick="closeConfirmModal()" class="flex-1 px-4 py-3 rounded-xl border border-gray-200 font-bold text-gray-600 text-sm hover:bg-gray-50 transition-colors">Batal</button>
            <button type="button" id="confirm-pay-btn" class="flex-1 px-4 py-3 rounded-xl bg-gradient-to-r from-primary to-emerald-600 text-white font-bold text-sm shadow-lg shadow-primary/25 hover:shadow-xl transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">check</span> Selesaikan
            </button>
        </div>
    </div>
</div>

<!-- QRIS Modal -->
<div id="qris-modal" class="hidden fixed inset-0 z-[80]">
    <div id="qris-overlay" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    <div class="relative min-h-full flex items-center justify-center p-6">
        <div class="w-full max-w-sm rounded-3xl bg-white shadow-2xl overflow-hidden animate-bounce-in">
            <div class="bg-gradient-to-r from-primary to-emerald-600 text-white px-6 py-5 flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-widest opacity-80">Metode Pembayaran</p>
                    <h3 class="font-h3 text-h3 font-bold">QRIS</h3>
                </div>
                <button id="qris-close" type="button" class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
            <div class="p-6 space-y-5">
                <div class="text-center">
                    <p class="text-sm text-gray-500">Scan QRIS berikut untuk menyelesaikan pembayaran</p>
                    <p id="qris-merchant" class="font-bold text-primary mt-1">{{ $user->shop?->name ?? 'Toko Anda' }}</p>
                </div>

                <div class="mx-auto w-[200px] rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="font-bold text-primary text-sm">QRIS</span>
                        <span class="text-xs text-gray-400">TokoQ Pay</span>
                    </div>
                    <div class="grid grid-cols-7 gap-1 bg-gray-50 p-3 rounded-xl">
                        @for ($i = 0; $i < 49; $i++)
                            <span class="qris-pixel aspect-square rounded-[2px] bg-white"></span>
                        @endfor
                    </div>
                    <div class="mt-3 text-center">
                        <p class="text-xs text-gray-400">Total bayar</p>
                        <p id="qris-total" class="text-lg font-extrabold text-primary">Rp 0</p>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-xl p-3">
                    <p class="font-bold text-blue-700 text-xs mb-1">📱 Langkah Pembayaran</p>
                    <ol class="text-xs text-blue-600 space-y-0.5">
                        <li>1. Buka aplikasi e-wallet / mobile banking</li>
                        <li>2. Scan QRIS pada layar ini</li>
                        <li>3. Setelah berhasil, klik konfirmasi</li>
                    </ol>
                </div>

                <div class="flex gap-3">
                    <button id="qris-cancel" type="button" class="flex-1 px-4 py-3 rounded-xl border border-gray-200 font-bold text-gray-600 text-sm hover:bg-gray-50 transition-colors">Batal</button>
                    <button id="qris-confirm" type="button" class="flex-1 px-4 py-3 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-xl transition-all">Sudah Dibayar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const products = @json($posProducts);

const cart = new Map();
let activeCategory = 'all';
let paymentMethod = 'tunai';

const currency = (value) => `Rp ${Number(value || 0).toLocaleString('id-ID')}`;
const cartItemsEl = document.getElementById('cart-items');
const cartEmptyEl = document.getElementById('cart-empty');
const subtotalEl = document.getElementById('summary-subtotal');
const totalEl = document.getElementById('summary-total');
const qtyEl = document.getElementById('cart-item-count');
const checkoutBtn = document.getElementById('checkout-button');
const messageEl = document.getElementById('checkout-message');
const qrisModal = document.getElementById('qris-modal');
const qrisTotalEl = document.getElementById('qris-total');
const qrisMerchantEl = document.getElementById('qris-merchant');
const qrisConfirmBtn = document.getElementById('qris-confirm');
const qrisCloseBtn = document.getElementById('qris-close');
const qrisCancelBtn = document.getElementById('qris-cancel');
const qrisOverlay = document.getElementById('qris-overlay');
const ewalletPicker = document.getElementById('ewallet-picker');
const ewalletOptions = document.querySelectorAll('.ewallet-option');
let ewalletProvider = 'dana';
let ewalletNumber = '085789910963';
let confirmPaymentMethod = 'tunai';

// Confirm modal
const confirmModal = document.getElementById('confirm-modal');
const confirmSubtotalEl = document.getElementById('confirm-subtotal');
const confirmTotalEl = document.getElementById('confirm-total');
const confirmDiscountRow = document.getElementById('confirm-discount-row');
const confirmDiscountEl = document.getElementById('confirm-discount');
const discountInput = document.getElementById('discount-amount');
const cashReceivedInput = document.getElementById('cash-received');
const cashReceivedSection = document.getElementById('cash-received-section');
const changeAmountEl = document.getElementById('change-amount');
const changeValueEl = document.getElementById('change-value');
const confirmPayBtn = document.getElementById('confirm-pay-btn');

function openConfirmModal() {
    const subtotal = currentSubtotal();
    confirmSubtotalEl.textContent = currency(subtotal);
    confirmTotalEl.textContent = currency(subtotal);
    confirmDiscountRow.style.display = 'none';
    confirmDiscountEl.textContent = '- Rp 0';
    discountInput.value = '';
    cashReceivedInput.value = '';
    changeAmountEl.classList.add('hidden');
    confirmModal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeConfirmModal() {
    confirmModal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Confirm modal payment method buttons
document.querySelectorAll('.confirm-pay-btn').forEach((button) => {
    button.addEventListener('click', () => {
        confirmPaymentMethod = button.dataset.confirmPayment;
        document.querySelectorAll('.confirm-pay-btn').forEach((item) => {
            item.className = 'confirm-pay-btn px-3 py-2.5 rounded-xl border border-gray-200 font-bold text-xs flex flex-col items-center gap-1 text-gray-600';
        });
        button.className = 'confirm-pay-btn px-3 py-2.5 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold text-xs flex flex-col items-center gap-1';

        if (confirmPaymentMethod === 'tunai') {
            cashReceivedSection.classList.remove('hidden');
        } else {
            cashReceivedSection.classList.add('hidden');
        }

        if (confirmPaymentMethod === 'qris') {
            closeConfirmModal();
            openQrisModal();
        } else {
            closeQrisModal();
        }
    });
});

// Cash received calculation
cashReceivedInput.addEventListener('input', () => {
    const received = parseFloat(cashReceivedInput.value) || 0;
    const discount = Math.min(parseFloat(discountInput.value) || 0, currentSubtotal());
    const total = currentSubtotal() - discount;
    if (received >= total) {
        changeAmountEl.classList.remove('hidden');
        changeValueEl.textContent = currency(received - total);
    } else {
        changeAmountEl.classList.add('hidden');
    }
});

// Discount input
discountInput.addEventListener('input', () => {
    const discount = Math.min(parseFloat(discountInput.value) || 0, currentSubtotal());
    const total = currentSubtotal() - discount;
    if (discount > 0) {
        confirmDiscountRow.style.display = 'flex';
        confirmDiscountEl.textContent = `- ${currency(discount)}`;
    } else {
        confirmDiscountRow.style.display = 'none';
    }
    confirmTotalEl.textContent = currency(total);
    // Recalculate change
    cashReceivedInput.dispatchEvent(new Event('input'));
});

// Confirm pay button
confirmPayBtn.addEventListener('click', async () => {
    hideMessage();
    const discount = Math.min(parseFloat(discountInput.value) || 0, currentSubtotal());
    await submitCheckout(discount, document.getElementById('customer-name').value);
});

// Close confirm modal on overlay click
confirmModal.addEventListener('click', (e) => {
    if (e.target === confirmModal) closeConfirmModal();
});

function showMessage(type, text) {
    messageEl.className = `mx-4 mt-4 rounded-xl px-4 py-3 text-sm ${type === 'error' ? 'bg-red-50 text-red-600 border border-red-200' : 'bg-emerald-50 text-emerald-600 border border-emerald-200'}`;
    messageEl.textContent = text;
    messageEl.classList.remove('hidden');
}

function hideMessage() {
    messageEl.classList.add('hidden');
}

function currentCartItems() {
    return Array.from(cart.values()).map((item) => ({
        product_id: item.id,
        quantity: item.quantity,
        price: item.price,
    }));
}

function currentSubtotal() {
    return Array.from(cart.values()).reduce((sum, item) => sum + (item.quantity * item.price), 0);
}

function openQrisModal() {
    qrisTotalEl.textContent = currency(currentSubtotal());
    qrisMerchantEl.textContent = @json($user->shop?->name ?? 'Toko Anda');
    qrisModal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeQrisModal() {
    qrisModal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function renderCart() {
    const items = Array.from(cart.values());
    cartItemsEl.querySelectorAll('[data-cart-item]').forEach((node) => node.remove());
    document.querySelectorAll('[data-mobile-cart-item]').forEach((node) => node.remove());

    if (!items.length) {
        cartEmptyEl.classList.remove('hidden');
        document.getElementById('mobile-cart-empty').classList.remove('hidden');
    } else {
        cartEmptyEl.classList.add('hidden');
        document.getElementById('mobile-cart-empty').classList.add('hidden');
    }

    let totalQty = 0;
    let subtotal = 0;

    items.forEach((item) => {
        totalQty += item.quantity;
        subtotal += item.quantity * item.price;

        // Desktop cart item
        const row = document.createElement('div');
        row.dataset.cartItem = item.id;
        row.className = 'cart-item flex items-center gap-3 rounded-xl bg-gray-50 p-3';
        row.innerHTML = `
            ${item.image_url
                ? `<img src="${item.image_url}" alt="${item.name}" class="w-11 h-11 rounded-lg object-cover border border-gray-200 shrink-0">`
                : `<div class="w-11 h-11 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-[20px]">shopping_bag</span></div>`
            }
            <div class="flex-1 min-w-0">
                <p class="font-bold text-sm truncate text-on-surface">${item.name}</p>
                <p class="text-xs text-gray-400">${currency(item.price)} × ${item.quantity}</p>
            </div>
            <div class="flex items-center gap-1.5 shrink-0">
                <button type="button" class="cart-decrease w-7 h-7 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors" data-id="${item.id}">
                    <span class="material-symbols-outlined text-[14px]">remove</span>
                </button>
                <span class="w-6 text-center font-bold text-sm">${item.quantity}</span>
                <button type="button" class="cart-increase w-7 h-7 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-emerald-50 hover:text-emerald-500 hover:border-emerald-200 transition-colors" data-id="${item.id}">
                    <span class="material-symbols-outlined text-[14px]">add</span>
                </button>
            </div>
        `;
        cartItemsEl.appendChild(row);

        // Mobile cart item
        const mobileRow = document.createElement('div');
        mobileRow.dataset.mobileCartItem = item.id;
        mobileRow.className = 'cart-item flex items-center gap-3 rounded-xl bg-gray-50 p-3';
        mobileRow.innerHTML = `
            ${item.image_url
                ? `<img src="${item.image_url}" alt="${item.name}" class="w-11 h-11 rounded-lg object-cover border border-gray-200 shrink-0">`
                : `<div class="w-11 h-11 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-[20px]">shopping_bag</span></div>`
            }
            <div class="flex-1 min-w-0">
                <p class="font-bold text-sm truncate text-gray-800">${item.name}</p>
                <p class="text-xs text-gray-400">${currency(item.price)} × ${item.quantity}</p>
            </div>
            <div class="flex items-center gap-1.5 shrink-0">
                <button type="button" class="mobile-cart-decrease w-7 h-7 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors" data-id="${item.id}">
                    <span class="material-symbols-outlined text-[14px]">remove</span>
                </button>
                <span class="w-6 text-center font-bold text-sm">${item.quantity}</span>
                <button type="button" class="mobile-cart-increase w-7 h-7 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-emerald-50 hover:text-emerald-500 hover:border-emerald-200 transition-colors" data-id="${item.id}">
                    <span class="material-symbols-outlined text-[14px]">add</span>
                </button>
            </div>
        `;
        document.getElementById('mobile-cart-items').appendChild(mobileRow);
    });

    const totalItems = items.reduce((sum, item) => sum + item.quantity, 0);
    qtyEl.textContent = `${totalItems} item`;
    subtotalEl.textContent = currency(subtotal);
    totalEl.textContent = currency(subtotal);
    checkoutBtn.disabled = !items.length;

    // Update mobile cart bar
    document.getElementById('mobile-cart-count').textContent = totalItems;
    document.getElementById('mobile-cart-total').textContent = currency(subtotal);
    document.getElementById('mobile-cart-items-label').textContent = totalItems ? `${totalItems} item di keranjang` : 'Keranjang kosong';
    document.getElementById('mobile-checkout-btn').disabled = !items.length;

    // Update mobile cart modal
    document.getElementById('mobile-cart-modal-count').textContent = `${totalItems} item`;
    document.getElementById('mobile-cart-modal-total').textContent = currency(subtotal);
    document.getElementById('mobile-modal-checkout-btn').disabled = !items.length;
}

async function submitCheckout(discountAmount = 0, customerName = '') {
    const items = currentCartItems();
    if (!items.length) {
        showMessage('error', 'Keranjang masih kosong.');
        return;
    }

    closeConfirmModal();
    checkoutBtn.disabled = true;
    checkoutBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">refresh</span> Memproses...';
    document.getElementById('mobile-checkout-btn').disabled = true;
    qrisConfirmBtn.disabled = true;
    qrisConfirmBtn.textContent = 'Memproses...';

    try {
        const response = await fetch('{{ route('pos.checkout') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                payment_method: (confirmPaymentMethod || paymentMethod) === 'e-wallet' ? `e-wallet:${ewalletProvider}:${ewalletNumber}` : (confirmPaymentMethod || paymentMethod),
                discount_amount: discountAmount || 0,
                customer_name: customerName || '',
                items,
            }),
        });

        const result = await response.json();

        if (!response.ok || !result.success) {
            throw new Error(result.message || 'Transaksi gagal disimpan.');
        }

        closeQrisModal();
        cart.clear();
        renderCart();
        showMessage('success', '✅ Transaksi berhasil! Stok & penjualan diperbarui.');
        setTimeout(() => window.location.reload(), 1500);
    } catch (error) {
        showMessage('error', error.message);
    } finally {
        checkoutBtn.disabled = false;
        checkoutBtn.innerHTML = '<span class="material-symbols-outlined">lock</span> Selesaikan Transaksi';
        qrisConfirmBtn.disabled = false;
        qrisConfirmBtn.textContent = 'Sudah Dibayar';
    }
}

function updateCart(productId, delta) {
    const product = products.find((entry) => entry.id === productId);
    if (!product) return;

    const current = cart.get(productId) || { ...product, quantity: 0 };
    const nextQty = current.quantity + delta;

    if (nextQty <= 0) {
        cart.delete(productId);
    } else if (nextQty <= product.stock) {
        cart.set(productId, { ...current, quantity: nextQty });
    } else {
        showMessage('error', `Stok ${product.name} tidak mencukupi.`);
    }

    renderCart();
}

// Mobile cart modal
function openMobileCart() {
    document.getElementById('mobile-cart-modal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}
function closeMobileCart() {
    document.getElementById('mobile-cart-modal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Mobile cart quantity controls
document.getElementById('mobile-cart-items').addEventListener('click', (event) => {
    const decrease = event.target.closest('.mobile-cart-decrease');
    const increase = event.target.closest('.mobile-cart-increase');
    if (decrease) updateCart(Number(decrease.dataset.id), -1);
    if (increase) updateCart(Number(increase.dataset.id), 1);
});

// Add to cart
document.querySelectorAll('[data-add-product]').forEach((button) => {
    button.addEventListener('click', (e) => {
        e.stopPropagation();
        hideMessage();
        updateCart(Number(button.dataset.productId), 1);
    });
});

// Cart quantity controls
cartItemsEl.addEventListener('click', (event) => {
    const decrease = event.target.closest('.cart-decrease');
    const increase = event.target.closest('.cart-increase');
    if (decrease) updateCart(Number(decrease.dataset.id), -1);
    if (increase) updateCart(Number(increase.dataset.id), 1);
});

// Clear cart
document.getElementById('clear-cart').addEventListener('click', () => {
    cart.clear();
    hideMessage();
    renderCart();
});

// Payment methods
document.querySelectorAll('.payment-method').forEach((button) => {
    button.addEventListener('click', () => {
        paymentMethod = button.dataset.payment;
        document.querySelectorAll('.payment-method').forEach((item) => {
            item.className = 'payment-btn payment-method px-3 py-2.5 rounded-xl border border-gray-200 font-bold text-xs flex flex-col items-center gap-1 text-gray-600 hover:border-gray-300';
        });
        button.className = 'payment-btn payment-method px-3 py-2.5 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold text-xs flex flex-col items-center gap-1';

        if (paymentMethod === 'e-wallet') {
            ewalletPicker.classList.remove('hidden');
        } else {
            ewalletPicker.classList.add('hidden');
        }

        if (paymentMethod === 'qris') {
            if (currentCartItems().length) {
                hideMessage();
                openQrisModal();
            } else {
                showMessage('error', 'Tambahkan produk ke keranjang terlebih dahulu.');
            }
            return;
        }

        closeQrisModal();
    });
});

// E-Wallet options
ewalletOptions.forEach((button) => {
    button.addEventListener('click', () => {
        ewalletProvider = button.dataset.ewalletProvider;
        ewalletNumber = button.dataset.ewalletNumber;
        ewalletOptions.forEach((item) => {
            item.className = 'ewallet-option w-full rounded-lg border border-gray-200 px-3 py-2.5 text-left flex items-center gap-3';
            item.querySelector('span:first-child').className = 'block font-bold text-gray-700 text-xs';
        });
        button.className = 'ewallet-option w-full rounded-lg border-2 border-primary bg-primary/5 px-3 py-2.5 text-left flex items-center gap-3';
        button.querySelector('span:first-child').className = 'block font-bold text-primary text-xs';
    });
});

// Search
document.getElementById('product-search').addEventListener('input', (event) => {
    const term = event.target.value.toLowerCase().trim();
    document.querySelectorAll('[data-product-card]').forEach((card) => {
        const name = card.dataset.productName;
        const categoryMatch = activeCategory === 'all' || card.dataset.categoryId === activeCategory;
        const termMatch = !term || name.includes(term);
        card.style.display = categoryMatch && termMatch ? '' : 'none';
    });
});

// Category filter
document.querySelectorAll('.category-filter').forEach((button) => {
    button.addEventListener('click', () => {
        activeCategory = button.dataset.categoryFilter;
        document.querySelectorAll('.category-filter').forEach((item) => {
            item.className = 'category-filter px-4 py-1.5 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-gray-200 transition-all';
        });
        button.className = 'category-filter px-4 py-1.5 rounded-full bg-primary text-white text-xs font-bold transition-all';
        document.getElementById('product-search').dispatchEvent(new Event('input'));
    });
});

// Checkout
checkoutBtn.addEventListener('click', async () => {
    hideMessage();
    const items = currentCartItems();
    if (!items.length) {
        showMessage('error', 'Keranjang masih kosong.');
        return;
    }
    openConfirmModal();
});

// Mobile checkout
document.getElementById('mobile-checkout-btn').addEventListener('click', (e) => {
    e.stopPropagation();
    hideMessage();
    const items = currentCartItems();
    if (!items.length) {
        showMessage('error', 'Keranjang masih kosong.');
        return;
    }
    openConfirmModal();
});

qrisConfirmBtn.addEventListener('click', async () => {
    hideMessage();
    const discount = Math.min(parseFloat(document.getElementById('discount-amount').value) || 0, currentSubtotal());
    await submitCheckout(discount, document.getElementById('customer-name').value);
});

[qrisCloseBtn, qrisCancelBtn, qrisOverlay].forEach((element) => {
    element.addEventListener('click', closeQrisModal);
});

renderCart();
</script>
@endsection
