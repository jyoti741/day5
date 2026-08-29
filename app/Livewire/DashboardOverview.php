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

    public bool $showViewModal = false;

    public ?int $viewingTaskId = null;

    public function selectStatusTab(string $tab): void
    {
        $this->selectedStatusTab = $tab;
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
        $overdue = Task::where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->where('due_date', '<', Carbon::today())
            ->count();
        $dueToday = Task::where('status', '!=', 'completed')
            ->whereDate('due_date', Carbon::today())
            ->count();

        $completionRate = $total > 0 ? round(($completed / $total) * 100) : 0;

        return [
            'total' => $total,
            'pending' => $pending,
            'in_progress' => $inProgress,
            'completed' => $completed,
            'high_priority' => $highPriority,
            'overdue' => $overdue,
            'due_today' => $dueToday,
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

        $completedPercentage = $total > 0 ? (int) round(($completed / $total) * 100) : 0;
        $inProgressPercentage = $total > 0 ? (int) round(($inProgress / $total) * 100) : 0;
        $pendingPercentage = $total > 0 ? (int) round(($pending / $total) * 100) : 0;

        return [
            'total' => $total,
            'completed_count' => $completed,
            'in_progress_count' => $inProgress,
            'pending_count' => $pending,
            'completed_percentage' => $completedPercentage,
            'in_progress_percentage' => $inProgressPercentage,
            'pending_percentage' => $pendingPercentage,
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
        $today = Carbon::today()->format('Y-m-d');
        $threeDaysLater = Carbon::today()->addDays(3)->format('Y-m-d');

        return Task::with(['assignee'])
            ->where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '>=', $today)
            ->whereDate('due_date', '<=', $threeDaysLater)
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
