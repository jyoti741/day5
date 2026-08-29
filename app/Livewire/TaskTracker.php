<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class TaskTracker extends Component
{
    use WithPagination;

    // Filters & Search
    public string $search = '';
    public string $statusFilter = 'all';
    public string $priorityFilter = 'all';
    public string $assigneeFilter = 'all';
    public string $categoryFilter = 'all';
    public string $sortBy = 'deadline_asc';
    public string $activeView = 'list'; // 'list', 'board', 'team'

    // Create / Edit Modal State
    public bool $showTaskModal = false;
    public bool $isEditing = false;
    public ?int $editingTaskId = null;

    // Form fields
    public string $title = '';
    public string $description = '';
    public ?int $user_id = null;
    public string $priority = 'medium';
    public string $status = 'pending';
    public string $category = 'Engineering';
    public string $due_date = '';

    // Delete Modal State
    public bool $showDeleteModal = false;
    public ?int $deletingTaskId = null;
    public string $deletingTaskTitle = '';

    protected function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:2000',
            'user_id' => 'nullable|exists:users,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'category' => 'required|string|max:100',
            'due_date' => 'nullable|date',
        ];
    }

    public function mount(): void
    {
        $this->due_date = Carbon::now()->addDays(3)->format('Y-m-d');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingPriorityFilter(): void
    {
        $this->resetPage();
    }

    public function updatingAssigneeFilter(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter(): void
    {
        $this->resetPage();
    }

    // Modal Triggers
    public function openCreateModal(): void
    {
        $this->resetValidation();
        $this->isEditing = false;
        $this->editingTaskId = null;
        $this->title = '';
        $this->description = '';
        $this->user_id = Auth::id();
        $this->priority = 'medium';
        $this->status = 'pending';
        $this->category = 'Engineering';
        $this->due_date = Carbon::now()->addDays(3)->format('Y-m-d');
        $this->showTaskModal = true;
    }

    public function openEditModal(int $taskId): void
    {
        $this->resetValidation();
        $task = Task::findOrFail($taskId);
        $this->isEditing = true;
        $this->editingTaskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description ?? '';
        $this->user_id = $task->user_id;
        $this->priority = $task->priority;
        $this->status = $task->status;
        $this->category = $task->category;
        $this->due_date = $task->due_date ? $task->due_date->format('Y-m-d') : '';
        $this->showTaskModal = true;
    }

    public function saveTask(): void
    {
        $validated = $this->validate();

        if ($this->isEditing && $this->editingTaskId) {
            $task = Task::findOrFail($this->editingTaskId);
            
            // Check if status changed to completed
            if ($validated['status'] === 'completed' && $task->status !== 'completed') {
                $validated['completed_at'] = Carbon::now();
            } elseif ($validated['status'] !== 'completed') {
                $validated['completed_at'] = null;
            }

            $task->update($validated);
            Flux::toast(variant: 'success', text: __('Task updated successfully.'));
        } else {
            $validated['assigned_by'] = Auth::id();
            if ($validated['status'] === 'completed') {
                $validated['completed_at'] = Carbon::now();
            }
            Task::create($validated);
            Flux::toast(variant: 'success', text: __('New task created successfully.'));
        }

        $this->showTaskModal = false;
        $this->reset(['title', 'description', 'editingTaskId', 'isEditing']);
    }

    // Quick Status Update
    public function updateTaskStatus(int $taskId, string $newStatus): void
    {
        $task = Task::findOrFail($taskId);
        $task->status = $newStatus;
        if ($newStatus === 'completed') {
            $task->completed_at = Carbon::now();
        } else {
            $task->completed_at = null;
        }
        $task->save();

        Flux::toast(variant: 'success', text: __("Task status changed to :status.", ['status' => ucfirst(str_replace('_', ' ', $newStatus))]));
    }

    // Quick Priority Update
    public function updateTaskPriority(int $taskId, string $newPriority): void
    {
        $task = Task::findOrFail($taskId);
        $task->priority = $newPriority;
        $task->save();

        Flux::toast(variant: 'success', text: __("Task priority updated to :priority.", ['priority' => ucfirst($newPriority)]));
    }

    // Delete Confirmation
    public function confirmDelete(int $taskId): void
    {
        $task = Task::findOrFail($taskId);
        $this->deletingTaskId = $task->id;
        $this->deletingTaskTitle = $task->title;
        $this->showDeleteModal = true;
    }

    public function deleteTask(): void
    {
        if ($this->deletingTaskId) {
            $task = Task::find($this->deletingTaskId);
            if ($task) {
                $task->delete();
                Flux::toast(variant: 'success', text: __('Task deleted.'));
            }
        }
        $this->showDeleteModal = false;
        $this->deletingTaskId = null;
        $this->deletingTaskTitle = '';
    }

    // Computed Properties
    #[Computed]
    public function metrics(): array
    {
        $total = Task::count();
        $pending = Task::where('status', 'pending')->count();
        $inProgress = Task::where('status', 'in_progress')->count();
        $completed = Task::where('status', 'completed')->count();
        $highPriority = Task::whereIn('priority', ['high', 'urgent'])->count();
        $overdue = Task::where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->where('due_date', '<', Carbon::today())
            ->count();

        $completionRate = $total > 0 ? round(($completed / $total) * 100) : 0;

        return [
            'total' => $total,
            'pending' => $pending,
            'in_progress' => $inProgress,
            'completed' => $completed,
            'high_priority' => $highPriority,
            'overdue' => $overdue,
            'completion_rate' => $completionRate,
        ];
    }

    #[Computed]
    public function users()
    {
        return User::orderBy('name')->get();
    }

    #[Computed]
    public function categories(): array
    {
        return ['Engineering', 'Design', 'Marketing', 'Operations', 'Security', 'Management', 'General'];
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
        $query = Task::with(['assignee', 'creator']);

        // Search Filter
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Status Filter
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Priority Filter
        if ($this->priorityFilter !== 'all') {
            $query->where('priority', $this->priorityFilter);
        }

        // Assignee Filter
        if ($this->assigneeFilter !== 'all') {
            if ($this->assigneeFilter === 'unassigned') {
                $query->whereNull('user_id');
            } else {
                $query->where('user_id', (int) $this->assigneeFilter);
            }
        }

        // Category Filter
        if ($this->categoryFilter !== 'all') {
            $query->where('category', $this->categoryFilter);
        }

        // Sorting
        switch ($this->sortBy) {
            case 'deadline_desc':
                $query->orderByRaw('due_date IS NULL, due_date DESC');
                break;
            case 'priority_desc':
                $query->orderByRaw("CASE priority WHEN 'urgent' THEN 1 WHEN 'high' THEN 2 WHEN 'medium' THEN 3 WHEN 'low' THEN 4 ELSE 5 END");
                break;
            case 'newest':
                $query->latest();
                break;
            case 'deadline_asc':
            default:
                $query->orderByRaw('due_date IS NULL, due_date ASC');
                break;
        }

        $tasks = $query->paginate(15);
        $allTasksForBoard = $this->activeView === 'board' ? (clone $query)->limit(100)->get() : collect();

        return view('livewire.task-tracker', [
            'tasks' => $tasks,
            'allTasksForBoard' => $allTasksForBoard,
        ]);
    }
}