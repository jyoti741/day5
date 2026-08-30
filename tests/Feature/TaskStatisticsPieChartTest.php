<?php

namespace Tests\Feature;

use App\Livewire\DashboardOverview;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TaskStatisticsPieChartTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_statistics_calculates_correct_status_and_priority_percentages(): void
    {
        $user = User::factory()->create();

        // 2 Completed, 2 In Progress, 1 Pending (Total = 5)
        Task::create(['title' => 'T1', 'user_id' => $user->id, 'status' => 'completed', 'priority' => 'high']);
        Task::create(['title' => 'T2', 'user_id' => $user->id, 'status' => 'completed', 'priority' => 'medium']);
        Task::create(['title' => 'T3', 'user_id' => $user->id, 'status' => 'in_progress', 'priority' => 'high']);
        Task::create(['title' => 'T4', 'user_id' => $user->id, 'status' => 'in_progress', 'priority' => 'low']);
        Task::create(['title' => 'T5', 'user_id' => $user->id, 'status' => 'pending', 'priority' => 'medium']);

        $component = Livewire::actingAs($user)->test(DashboardOverview::class);

        $stats = $component->get('taskStatistics');

        $this->assertEquals(5, $stats['total']);
        $this->assertEquals(2, $stats['completed_count']);
        $this->assertEquals(2, $stats['in_progress_count']);
        $this->assertEquals(1, $stats['pending_count']);

        $this->assertEquals(40, $stats['completed_percentage']); // 2/5 = 40%
        $this->assertEquals(40, $stats['in_progress_percentage']); // 2/5 = 40%
        $this->assertEquals(20, $stats['pending_percentage']); // 1/5 = 20%

        // Priority breakdown
        $this->assertEquals(2, $stats['high_count']); // 2/5 = 40%
        $this->assertEquals(2, $stats['medium_count']); // 2/5 = 40%
        $this->assertEquals(1, $stats['low_count']); // 1/5 = 20%
    }

    public function test_pie_chart_renders_svg_donut_and_mode_switcher_on_dashboard(): void
    {
        $user = User::factory()->create();

        Task::create(['title' => 'Task A', 'user_id' => $user->id, 'status' => 'completed', 'priority' => 'high']);
        Task::create(['title' => 'Task B', 'user_id' => $user->id, 'status' => 'pending', 'priority' => 'low']);

        $component = Livewire::actingAs($user)->test(DashboardOverview::class);

        $component->assertSee('Task Statistics');
        $component->assertSee('Pie Chart');
        $component->assertSee('Status Breakdown');
        $component->assertSee('Priority Distribution');
        $component->assertSee('Status Breakdown Pie Chart');
        $component->assertSee('TOTAL TASKS');
    }

    public function test_chart_mode_can_be_toggled_to_priority_distribution(): void
    {
        $user = User::factory()->create();

        Task::create(['title' => 'Urgent Task', 'user_id' => $user->id, 'status' => 'pending', 'priority' => 'high']);

        $component = Livewire::actingAs($user)
            ->test(DashboardOverview::class)
            ->call('selectChartMode', 'priority');

        $component->assertSet('chartMode', 'priority');
        $component->assertSee('Priority Distribution Pie Chart');
        $component->assertSee('BY PRIORITY');
        $component->assertSee('High Priority');
    }

    public function test_pie_chart_handles_empty_tasks_without_errors(): void
    {
        $user = User::factory()->create();

        $component = Livewire::actingAs($user)->test(DashboardOverview::class);

        $stats = $component->get('taskStatistics');
        $this->assertEquals(0, $stats['total']);
        $this->assertEquals(0, $stats['completed_percentage']);
        $this->assertEquals(0, $stats['in_progress_percentage']);
        $this->assertEquals(0, $stats['pending_percentage']);

        $component->assertSee('0');
        $component->assertSee('TOTAL TASKS');
    }
}
