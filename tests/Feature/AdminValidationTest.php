<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_see_pending_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $owner = User::factory()->create(['role' => 'owner', 'status' => 'pending']);
        Shop::create(['owner_id' => $owner->id, 'name' => 'Test Shop', 'slug' => 'test-shop']);

        $response = $this->actingAs($admin)->get('/admin/validate');

        $response->assertStatus(200);
        $response->assertSee('Test Shop');
    }

    public function test_admin_can_activate_user()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create(['role' => 'admin']);
        $owner = User::factory()->create(['role' => 'owner', 'status' => 'pending']);

        $response = $this->actingAs($admin)->withoutMiddleware()->post('/admin/validate/' . $owner->id);

        $response->assertRedirect();
        $this->assertEquals('active', $owner->fresh()->status);
    }

    public function test_pending_owner_is_blocked_from_dashboard()
    {
        $owner = User::factory()->create(['role' => 'owner', 'status' => 'pending']);
        Shop::create(['owner_id' => $owner->id, 'name' => 'Test Shop', 'slug' => 'test-shop']);

        $response = $this->actingAs($owner)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Akun Menunggu Validasi');
    }

    public function test_active_owner_can_access_dashboard()
    {
        $owner = User::factory()->create(['role' => 'owner', 'status' => 'active']);
        Shop::create(['owner_id' => $owner->id, 'name' => 'Test Shop', 'slug' => 'test-shop']);

        $response = $this->actingAs($owner)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Utama'); // From the template
    }
}
