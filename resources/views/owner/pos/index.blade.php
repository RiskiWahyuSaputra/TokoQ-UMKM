<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<title>Kasir POS - TokoQ</title>
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
<body class="bg-background text-on-surface font-body-md">
@include('owner.layouts.sidebar', ['activeMenu' => 'pos'])

@php
    $user = Auth::user();
    $initials = collect(explode(' ', trim($user->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
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

<main class="ml-64 min-h-screen flex flex-col xl:flex-row gap-6 p-8">
    <section class="flex-1 space-y-6">
        <div class="bg-surface-container-lowest rounded-3xl border border-outline-variant p-6 shadow-sm">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="font-h3 text-h3 text-primary font-bold">Kasir POS</h1>
                    <p class="text-body-sm text-on-surface-variant">Semua produk di bawah ini diambil dari inventori toko Anda secara real-time.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('products.create') }}" class="px-5 py-3 rounded-xl border border-outline-variant font-bold text-on-surface">Tambah Produk</a>
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden md:block">
                            <p class="font-bold text-primary">{{ $user->name }}</p>
                            <p class="text-body-sm text-on-surface-variant">{{ $user->shop?->name ?? 'Toko Anda' }}</p>
                        </div>
                        <div class="w-11 h-11 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold">{{ $initials }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-4">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input id="product-search" type="text" placeholder="Cari produk..." class="w-full pl-12 pr-4 py-4 bg-surface-container-low border border-outline-variant rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary outline-none"/>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" data-category-filter="all" class="category-filter px-4 py-2 rounded-full bg-primary text-on-primary font-bold">Semua</button>
                    @foreach ($categories as $category)
                        <button type="button" data-category-filter="{{ $category->id }}" class="category-filter px-4 py-2 rounded-full bg-secondary-container text-on-secondary-container font-medium">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        @if ($products->isEmpty())
            <div class="bg-surface-container-lowest rounded-3xl border border-outline-variant p-16 text-center">
                <span class="material-symbols-outlined text-[56px] text-primary mb-4 block">point_of_sale</span>
                <h2 class="font-h3 text-h3 text-primary mb-3">POS belum punya produk</h2>
                <p class="text-body-sm text-on-surface-variant max-w-md mx-auto mb-6">Tambahkan produk terlebih dahulu agar kasir bisa digunakan untuk transaksi nyata.</p>
                <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-xl font-bold">
                    <span class="material-symbols-outlined">add</span>
                    Isi Produk Sekarang
                </a>
            </div>
        @else
            <div id="product-grid" class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    @php
                        $statusClass = match ($product->status) {
                            'kritis' => 'bg-error-container text-on-error-container',
                            'menipis' => 'bg-amber-100 text-amber-800',
                            default => 'bg-primary-fixed text-primary',
                        };
                    @endphp
                    <article
                        class="product-card bg-surface-container-lowest rounded-3xl border border-outline-variant p-5 shadow-sm"
                        data-product-card
                        data-product-id="{{ $product->id }}"
                        data-product-name="{{ strtolower($product->name) }}"
                        data-category-id="{{ $product->category_id ?? '' }}"
                        data-stock="{{ $product->stock }}"
                        data-price="{{ $product->price }}"
                    >
                        <div class="flex items-start justify-between gap-4 mb-4">
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-16 h-16 rounded-2xl object-cover border border-outline-variant">
                            @else
                                <div class="w-16 h-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined">inventory_2</span>
                                </div>
                            @endif
                            <span class="px-3 py-1 rounded-full text-body-sm font-bold {{ $statusClass }}">{{ ucfirst($product->status) }}</span>
                        </div>
                        <h3 class="font-bold text-body-lg text-on-surface">{{ $product->name }}</h3>
                        <p class="text-body-sm text-on-surface-variant mt-1">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>
                        <div class="mt-5 flex items-end justify-between gap-4">
                            <div>
                                <p class="font-bold text-primary text-body-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-body-sm text-on-surface-variant">Stok: {{ $product->stock }}</p>
                            </div>
                            <button
                                type="button"
                                class="add-to-cart px-4 py-3 rounded-xl bg-secondary-container text-on-secondary-container font-bold flex items-center gap-2 disabled:opacity-50"
                                data-add-product
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-price="{{ $product->price }}"
                                data-product-stock="{{ $product->stock }}"
                                @disabled($product->stock < 1)
                            >
                                <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                                {{ $product->stock < 1 ? 'Habis' : 'Tambah' }}
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <aside class="w-full xl:w-[26rem] shrink-0">
        <div class="bg-surface-container-lowest rounded-3xl border border-outline-variant shadow-lg overflow-hidden sticky top-8">
            <div class="p-6 border-b border-outline-variant flex items-center justify-between">
                <div>
                    <h2 class="font-h3 text-h3 text-primary">Keranjang</h2>
                    <p class="text-body-sm text-on-surface-variant">Transaksi nyata dari toko Anda.</p>
                </div>
                <button id="clear-cart" type="button" class="text-error font-bold text-body-sm">Hapus Semua</button>
            </div>

            <div id="checkout-message" class="hidden mx-6 mt-6 rounded-2xl px-4 py-3 text-body-sm"></div>

            <div id="cart-items" class="max-h-[420px] overflow-y-auto px-6 py-6 space-y-4">
                <div id="cart-empty" class="text-center text-on-surface-variant py-14">
                    <span class="material-symbols-outlined text-[52px] mb-3 block">shopping_basket</span>
                    <p>Keranjang masih kosong.</p>
                </div>
            </div>

            <div class="p-6 border-t border-outline-variant bg-surface-container-low space-y-5">
                <div>
                    <p class="font-label-caps text-secondary uppercase tracking-widest mb-3">Metode Pembayaran</p>
                    <div class="grid grid-cols-3 gap-2">
                        <button type="button" data-payment="tunai" class="payment-method px-3 py-3 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold">Tunai</button>
                        <button type="button" data-payment="qris" class="payment-method px-3 py-3 rounded-xl border border-outline-variant font-bold">QRIS</button>
                        <button type="button" data-payment="e-wallet" class="payment-method px-3 py-3 rounded-xl border border-outline-variant font-bold">E-Wallet</button>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between text-body-sm text-on-surface-variant">
                        <span>Jumlah Item</span>
                        <span id="summary-qty">0</span>
                    </div>
                    <div class="flex justify-between text-body-sm text-on-surface-variant">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-end pt-2">
                        <span class="font-bold text-body-lg text-on-surface">Total Bayar</span>
                        <span id="summary-total" class="font-h3 text-h3 text-primary">Rp 0</span>
                    </div>
                </div>

                <button id="checkout-button" type="button" class="w-full py-4 rounded-2xl bg-primary text-on-primary font-bold text-body-lg disabled:opacity-50 disabled:cursor-not-allowed">
                    Selesaikan Transaksi
                </button>
            </div>
        </div>
    </aside>
</main>

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
const qtyEl = document.getElementById('summary-qty');
const checkoutBtn = document.getElementById('checkout-button');
const messageEl = document.getElementById('checkout-message');

function showMessage(type, text) {
    messageEl.className = `mx-6 mt-6 rounded-2xl px-4 py-3 text-body-sm ${type === 'error' ? 'bg-error-container text-on-error-container' : 'bg-primary/10 text-primary'}`;
    messageEl.textContent = text;
    messageEl.classList.remove('hidden');
}

function hideMessage() {
    messageEl.classList.add('hidden');
}

function renderCart() {
    const items = Array.from(cart.values());
    cartItemsEl.querySelectorAll('[data-cart-item]').forEach((node) => node.remove());

    if (!items.length) {
        cartEmptyEl.classList.remove('hidden');
    } else {
        cartEmptyEl.classList.add('hidden');
    }

    let totalQty = 0;
    let subtotal = 0;

    items.forEach((item) => {
        totalQty += item.quantity;
        subtotal += item.quantity * item.price;

        const row = document.createElement('div');
        row.dataset.cartItem = item.id;
        row.className = 'flex items-center gap-4 rounded-2xl bg-surface px-4 py-4';
        row.innerHTML = `
            ${item.image_url
                ? `<img src="${item.image_url}" alt="${item.name}" class="w-12 h-12 rounded-xl object-cover border border-outline-variant shrink-0">`
                : `<div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0"><span class="material-symbols-outlined">shopping_bag</span></div>`
            }
            <div class="flex-1 min-w-0">
                <p class="font-bold truncate">${item.name}</p>
                <p class="text-body-sm text-on-surface-variant">${currency(item.price)} x ${item.quantity}</p>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" class="cart-decrease w-8 h-8 rounded-lg border border-outline-variant" data-id="${item.id}">-</button>
                <span class="w-6 text-center font-bold">${item.quantity}</span>
                <button type="button" class="cart-increase w-8 h-8 rounded-lg border border-outline-variant" data-id="${item.id}">+</button>
            </div>
        `;
        cartItemsEl.appendChild(row);
    });

    qtyEl.textContent = totalQty;
    subtotalEl.textContent = currency(subtotal);
    totalEl.textContent = currency(subtotal);
    checkoutBtn.disabled = !items.length;
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

document.querySelectorAll('[data-add-product]').forEach((button) => {
    button.addEventListener('click', () => {
        hideMessage();
        updateCart(Number(button.dataset.productId), 1);
    });
});

cartItemsEl.addEventListener('click', (event) => {
    const decrease = event.target.closest('.cart-decrease');
    const increase = event.target.closest('.cart-increase');

    if (decrease) {
        updateCart(Number(decrease.dataset.id), -1);
    }

    if (increase) {
        updateCart(Number(increase.dataset.id), 1);
    }
});

document.getElementById('clear-cart').addEventListener('click', () => {
    cart.clear();
    hideMessage();
    renderCart();
});

document.querySelectorAll('.payment-method').forEach((button) => {
    button.addEventListener('click', () => {
        paymentMethod = button.dataset.payment;
        document.querySelectorAll('.payment-method').forEach((item) => {
            item.className = 'payment-method px-3 py-3 rounded-xl border border-outline-variant font-bold';
        });
        button.className = 'payment-method px-3 py-3 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold';
    });
});

document.getElementById('product-search').addEventListener('input', (event) => {
    const term = event.target.value.toLowerCase().trim();
    document.querySelectorAll('[data-product-card]').forEach((card) => {
        const name = card.dataset.productName;
        const categoryMatch = activeCategory === 'all' || card.dataset.categoryId === activeCategory;
        const termMatch = !term || name.includes(term);
        card.style.display = categoryMatch && termMatch ? '' : 'none';
    });
});

document.querySelectorAll('.category-filter').forEach((button) => {
    button.addEventListener('click', () => {
        activeCategory = button.dataset.categoryFilter;
        document.querySelectorAll('.category-filter').forEach((item) => {
            item.className = 'category-filter px-4 py-2 rounded-full bg-secondary-container text-on-secondary-container font-medium';
        });
        button.className = 'category-filter px-4 py-2 rounded-full bg-primary text-on-primary font-bold';
        document.getElementById('product-search').dispatchEvent(new Event('input'));
    });
});

checkoutBtn.addEventListener('click', async () => {
    hideMessage();
    const items = Array.from(cart.values()).map((item) => ({
        product_id: item.id,
        quantity: item.quantity,
        price: item.price,
    }));

    if (!items.length) {
        showMessage('error', 'Keranjang masih kosong.');
        return;
    }

    checkoutBtn.disabled = true;
    checkoutBtn.textContent = 'Menyimpan Transaksi...';

    try {
        const response = await fetch('{{ route('pos.checkout') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                payment_method: paymentMethod,
                discount_amount: 0,
                items,
            }),
        });

        const result = await response.json();

        if (!response.ok || !result.success) {
            throw new Error(result.message || 'Transaksi gagal disimpan.');
        }

        cart.clear();
        renderCart();
        showMessage('success', 'Transaksi berhasil disimpan. Stok dan penjualan sudah diperbarui.');
        setTimeout(() => window.location.reload(), 900);
    } catch (error) {
        showMessage('error', error.message);
    } finally {
        checkoutBtn.disabled = false;
        checkoutBtn.textContent = 'Selesaikan Transaksi';
    }
});

renderCart();
</script>
</body>
</html>
