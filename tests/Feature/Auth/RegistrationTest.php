<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'shop_name' => 'Test Shop',
        ]);

        $this->assertAuthenticated();
        
        $user = User::first();
        $this->assertEquals('owner', $user->role);
        $this->assertEquals('pending', $user->status);

        $this->assertCount(1, Shop::all());
        $this->assertEquals('Test Shop', $user->shop->name);

        $response->assertRedirect('/dashboard');
    }
}
