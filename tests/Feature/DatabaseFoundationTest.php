<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseFoundationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_have_a_shop()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $shop = Shop::create([
            'owner_id' => $user->id,
            'name' => 'Toko Saya',
            'slug' => 'toko-saya',
        ]);

        $this->assertEquals('Toko Saya', $user->shop->name);
    }

    public function test_shop_can_have_categories_and_products()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $shop = Shop::create([
            'owner_id' => $user->id,
            'name' => 'Toko Saya',
            'slug' => 'toko-saya',
        ]);

        $category = Category::create([
            'shop_id' => $shop->id,
            'name' => 'Elektronik',
        ]);

        $product = Product::create([
            'shop_id' => $shop->id,
            'category_id' => $category->id,
            'name' => 'Laptop',
            'sku' => 'LP-001',
            'price' => 10000000,
            'stock' => 15,
        ]);

        $this->assertCount(1, $shop->categories);
        $this->assertCount(1, $shop->products);
        $this->assertEquals('aman', $product->status);
    }

    public function test_product_status_logic()
    {
        $product = new Product(['stock' => 15]);
        $this->assertEquals('aman', $product->status);

        $product->stock = 8;
        $this->assertEquals('menipis', $product->status);

        $product->stock = 3;
        $this->assertEquals('kritis', $product->status);
    }

    public function test_shop_can_have_transactions_with_items()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $shop = Shop::create([
            'owner_id' => $user->id,
            'name' => 'Toko Saya',
            'slug' => 'toko-saya',
        ]);

        $transaction = Transaction::create([
            'shop_id' => $shop->id,
            'total_amount' => 100000,
            'discount_amount' => 0,
            'net_amount' => 100000,
            'payment_method' => 'tunai',
        ]);

        $product = Product::create([
            'shop_id' => $shop->id,
            'name' => 'Kopi',
            'sku' => 'KP-001',
            'price' => 50000,
            'stock' => 20,
        ]);

        $item = TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price_at_sale' => 50000,
        ]);

        $this->assertCount(1, $shop->transactions);
        $this->assertCount(1, $transaction->items);
        $this->assertEquals(2, $transaction->items->first()->quantity);
    }
}
