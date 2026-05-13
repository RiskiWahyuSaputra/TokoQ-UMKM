<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;

    protected $owner;
    protected $shop;

    protected function setUp(): void
    {
        parent::setUp();
        $this->owner = User::factory()->create(['role' => 'owner', 'status' => 'active']);
        $this->shop = Shop::create(['owner_id' => $this->owner->id, 'name' => 'Test Shop', 'slug' => 'test-shop']);
    }

    public function test_owner_can_create_category()
    {
        $response = $this->actingAs($this->owner)->withoutMiddleware()->post('/categories', [
            'name' => 'Minuman',
        ]);

        $response->assertStatus(302);
        $this->assertCount(1, Category::all());
        $this->assertEquals($this->shop->id, Category::first()->shop_id);
    }

    public function test_owner_can_create_product_with_status_logic()
    {
        $category = Category::create(['shop_id' => $this->shop->id, 'name' => 'Sembako']);

        $response = $this->actingAs($this->owner)->withoutMiddleware()->post('/products', [
            'category_id' => $category->id,
            'name' => 'Beras 5kg',
            'sku' => 'BR-001',
            'price' => 75000,
            'stock' => 15,
        ]);

        $response->assertStatus(302);
        $product = Product::first();
        $this->assertEquals('aman', $product->status);

        // Test status menipis
        $product->update(['stock' => 8]);
        $this->assertEquals('menipis', $product->status);

        // Test status kritis
        $product->update(['stock' => 3]);
        $this->assertEquals('kritis', $product->status);
    }

    public function test_owner_cannot_see_others_products()
    {
        $otherOwner = User::factory()->create(['role' => 'owner', 'status' => 'active']);
        $otherShop = Shop::create(['owner_id' => $otherOwner->id, 'name' => 'Other Shop', 'slug' => 'other-shop']);
        Product::create([
            'shop_id' => $otherShop->id,
            'name' => 'Other Product',
            'price' => 100,
            'stock' => 10
        ]);

        $response = $this->actingAs($this->owner)->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee('Other Product');
    }
}
