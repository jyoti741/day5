<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DashboardOverview extends Component
{
    // Interactive filter tab on dashboard: 'pending', 'in_progress', 'completed', 'high_priority', 'all'
    public string $selectedStatusTab = 'pending';

    // Interactive chart visualization mode: 'status' or 'priority'
    public string $chartMode = 'status';

    public bool $showViewModal = false;

    public ?int $viewingTaskId = null;

    public function selectStatusTab(string $tab): void
    {
        $this->selectedStatusTab = $tab;
    }

    public function selectChartMode(string $mode): void
    {
        if (in_array($mode, ['status', 'priority'])) {
            $this->chartMode = $mode;
        }
    }

    public function openViewModal(int $taskId): void
    {
        $this->viewingTaskId = $taskId;
        $this->showViewModal = true;
    }

    public function updateTaskStatus(int $taskId, string $newStatus): void
    {
        if (! in_array($newStatus, ['pending', 'in_progress', 'completed'])) {
            return;
        }

        $task = Task::findOrFail($taskId);
        $task->status = $newStatus;
        if ($newStatus === 'completed') {
            $task->completed_at = Carbon::now();
        } else {
            $task->completed_at = null;
        }
        $task->save();

        Flux::toast(variant: 'success', text: __('Task status updated to :status.', ['status' => ucfirst(str_replace('_', ' ', $newStatus))]));
    }

    #[Computed]
    public function viewingTask(): ?Task
    {
        if (! $this->viewingTaskId) {
            return null;
        }

        return Task::with(['assignee', 'creator'])->find($this->viewingTaskId);
    }

    #[Computed]
    public function metrics(): array
    {
        $total = Task::count();
        $pending = Task::where('status', 'pending')->count();
        $inProgress = Task::where('status', 'in_progress')->count();
        $completed = Task::where('status', 'completed')->count();
        $highPriority = Task::where('priority', 'high')->count();
        $overdue = Task::overdue()->count();
        $dueToday = Task::where('status', '!=', 'completed')
            ->whereDate('due_date', Carbon::today())
            ->count();
        $dueSoon = Task::dueSoon()->count();

        $completionRate = $total > 0 ? round(($completed / $total) * 100) : 0;

        return [
            'total' => $total,
            'pending' => $pending,
            'in_progress' => $inProgress,
            'completed' => $completed,
            'high_priority' => $highPriority,
            'overdue' => $overdue,
            'due_today' => $dueToday,
            'due_soon' => $dueSoon,
            'completion_rate' => $completionRate,
        ];
    }

    #[Computed]
    public function taskStatistics(): array
    {
        $total = Task::count();
        $completed = Task::where('status', 'completed')->count();
        $inProgress = Task::where('status', 'in_progress')->count();
        $pending = Task::where('status', 'pending')->count();
        $overdue = Task::overdue()->count();

        $completedPct = $total > 0 ? round(($completed / $total) * 100, 1) : 0;
        $inProgressPct = $total > 0 ? round(($inProgress / $total) * 100, 1) : 0;
        $pendingPct = $total > 0 ? round(($pending / $total) * 100, 1) : 0;
        $overduePct = $total > 0 ? round(($overdue / $total) * 100, 1) : 0;

        // SVG Donut Circle offsets (Circumference = 100)
        $completedOffset = 0;
        $inProgressOffset = -1 * $completedPct;
        $pendingOffset = -1 * ($completedPct + $inProgressPct);

        // Priority breakdown
        $highPriority = Task::where('priority', 'high')->count();
        $mediumPriority = Task::where('priority', 'medium')->count();
        $lowPriority = Task::where('priority', 'low')->count();

        $highPct = $total > 0 ? round(($highPriority / $total) * 100, 1) : 0;
        $mediumPct = $total > 0 ? round(($mediumPriority / $total) * 100, 1) : 0;
        $lowPct = $total > 0 ? round(($lowPriority / $total) * 100, 1) : 0;

        $highOffset = 0;
        $mediumOffset = -1 * $highPct;
        $lowOffset = -1 * ($highPct + $mediumPct);

        return [
            'total' => $total,
            // Status data
            'completed_count' => $completed,
            'in_progress_count' => $inProgress,
            'pending_count' => $pending,
            'overdue_count' => $overdue,
            'completed_percentage' => (int) round($completedPct),
            'in_progress_percentage' => (int) round($inProgressPct),
            'pending_percentage' => (int) round($pendingPct),
            'overdue_percentage' => (int) round($overduePct),
            'completed_pct_exact' => $completedPct,
            'in_progress_pct_exact' => $inProgressPct,
            'pending_pct_exact' => $pendingPct,
            'completed_offset' => $completedOffset,
            'in_progress_offset' => $inProgressOffset,
            'pending_offset' => $pendingOffset,
            // Priority data
            'high_count' => $highPriority,
            'medium_count' => $mediumPriority,
            'low_count' => $lowPriority,
            'high_percentage' => (int) round($highPct),
            'medium_percentage' => (int) round($mediumPct),
            'low_percentage' => (int) round($lowPct),
            'high_pct_exact' => $highPct,
            'medium_pct_exact' => $mediumPct,
            'low_pct_exact' => $lowPct,
            'high_offset' => $highOffset,
            'medium_offset' => $mediumOffset,
            'low_offset' => $lowOffset,
        ];
    }

    #[Computed]
    public function recentTasks()
    {
        return Task::with(['assignee'])
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
    }

    #[Computed]
    public function dueSoonTasks()
    {
        return Task::with(['assignee'])
            ->dueSoon()
            ->orderBy('due_date', 'asc')
            ->get();
    }

    #[Computed]
    public function filteredDashboardTasks()
    {
        $query = Task::with(['assignee']);

        switch ($this->selectedStatusTab) {
            case 'pending':
                $query->where('status', 'pending')->orderByRaw('due_date IS NULL, due_date ASC');
                break;
            case 'completed':
                $query->where('status', 'completed')->latest('completed_at');
                break;
            case 'in_progress':
                $query->where('status', 'in_progress')->orderByRaw('due_date IS NULL, due_date ASC');
                break;
            case 'high_priority':
                $query->where('priority', 'high')->where('status', '!=', 'completed')->orderByRaw('due_date IS NULL, due_date ASC');
                break;
            case 'all':
            default:
                $query->latest('created_at');
                break;
        }

        return $query->take(8)->get();
    }

    #[Computed]
    public function teamWorkload()
    {
        return User::withCount([
            'assignedTasks as total_tasks_count',
            'assignedTasks as pending_tasks_count' => fn ($q) => $q->where('status', 'pending'),
            'assignedTasks as in_progress_tasks_count' => fn ($q) => $q->where('status', 'in_progress'),
            'assignedTasks as completed_tasks_count' => fn ($q) => $q->where('status', 'completed'),
        ])->get();
    }

    public function exportCsv()
    {
        if (! config('office.enable_task_export', true)) {
            abort(403, 'Task export feature is currently disabled.');
        }

        $tasks = Task::with(['assignee'])->latest('created_at')->get();
        $appName = str(config('office.app_name', 'tasks'))->slug()->toString();
        $filename = "{$appName}-all-tasks-".now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () use ($tasks) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Task ID',
                'Task Title',
                'Description',
                'Assigned To',
                'Assignee Email',
                'Priority',
                'Status',
                'Due Date',
                'Is Overdue',
                'Completed Date',
                'Created Date',
            ]);

            foreach ($tasks as $task) {
                fputcsv($handle, [
                    $task->id,
                    $task->title,
                    $task->description,
                    ucfirst($task->priority),
                    ucfirst(str_replace('_', ' ', $task->status)),
                    $task->assignee ? $task->assignee->name : 'Unassigned',
                    $task->assignee ? $task->assignee->email : '',
                    $task->due_date ? $task->due_date->format('Y-m-d') : 'No deadline',
                    $task->isOverdue() ? 'Yes' : 'No',
                    $task->completed_at ? $task->completed_at->format('Y-m-d H:i:s') : '',
                    $task->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard-overview');
    }
}
