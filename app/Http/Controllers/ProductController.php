<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $shop = Auth::user()->shop;
        $products = $shop->products()->with('category')->latest()->get();
        $categories = $shop->categories()->orderBy('name')->get();

        $stockSummary = [
            'total' => $products->count(),
            'critical' => $products->where('stock', '<', 5)->count(),
            'low' => $products->whereBetween('stock', [5, 10])->count(),
            'safe' => $products->where('stock', '>', 10)->count(),
            'totalStock' => $products->sum('stock'),
            'inventoryValue' => $products->sum(fn ($product) => $product->price * $product->stock),
            'inventoryCost' => $products->sum(fn ($product) => $product->cost_price * $product->stock),
            'potentialProfit' => $products->sum(fn ($product) => ($product->price - $product->cost_price) * $product->stock),
        ];

        return view('owner.inventory.index', compact('products', 'categories', 'stockSummary'));
    }

    public function create(): View
    {
        $categories = Auth::user()->shop->categories()->orderBy('name')->get();
        return view('owner.inventory.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $shop = Auth::user()->shop;

        $validated = $this->validateProduct($request, $shop->id);

        Product::create([
            'shop_id' => $shop->id,
            ...$validated,
            'image_path' => $this->storeProductImage($request),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        $ownedProduct = $this->ownedProduct($product);
        $categories = Auth::user()->shop->categories()->orderBy('name')->get();

        return view('owner.inventory.edit', [
            'product' => $ownedProduct,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $ownedProduct = $this->ownedProduct($product);
        $validated = $this->validateProduct($request, $ownedProduct->shop_id);

        if ($request->hasFile('image')) {
            if ($ownedProduct->image_path) {
                Storage::disk('public')->delete($ownedProduct->image_path);
            }

            $validated['image_path'] = $this->storeProductImage($request);
        }

        $ownedProduct->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $ownedProduct = $this->ownedProduct($product);

        if ($ownedProduct->image_path) {
            Storage::disk('public')->delete($ownedProduct->image_path);
        }

        $ownedProduct->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    protected function ownedProduct(Product $product): Product
    {
        abort_unless($product->shop_id === Auth::user()->shop->id, 404);

        return $product;
    }

    protected function validateProduct(Request $request, int $shopId): array
    {
        return $request->validate([
            'category_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where(fn ($query) => $query->where('shop_id', $shopId)),
            ],
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }

    protected function storeProductImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        return $request->file('image')->store('products', 'public');
    }
}
