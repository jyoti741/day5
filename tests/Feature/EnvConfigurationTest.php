<?php

namespace Tests\Feature;

use App\Livewire\TaskTracker;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EnvConfigurationTest extends TestCase
{
    use RefreshDatabase;

    public function test_env_example_and_current_env_contain_required_configuration_keys(): void
    {
        $envExample = file_get_contents(base_path('.env.example'));
        $this->assertStringContainsString('OFFICE_APP_NAME=', $envExample);
        $this->assertStringContainsString('COMPANY_NAME=', $envExample);
        $this->assertStringContainsString('COMPANY_EMAIL=', $envExample);
        $this->assertStringContainsString('TASKS_PER_PAGE=', $envExample);
        $this->assertStringContainsString('ENABLE_TASK_EXPORT=', $envExample);

        $env = file_get_contents(base_path('.env'));
        $this->assertStringContainsString('OFFICE_APP_NAME=', $env);
        $this->assertStringContainsString('COMPANY_NAME=', $env);
        $this->assertStringContainsString('COMPANY_EMAIL=', $env);
        $this->assertStringContainsString('TASKS_PER_PAGE=', $env);
        $this->assertStringContainsString('ENABLE_TASK_EXPORT=', $env);
    }

    public function test_config_reads_default_or_environment_values(): void
    {
        $this->assertEquals('ASTGD Task Tracker', config('office.app_name'));
        $this->assertEquals('ASTGD', config('office.company_name'));
        $this->assertEquals('office@example.com', config('office.company_email'));
        $this->assertEquals(10, config('office.tasks_per_page'));
        $this->assertTrue(config('office.enable_task_export'));
    }

    public function test_application_name_dynamically_updates_page_title_and_navbar(): void
    {
        $user = User::factory()->create();

        config([
            'office.app_name' => 'Acme Super Tracker',
            'app.name' => 'Acme Super Tracker',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertOk();
        $response->assertSee('Acme Super Tracker');
        $response->assertSee('<title>', false);
        $response->assertSee('Acme Super Tracker', false);

        $tasksResponse = $this->actingAs($user)->get(route('tasks'));
        $tasksResponse->assertOk();
        $tasksResponse->assertSee('Acme Super Tracker');

        $welcomeResponse = $this->get(route('home'));
        $welcomeResponse->assertOk();
        $welcomeResponse->assertSee('Acme Super Tracker');
    }

    public function test_company_name_and_email_dynamically_appear_in_dashboard_and_footer(): void
    {
        $user = User::factory()->create();

        config([
            'office.company_name' => 'Nexus Dynamics',
            'office.company_email' => 'support@nexusdynamics.io',
        ]);

        // Dashboard view
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertOk();
        $response->assertSee('Nexus Dynamics Office Dashboard');
        $response->assertSee('Nexus Dynamics');
        $response->assertSee('support@nexusdynamics.io');
        $response->assertSee('mailto:support@nexusdynamics.io', false);

        // Tasks view
        $tasksResponse = $this->actingAs($user)->get(route('tasks'));
        $tasksResponse->assertOk();
        $tasksResponse->assertSee('Nexus Dynamics Task Management System');
        $tasksResponse->assertSee('Nexus Dynamics');
        $tasksResponse->assertSee('support@nexusdynamics.io');

        // Welcome / Landing view
        $welcomeResponse = $this->get(route('home'));
        $welcomeResponse->assertOk();
        $welcomeResponse->assertSee('Nexus Dynamics');
        $welcomeResponse->assertSee('support@nexusdynamics.io');
    }

    public function test_tasks_per_page_controls_pagination_dynamically(): void
    {
        $user = User::factory()->create();

        // Create 25 tasks
        for ($i = 1; $i <= 25; $i++) {
            Task::create([
                'title' => "Task #{$i} - Office Work",
                'description' => "Description for task #{$i}",
                'user_id' => $user->id,
                'priority' => 'medium',
                'status' => 'pending',
                'due_date' => now()->addDays($i)->format('Y-m-d'),
            ]);
        }

        // Test with 5 tasks per page
        config(['office.tasks_per_page' => 5]);

        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->assertViewHas('tasks', function ($tasks) {
                return $tasks->perPage() === 5 && $tasks->count() === 5 && $tasks->total() === 25;
            });

        // Test with 20 tasks per page
        config(['office.tasks_per_page' => 20]);

        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->assertViewHas('tasks', function ($tasks) {
                return $tasks->perPage() === 20 && $tasks->count() === 20 && $tasks->total() === 25;
            });

        // Test with 10 tasks per page
        config(['office.tasks_per_page' => 10]);

        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->assertViewHas('tasks', function ($tasks) {
                return $tasks->perPage() === 10 && $tasks->count() === 10 && $tasks->total() === 25;
            });
    }

    public function test_environment_indicator_displayed_in_development_and_hidden_in_production(): void
    {
        $user = User::factory()->create();

        // 1. Development environment
        $this->app['env'] = 'development';
        $devResponse = $this->actingAs($user)->get(route('dashboard'));
        $devResponse->assertOk();
        $devResponse->assertSee('Environment: Development');

        // 2. Local environment (also mapped to Development)
        $this->app['env'] = 'local';
        $localResponse = $this->actingAs($user)->get(route('dashboard'));
        $localResponse->assertOk();
        $localResponse->assertSee('Environment: Development');

        // 3. Production environment (must NOT show indicator)
        $this->app['env'] = 'production';
        $prodResponse = $this->actingAs($user)->get(route('dashboard'));
        $prodResponse->assertOk();
        $prodResponse->assertDontSee('Environment:');
        $prodResponse->assertDontSee('Environment: Production');
        $prodResponse->assertDontSee('Environment: Development');
    }
}
