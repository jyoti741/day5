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
        if (!in_array($newStatus, ['pending', 'in_progress', 'completed'])) {
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

        Flux::toast(variant: 'success', text: __("Task status updated to :status.", ['status' => ucfirst(str_replace('_', ' ', $newStatus))]));
    }

    #[Computed]
    public function viewingTask(): ?Task
    {
        if (!$this->viewingTaskId) {
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
            'assignedTasks as pending_tasks_count' => fn($q) => $q->where('status', 'pending'),
            'assignedTasks as in_progress_tasks_count' => fn($q) => $q->where('status', 'in_progress'),
            'assignedTasks as completed_tasks_count' => fn($q) => $q->where('status', 'completed'),
        ])->get();
    }

    public function render()
    {
        return view('livewire.dashboard-overview');
    }
}
