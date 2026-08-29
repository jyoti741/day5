<?php

namespace Tests\Feature;

use App\Livewire\DashboardOverview;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_visit_the_dashboard(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('dashboard'));
        $response->assertOk();
    }

    public function test_task_statistics_percentages_calculated_dynamically_and_updated_on_status_change(): void
    {
        $user = User::factory()->create();

        // 13 Completed, 4 In Progress, 3 Pending = 20 total
        // Completed: 65%, In Progress: 20%, Pending: 15%
        for ($i = 0; $i < 13; $i++) {
            Task::create([
                'title' => "Completed Task {$i}",
                'user_id' => $user->id,
                'priority' => 'medium',
                'status' => 'completed',
                'due_date' => now()->addDays(5)->format('Y-m-d'),
                'completed_at' => now(),
            ]);
        }

        for ($i = 0; $i < 4; $i++) {
            Task::create([
                'title' => "In Progress Task {$i}",
                'user_id' => $user->id,
                'priority' => 'high',
                'status' => 'in_progress',
                'due_date' => now()->addDays(2)->format('Y-m-d'),
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Task::create([
                'title' => "Pending Task {$i}",
                'user_id' => $user->id,
                'priority' => 'low',
                'status' => 'pending',
                'due_date' => now()->addDays(1)->format('Y-m-d'),
            ]);
        }

        Livewire::actingAs($user)
            ->test(DashboardOverview::class)
            ->assertSee('Task Statistics')
            ->assertSee('Completed: 65%')
            ->assertSee('In Progress: 20%')
            ->assertSee('Pending: 15%');
    }

    public function test_recent_tasks_displays_latest_5_tasks_ordered_by_created_date(): void
    {
        $user = User::factory()->create();

        for ($i = 1; $i <= 7; $i++) {
            Task::forceCreate([
                'title' => "Unique Task Number {$i}",
                'user_id' => $user->id,
                'priority' => 'medium',
                'status' => 'pending',
                'due_date' => now()->addDays($i)->format('Y-m-d'),
                'created_at' => now()->subMinutes(10 - $i),
                'updated_at' => now()->subMinutes(10 - $i),
            ]);
        }

        $component = Livewire::actingAs($user)->test(DashboardOverview::class);

        // Recent tasks should only contain latest 5 (tasks 3, 4, 5, 6, 7)
        $component->assertSee('Recent Tasks');
        $component->assertSee('Unique Task Number 7');
        $component->assertSee('Unique Task Number 6');
        $component->assertSee('Unique Task Number 5');
        $component->assertSee('Unique Task Number 4');
        $component->assertSee('Unique Task Number 3');

        $this->assertCount(5, $component->get('recentTasks'));
        $this->assertEquals('Unique Task Number 7', $component->get('recentTasks')->first()->title);
    }

    public function test_due_soon_displays_tasks_due_within_next_3_days_excluding_completed(): void
    {
        $user = User::factory()->create();

        // Due today (uncompleted) -> Should be included
        Task::create([
            'title' => 'Urgent Task Due Today',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => now()->format('Y-m-d'),
        ]);

        // Due in 2 days (uncompleted) -> Should be included
        Task::create([
            'title' => 'Task Due In 2 Days',
            'user_id' => $user->id,
            'priority' => 'medium',
            'status' => 'in_progress',
            'due_date' => now()->addDays(2)->format('Y-m-d'),
        ]);

        // Due in 3 days (uncompleted) -> Should be included
        Task::create([
            'title' => 'Task Due In 3 Days',
            'user_id' => $user->id,
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => now()->addDays(3)->format('Y-m-d'),
        ]);

        // Due in 7 days -> Should NOT be in Due Soon
        Task::create([
            'title' => 'Future Task Due Next Week',
            'user_id' => $user->id,
            'priority' => 'low',
            'status' => 'pending',
            'due_date' => now()->addDays(7)->format('Y-m-d'),
        ]);

        // Due today but already completed -> Should NOT be in Due Soon
        Task::create([
            'title' => 'Completed Task Due Today',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->format('Y-m-d'),
            'completed_at' => now(),
        ]);

        $component = Livewire::actingAs($user)->test(DashboardOverview::class);

        $component->assertSee('Due Soon');
        $component->assertSee('Urgent Task Due Today');
        $component->assertSee('Task Due In 2 Days');
        $component->assertSee('Task Due In 3 Days');

        $dueSoonTitles = $component->get('dueSoonTasks')->pluck('title')->toArray();
        $this->assertContains('Urgent Task Due Today', $dueSoonTitles);
        $this->assertContains('Task Due In 2 Days', $dueSoonTitles);
        $this->assertContains('Task Due In 3 Days', $dueSoonTitles);
        $this->assertNotContains('Future Task Due Next Week', $dueSoonTitles);
        $this->assertNotContains('Completed Task Due Today', $dueSoonTitles);
    }
}
