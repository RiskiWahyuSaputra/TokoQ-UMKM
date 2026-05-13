<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected $owner;
    protected $shop;

    protected function setUp(): void
    {
        parent::setUp();
        $this->owner = User::factory()->create(['role' => 'owner', 'status' => 'active']);
        $this->shop = Shop::create(['owner_id' => $this->owner->id, 'name' => 'Test Shop', 'slug' => 'test-shop']);
        
        Carbon::setTestNow(Carbon::create(2026, 5, 13, 10, 0, 0));

        // Create some data
        $product = Product::create([
            'shop_id' => $this->shop->id,
            'name' => 'Kopi',
            'price' => 5000,
            'stock' => 100
        ]);

        // Today's transaction
        $t1 = Transaction::create([
            'shop_id' => $this->shop->id,
            'total_amount' => 10000,
            'net_amount' => 10000,
            'payment_method' => 'tunai',
            'created_at' => Carbon::now()
        ]);
        TransactionItem::create(['transaction_id' => $t1->id, 'product_id' => $product->id, 'quantity' => 2, 'price_at_sale' => 5000]);

        // Yesterday's transaction
        $t2 = Transaction::create([
            'shop_id' => $this->shop->id,
            'total_amount' => 20000,
            'net_amount' => 20000,
            'payment_method' => 'qris',
            'created_at' => Carbon::yesterday()
        ]);
        $t2->created_at = Carbon::yesterday();
        $t2->save();
        
        TransactionItem::create(['transaction_id' => $t2->id, 'product_id' => $product->id, 'quantity' => 4, 'price_at_sale' => 5000]);
    }

    public function test_dashboard_renders_with_correct_metrics()
    {
        $response = $this->actingAs($this->owner)->get('/dashboard');

        $response->assertStatus(200);
        
        // Check for today's omzet
        $response->assertSee('Rp 10.000'); 
        
        // Check for transaction count
        $response->assertSee('1'); 
    }
}
