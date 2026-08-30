<?php

namespace Tests\Feature;

use App\Livewire\DashboardOverview;
use App\Livewire\TaskTracker;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class OverdueAndDueSoonUiTest extends TestCase
{
    use RefreshDatabase;

    public function test_overdue_tasks_are_automatically_identified_when_due_date_passed_and_not_completed(): void
    {
        $user = User::factory()->create();

        // 5 days overdue pending task
        $task5Days = Task::create([
            'title' => 'Server Security Audit',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => Carbon::today()->subDays(5)->format('Y-m-d'),
        ]);

        // 1 day overdue in-progress task
        $task1Day = Task::create([
            'title' => 'Client Invoice Dispatch',
            'user_id' => $user->id,
            'priority' => 'medium',
            'status' => 'in_progress',
            'due_date' => Carbon::today()->subDays(1)->format('Y-m-d'),
        ]);

        // Completed task with past due date -> MUST NOT BE OVERDUE
        $completedTask = Task::create([
            'title' => 'Office Supplies Order',
            'user_id' => $user->id,
            'priority' => 'low',
            'status' => 'completed',
            'due_date' => Carbon::today()->subDays(3)->format('Y-m-d'),
            'completed_at' => Carbon::yesterday(),
        ]);

        $this->assertTrue($task5Days->isOverdue());
        $this->assertEquals(5, $task5Days->daysOverdue());
        $this->assertEquals('🔴 OVERDUE · 5 days late', $task5Days->overdueBadgeText());

        $this->assertTrue($task1Day->isOverdue());
        $this->assertEquals(1, $task1Day->daysOverdue());
        $this->assertEquals('🔴 OVERDUE · 1 day late', $task1Day->overdueBadgeText());

        $this->assertFalse($completedTask->isOverdue());
        $this->assertEquals(0, $completedTask->daysOverdue());
    }

    public function test_task_tracker_displays_overdue_badge_and_styling(): void
    {
        $user = User::factory()->create(['name' => 'Alice Martin']);

        Task::create([
            'title' => 'Urgent Quarterly Report Submission',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => Carbon::today()->subDays(5)->format('Y-m-d'),
        ]);

        $component = Livewire::actingAs($user)->test(TaskTracker::class);

        $component->assertSee('Urgent Quarterly Report Submission');
        $component->assertSee('🔴 OVERDUE · 5 days late');
        $component->assertSee('border-l-rose-500');
    }

    public function test_completed_tasks_are_never_marked_overdue_on_ui(): void
    {
        $user = User::factory()->create(['name' => 'Bob Smith']);

        Task::create([
            'title' => 'Finished Migration Project',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => Carbon::today()->subDays(7)->format('Y-m-d'),
            'completed_at' => Carbon::yesterday(),
        ]);

        $component = Livewire::actingAs($user)->test(TaskTracker::class);

        $component->assertSee('Finished Migration Project');
        $component->assertDontSee('🔴 OVERDUE');
    }

    public function test_due_soon_alert_panel_on_dashboard_calculates_tasks_within_next_3_days(): void
    {
        $user = User::factory()->create(['name' => 'Carol Danvers']);

        // Task due today
        Task::create([
            'title' => 'Deploy Hotfix to Production',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'in_progress',
            'due_date' => Carbon::today()->format('Y-m-d'),
        ]);

        // Task due tomorrow
        Task::create([
            'title' => 'Client Feedback Presentation',
            'user_id' => $user->id,
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => Carbon::today()->addDays(1)->format('Y-m-d'),
        ]);

        // Task due in 2 days
        Task::create([
            'title' => 'Prepare Monthly Payroll',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => Carbon::today()->addDays(2)->format('Y-m-d'),
        ]);

        // Task due in 3 days
        Task::create([
            'title' => 'Vendor Contract Renewal',
            'user_id' => $user->id,
            'priority' => 'low',
            'status' => 'pending',
            'due_date' => Carbon::today()->addDays(3)->format('Y-m-d'),
        ]);

        // Task due in 6 days (NOT due soon)
        Task::create([
            'title' => 'Future Marketing Campaign',
            'user_id' => $user->id,
            'priority' => 'low',
            'status' => 'pending',
            'due_date' => Carbon::today()->addDays(6)->format('Y-m-d'),
        ]);

        // Overdue task (must NOT appear in Due Soon section)
        Task::create([
            'title' => 'Late Server Maintenance',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => Carbon::today()->subDays(2)->format('Y-m-d'),
        ]);

        // Completed task due today (must NOT appear in Due Soon section)
        Task::create([
            'title' => 'Completed Standup Prep',
            'user_id' => $user->id,
            'priority' => 'low',
            'status' => 'completed',
            'due_date' => Carbon::today()->format('Y-m-d'),
            'completed_at' => Carbon::now(),
        ]);

        $component = Livewire::actingAs($user)->test(DashboardOverview::class);

        // Header & count check
        $component->assertSee('⚠️ Due Soon');
        $component->assertSee('4 tasks are due within the next 3 days.');
        $component->assertSee('View All');

        // Due soon items check
        $component->assertSee('Deploy Hotfix to Production');
        $component->assertSee('Due Today');

        $component->assertSee('Client Feedback Presentation');
        $component->assertSee('Due Tomorrow');

        $component->assertSee('Prepare Monthly Payroll');
        $component->assertSee('Due in 2 days');

        $component->assertSee('Vendor Contract Renewal');
        $component->assertSee('Due in 3 days');

        // Ensure 4 tasks returned
        $this->assertCount(4, $component->get('dueSoonTasks'));

        $dueSoonTitles = $component->get('dueSoonTasks')->pluck('title')->toArray();
        $this->assertContains('Deploy Hotfix to Production', $dueSoonTitles);
        $this->assertContains('Client Feedback Presentation', $dueSoonTitles);
        $this->assertContains('Prepare Monthly Payroll', $dueSoonTitles);
        $this->assertContains('Vendor Contract Renewal', $dueSoonTitles);
        $this->assertNotContains('Future Marketing Campaign', $dueSoonTitles);
        $this->assertNotContains('Late Server Maintenance', $dueSoonTitles);
        $this->assertNotContains('Completed Standup Prep', $dueSoonTitles);
    }

    public function test_due_soon_alert_panel_shows_clean_message_when_empty(): void
    {
        $user = User::factory()->create();

        // No tasks due in next 3 days
        Task::create([
            'title' => 'Future Long Term Task',
            'user_id' => $user->id,
            'priority' => 'low',
            'status' => 'pending',
            'due_date' => Carbon::today()->addDays(10)->format('Y-m-d'),
        ]);

        $component = Livewire::actingAs($user)->test(DashboardOverview::class);

        $component->assertSee('⚠️ Due Soon');
        $component->assertSee('0 tasks are due within the next 3 days.');
        $component->assertSee('No tasks are due within the next 3 days.');
    }

    public function test_task_tracker_can_filter_by_due_soon_and_overdue(): void
    {
        $user = User::factory()->create(['name' => 'David Miller']);

        // Overdue task
        Task::create([
            'title' => 'Overdue Documentation Task',
            'user_id' => $user->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => Carbon::today()->subDays(4)->format('Y-m-d'),
        ]);

        // Due soon task
        Task::create([
            'title' => 'Due Soon Budget Task',
            'user_id' => $user->id,
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => Carbon::today()->addDays(2)->format('Y-m-d'),
        ]);

        // Normal future task
        Task::create([
            'title' => 'Far Future Task',
            'user_id' => $user->id,
            'priority' => 'low',
            'status' => 'pending',
            'due_date' => Carbon::today()->addDays(14)->format('Y-m-d'),
        ]);

        // Filter: due_soon
        $dueSoonComponent = Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->set('overdueFilter', 'due_soon');

        $dueSoonComponent->assertSee('Due Soon Budget Task');
        $dueSoonComponent->assertDontSee('Overdue Documentation Task');
        $dueSoonComponent->assertDontSee('Far Future Task');

        // Filter: overdue
        $overdueComponent = Livewire::actingAs($user)
            ->test(TaskTracker::class)
            ->set('overdueFilter', 'overdue');

        $overdueComponent->assertSee('Overdue Documentation Task');
        $overdueComponent->assertDontSee('Due Soon Budget Task');
        $overdueComponent->assertDontSee('Far Future Task');
    }
}
