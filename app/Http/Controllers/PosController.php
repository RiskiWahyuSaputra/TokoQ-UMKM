<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PosController extends Controller
{
    public function index()
    {
        $shop = Auth::user()->shop;
        $products = $shop->products()->with('category')->orderBy('name')->get();
        $categories = $shop->categories()->orderBy('name')->get();
        return view('owner.pos.index', compact('products', 'categories'));
    }

    public function checkout(Request $request)
    {
        $shop = Auth::user()->shop;

        $request->validate([
            'payment_method' => 'required|string',
            'discount_amount' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => [
                'required',
                Rule::exists('products', 'id')->where(fn ($query) => $query->where('shop_id', $shop->id)),
            ],
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
        ]);

        return DB::transaction(function () use ($request) {
            $shop = Auth::user()->shop;
            $totalAmount = 0;

            foreach ($request->items as $item) {
                $product = Product::where('shop_id', $shop->id)->lockForUpdate()->find($item['product_id']);
                
                if (! $product) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Produk tidak ditemukan untuk toko ini.'
                    ], 422);
                }

                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok tidak mencukupi untuk ' . $product->name
                    ], 422);
                }

                $totalAmount += $item['price'] * $item['quantity'];
            }

            $discount = $request->discount_amount ?? 0;
            $netAmount = $totalAmount - $discount;

            $transaction = Transaction::create([
                'shop_id' => $shop->id,
                'total_amount' => $totalAmount,
                'discount_amount' => $discount,
                'net_amount' => $netAmount,
                'payment_method' => $request->payment_method,
            ]);

            foreach ($request->items as $item) {
                $product = Product::where('shop_id', $shop->id)->find($item['product_id']);
                
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_at_sale' => $item['price'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            return response()->json([
                'success' => true,
                'transaction_id' => $transaction->id,
                'message' => 'Transaksi berhasil disimpan.'
            ]);
        });
    }
}
