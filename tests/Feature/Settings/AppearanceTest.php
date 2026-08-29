<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppearanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_appearance_page_is_displayed(): void
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->get(route('appearance.edit'));

        $response->assertOk();
        $response->assertSee('Theme & Appearance');
        $response->assertSee('Bright');
        $response->assertSee('Dark');
    }

    public function test_navbar_and_sidebar_contain_bright_and_dark_theme_switcher(): void
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Bright');
        $response->assertSee('Dark');
    }
}
