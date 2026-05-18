<?php

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_update_shop_logo_from_shop_profile_form(): void
    {
        Storage::fake('public');

        $owner = User::factory()->create(['role' => 'owner', 'status' => 'active']);
        $shop = Shop::create([
            'owner_id' => $owner->id,
            'name' => 'Test Shop',
            'slug' => 'test-shop',
            'description' => 'Old description',
            'address' => 'Old address',
        ]);

        $response = $this->actingAs($owner)->post('/settings', [
            'shop_name' => 'Test Shop Baru',
            'shop_description' => 'Deskripsi baru',
            'shop_address' => 'Alamat baru',
            'shop_logo' => UploadedFile::fake()->image('logo.png'),
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $shop->refresh();

        $this->assertSame('Test Shop Baru', $shop->name);
        $this->assertNotNull($shop->logo_path);
        Storage::disk('public')->assertExists($shop->logo_path);
    }
}
