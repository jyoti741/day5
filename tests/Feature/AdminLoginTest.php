<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_is_admin_attribute_and_is_admin_helper_method(): void
    {
        $regularUser = User::factory()->create(['is_admin' => false]);
        $adminUser = User::factory()->create(['is_admin' => true]);

        $this->assertFalse($regularUser->isAdmin());
        $this->assertTrue($adminUser->isAdmin());
    }

    public function test_admin_login_portal_view_renders_successfully(): void
    {
        $response = $this->get('/login?portal=admin');

        $response->assertStatus(200);
        $response->assertSee('Admin Portal');
        $response->assertSee('Administrator Control Portal');
        $response->assertSee('Quick Fill Admin Credentials (admin@astgd.com)');
    }

    public function test_welcome_page_contains_admin_login_link(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Admin Login');
    }

    public function test_administrator_can_authenticate_using_login_form(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@astgd.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@astgd.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect('/dashboard');
    }

    public function test_admin_badge_renders_in_navigation_menu_for_admin_users(): void
    {
        $admin = User::factory()->create([
            'name' => 'Root Admin',
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('🛡️ Admin');
    }

    public function test_admin_badge_does_not_render_for_regular_staff(): void
    {
        $staff = User::factory()->create([
            'name' => 'Regular Staff',
            'is_admin' => false,
        ]);

        $response = $this->actingAs($staff)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertDontSee('🛡️ Admin');
    }
}
