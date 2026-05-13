<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PosTest extends TestCase
{
    use RefreshDatabase;

    protected $owner;
    protected $shop;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->owner = User::factory()->create(['role' => 'owner', 'status' => 'active']);
        $this->shop = Shop::create(['owner_id' => $this->owner->id, 'name' => 'Test Shop', 'slug' => 'test-shop']);
        $this->product = Product::create([
            'shop_id' => $this->shop->id,
            'name' => 'Kopi',
            'price' => 5000,
            'stock' => 10
        ]);
    }

    public function test_pos_screen_renders_with_products()
    {
        $response = $this->actingAs($this->owner)->get('/pos');

        $response->assertStatus(200);
        $response->assertSee('Kopi');
    }

    public function test_owner_can_checkout_successfully()
    {
        $response = $this->actingAs($this->owner)->withoutMiddleware()->post('/pos/checkout', [
            'payment_method' => 'tunai',
            'discount_amount' => 0,
            'items' => [
                [
                    'product_id' => $this->product->id,
                    'quantity' => 2,
                    'price' => 5000,
                ]
            ]
        ]);

        $response->assertJson(['success' => true]);
        
        $this->assertCount(1, Transaction::all());
        $transaction = Transaction::first();
        $this->assertEquals(10000, $transaction->net_amount);
        $this->assertCount(1, $transaction->items);
        
        // Verify stock decreased
        $this->assertEquals(8, $this->product->fresh()->stock);
    }

    public function test_checkout_fails_if_stock_insufficient()
    {
        $response = $this->actingAs($this->owner)->withoutMiddleware()->post('/pos/checkout', [
            'payment_method' => 'tunai',
            'items' => [
                [
                    'product_id' => $this->product->id,
                    'quantity' => 11,
                    'price' => 5000,
                ]
            ]
        ]);

        $response->assertJson(['success' => false]);
        $this->assertCount(0, Transaction::all());
    }
}
