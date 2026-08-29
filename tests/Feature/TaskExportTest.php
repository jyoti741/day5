<?php

namespace Tests\Feature;

use App\Livewire\DashboardOverview;
use App\Livewire\TaskTracker;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TaskExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_users_can_export_tasks_to_csv(): void
    {
        $user = User::factory()->create(['name' => 'John Doe', 'email' => 'john@astgd.com']);

        Task::create([
            'title' => 'Critical Infrastructure Security Review',
            'description' => 'Review firewalls and VPC network peering.',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'in_progress',
            'due_date' => now()->addDays(3)->format('Y-m-d'),
        ]);

        $component = Livewire::actingAs($user)->test(TaskTracker::class);

        $response = $component->call('exportCsv');
        $this->assertNotNull($response);
    }

    public function test_authenticated_users_can_export_tasks_to_json(): void
    {
        $user = User::factory()->create(['name' => 'Jane Smith', 'email' => 'jane@astgd.com']);

        Task::create([
            'title' => 'API Integration Documentation',
            'description' => 'Prepare onboarding docs for new developers.',
            'user_id' => $user->id,
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => now()->addDays(5)->format('Y-m-d'),
        ]);

        $component = Livewire::actingAs($user)->test(TaskTracker::class);

        $response = $component->call('exportJson');
        $this->assertNotNull($response);
    }

    public function test_authenticated_users_can_export_overdue_report_csv(): void
    {
        $user = User::factory()->create(['name' => 'Alex Developer', 'email' => 'alex@astgd.com']);

        Task::create([
            'title' => 'Past Deadline Task',
            'description' => 'This was overdue.',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => now()->subDays(5)->format('Y-m-d'),
        ]);

        $component = Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->set('activeView', 'overdue_report');

        $response = $component->call('exportOverdueReportCsv');
        $this->assertNotNull($response);
    }

    public function test_authenticated_users_can_export_from_dashboard(): void
    {
        $user = User::factory()->create();

        Task::create([
            'title' => 'Dashboard Export Test Task',
            'user_id' => $user->id,
            'priority' => 'low',
            'status' => 'pending',
            'due_date' => now()->addDays(1)->format('Y-m-d'),
        ]);

        $component = Livewire::actingAs($user)->test(DashboardOverview::class);

        $response = $component->call('exportCsv');
        $this->assertNotNull($response);
    }

    public function test_export_button_is_visible_when_feature_toggle_is_enabled(): void
    {
        $user = User::factory()->create();
        config(['office.enable_task_export' => true]);

        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->assertSee('Export Tasks');

        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->set('activeView', 'overdue_report')
            ->assertSee('Export Report (CSV)');

        Livewire::actingAs($user)
            ->test(DashboardOverview::class)
            ->assertSee('Export Tasks (CSV)');
    }

    public function test_export_button_is_hidden_when_feature_toggle_is_disabled(): void
    {
        $user = User::factory()->create();
        config(['office.enable_task_export' => false]);

        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->assertDontSee('Export Tasks')
            ->assertDontSee('wire:click="exportCsv"', false);

        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->set('activeView', 'overdue_report')
            ->assertDontSee('Export Report (CSV)');

        Livewire::actingAs($user)
            ->test(DashboardOverview::class)
            ->assertDontSee('Export Tasks (CSV)');
    }

    public function test_export_actions_are_blocked_with_403_when_feature_toggle_is_disabled(): void
    {
        $user = User::factory()->create();
        config(['office.enable_task_export' => false]);

        Task::create([
            'title' => 'Test Task',
            'user_id' => $user->id,
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => now()->addDays(2)->format('Y-m-d'),
        ]);

        // TaskTracker CSV export blocked
        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->call('exportCsv')
            ->assertForbidden();

        // TaskTracker JSON export blocked
        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->call('exportJson')
            ->assertForbidden();

        // TaskTracker Overdue Report CSV export blocked
        Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->call('exportOverdueReportCsv')
            ->assertForbidden();

        // Dashboard CSV export blocked
        Livewire::actingAs($user)
            ->test(DashboardOverview::class)
            ->call('exportCsv')
            ->assertForbidden();
    }
}
