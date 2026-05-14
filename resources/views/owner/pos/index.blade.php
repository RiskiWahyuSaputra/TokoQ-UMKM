@extends('owner.layouts.app')

@section('title', 'Kasir POS - TokoQ')

@section('styles')
<style>
.qris-pixel:nth-child(1),
.qris-pixel:nth-child(2),
.qris-pixel:nth-child(3),
.qris-pixel:nth-child(5),
.qris-pixel:nth-child(7),
.qris-pixel:nth-child(8),
.qris-pixel:nth-child(9),
.qris-pixel:nth-child(11),
.qris-pixel:nth-child(13),
.qris-pixel:nth-child(15),
.qris-pixel:nth-child(16),
.qris-pixel:nth-child(19),
.qris-pixel:nth-child(20),
.qris-pixel:nth-child(21),
.qris-pixel:nth-child(23),
.qris-pixel:nth-child(25),
.qris-pixel:nth-child(26),
.qris-pixel:nth-child(27),
.qris-pixel:nth-child(29),
.qris-pixel:nth-child(30),
.qris-pixel:nth-child(33),
.qris-pixel:nth-child(35),
.qris-pixel:nth-child(36),
.qris-pixel:nth-child(37),
.qris-pixel:nth-child(39),
.qris-pixel:nth-child(40),
.qris-pixel:nth-child(42),
.qris-pixel:nth-child(43),
.qris-pixel:nth-child(45),
.qris-pixel:nth-child(46),
.qris-pixel:nth-child(48),
.qris-pixel:nth-child(49) {
    background-color: #374151;
}
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

<div class="flex flex-col xl:flex-row gap-6 p-4 lg:p-8 pt-8">
    <section class="flex-1 space-y-6">
        <div class="bg-white rounded-3xl border border-outline-variant p-6 shadow-sm">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-body-sm text-on-surface-variant">Semua produk di bawah ini diambil dari inventori toko Anda secara real-time.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('products.create') }}" class="px-5 py-3 rounded-xl border border-outline-variant font-bold text-on-surface">Tambah Produk</a>
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-4">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input id="product-search" type="text" placeholder="Cari produk..." class="w-full pl-12 pr-4 py-4 bg-white border border-outline-variant rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary outline-none"/>
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
            <div class="bg-white rounded-3xl border border-outline-variant p-16 text-center">
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
                        class="product-card bg-white rounded-3xl border border-outline-variant p-5 shadow-sm"
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
        <div class="bg-white rounded-3xl border border-outline-variant shadow-lg overflow-hidden sticky top-8">
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

            <div class="p-6 border-t border-outline-variant bg-white space-y-5">
                <div>
                    <p class="font-label-caps text-secondary uppercase tracking-widest mb-3">Metode Pembayaran</p>
                    <div class="grid grid-cols-3 gap-2">
                        <button type="button" data-payment="tunai" class="payment-method px-3 py-3 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold">Tunai</button>
                        <button type="button" data-payment="qris" class="payment-method px-3 py-3 rounded-xl border border-outline-variant font-bold">QRIS</button>
                        <button type="button" data-payment="e-wallet" class="payment-method px-3 py-3 rounded-xl border border-outline-variant font-bold">E-Wallet</button>
                    </div>
                    <div id="ewallet-picker" class="hidden mt-4">
                        <p class="block text-body-sm font-bold text-on-surface mb-2">Pilih E-Wallet Tujuan</p>
                        <div class="space-y-2">
                            <button type="button" data-ewallet-provider="dana" data-ewallet-number="085789910963" class="ewallet-option w-full rounded-xl border-2 border-primary bg-primary/5 px-4 py-3 text-left">
                                <span class="block font-bold text-primary">DANA</span>
                                <span class="block text-body-sm text-on-surface-variant">No. 085789910963</span>
                            </button>
                            <button type="button" data-ewallet-provider="gopay" data-ewallet-number="085789910963" class="ewallet-option w-full rounded-xl border border-outline-variant px-4 py-3 text-left">
                                <span class="block font-bold text-on-surface">GoPay</span>
                                <span class="block text-body-sm text-on-surface-variant">No. 085789910963</span>
                            </button>
                            <button type="button" data-ewallet-provider="ovo" data-ewallet-number="085789910963" class="ewallet-option w-full rounded-xl border border-outline-variant px-4 py-3 text-left">
                                <span class="block font-bold text-on-surface">OVO</span>
                                <span class="block text-body-sm text-on-surface-variant">No. 085789910963</span>
                            </button>
                        </div>
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
</div>

<!-- QRIS Modal -->
<div id="qris-modal" class="hidden fixed inset-0 z-[80]">
    <div id="qris-overlay" class="absolute inset-0 bg-[#191d13]/55 backdrop-blur-sm"></div>
    <div class="relative min-h-full flex items-center justify-center p-6">
        <div class="w-full max-w-md rounded-[28px] bg-white border border-outline-variant shadow-2xl overflow-hidden">
            <div class="bg-primary text-on-primary px-6 py-5 flex items-center justify-between">
                <div>
                    <p class="text-label-caps uppercase tracking-widest opacity-80">Metode Pembayaran</p>
                    <h3 class="font-h3 text-h3 font-bold">QRIS</h3>
                </div>
                <button id="qris-close" type="button" class="w-10 h-10 rounded-full bg-white/15 flex items-center justify-center">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <div class="text-center">
                    <p class="text-body-sm text-on-surface-variant">Scan QRIS berikut untuk menyelesaikan pembayaran</p>
                    <p id="qris-merchant" class="font-bold text-primary text-body-lg mt-2">{{ $user->shop?->name ?? 'Toko Anda' }}</p>
                </div>

                <div class="mx-auto w-[240px] rounded-[28px] border border-outline-variant bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-bold text-primary text-body-lg">QRIS</span>
                        <span class="text-body-sm text-on-surface-variant">TokoQ Pay</span>
                    </div>
                    <div class="grid grid-cols-7 gap-1.5 bg-[#f2f5e4] p-4 rounded-2xl">
                        @for ($i = 0; $i < 49; $i++)
                            <span class="qris-pixel aspect-square rounded-[3px] bg-white"></span>
                        @endfor
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-body-sm text-on-surface-variant">Total yang harus dibayar</p>
                        <p id="qris-total" class="font-h3 text-h3 text-primary font-bold">Rp 0</p>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-4">
                    <p class="font-bold text-on-surface mb-2">Langkah Pembayaran</p>
                    <ol class="text-body-sm text-on-surface-variant space-y-1">
                        <li>1. Buka aplikasi e-wallet atau mobile banking.</li>
                        <li>2. Scan QRIS pada layar ini.</li>
                        <li>3. Setelah pembayaran berhasil, klik tombol konfirmasi.</li>
                    </ol>
                </div>

                <div class="flex gap-3">
                    <button id="qris-cancel" type="button" class="flex-1 px-4 py-3 rounded-xl border border-outline-variant font-bold text-on-surface">Batal</button>
                    <button id="qris-confirm" type="button" class="flex-1 px-4 py-3 rounded-xl bg-primary text-on-primary font-bold">Sudah Dibayar</button>
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
const qtyEl = document.getElementById('summary-qty');
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

function showMessage(type, text) {
    messageEl.className = `mx-6 mt-6 rounded-2xl px-4 py-3 text-body-sm ${type === 'error' ? 'bg-error-container text-on-error-container' : 'bg-primary/10 text-primary'}`;
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

async function submitCheckout() {
    const items = currentCartItems();

    if (!items.length) {
        showMessage('error', 'Keranjang masih kosong.');
        return;
    }

    checkoutBtn.disabled = true;
    checkoutBtn.textContent = 'Menyimpan Transaksi...';
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
                payment_method: paymentMethod === 'e-wallet' ? `e-wallet:${ewalletProvider}:${ewalletNumber}` : paymentMethod,
                discount_amount: 0,
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
        showMessage('success', 'Transaksi berhasil disimpan. Stok dan penjualan sudah diperbarui.');
        setTimeout(() => window.location.reload(), 900);
    } catch (error) {
        showMessage('error', error.message);
    } finally {
        checkoutBtn.disabled = false;
        checkoutBtn.textContent = 'Selesaikan Transaksi';
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
                showMessage('error', 'Tambahkan produk ke keranjang terlebih dahulu sebelum membuka QRIS.');
            }
            return;
        }

        closeQrisModal();
    });
});

ewalletOptions.forEach((button) => {
    button.addEventListener('click', () => {
        ewalletProvider = button.dataset.ewalletProvider;
        ewalletNumber = button.dataset.ewalletNumber;

        ewalletOptions.forEach((item) => {
            item.className = 'ewallet-option w-full rounded-xl border border-outline-variant px-4 py-3 text-left';
            item.querySelector('span:first-child').className = 'block font-bold text-on-surface';
            item.querySelector('span:last-child').className = 'block text-body-sm text-on-surface-variant';
        });

        button.className = 'ewallet-option w-full rounded-xl border-2 border-primary bg-primary/5 px-4 py-3 text-left';
        button.querySelector('span:first-child').className = 'block font-bold text-primary';
        button.querySelector('span:last-child').className = 'block text-body-sm text-on-surface-variant';
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
    const items = currentCartItems();

    if (!items.length) {
        showMessage('error', 'Keranjang masih kosong.');
        return;
    }

    if (paymentMethod === 'qris') {
        openQrisModal();
        return;
    }

    await submitCheckout();
});

qrisConfirmBtn.addEventListener('click', async () => {
    hideMessage();
    await submitCheckout();
});

[qrisCloseBtn, qrisCancelBtn, qrisOverlay].forEach((element) => {
    element.addEventListener('click', closeQrisModal);
});

renderCart();
</script>
@endsection
