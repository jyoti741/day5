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
    public string $statusFilter = 'all'; // 'all', 'pending', 'in_progress', 'completed'
    public string $priorityFilter = 'all'; // 'all', 'low', 'medium', 'high'
    public string $assigneeFilter = 'all'; // 'all', 'unassigned', or user ID
    public string $sortBy = 'deadline_asc'; // 'deadline_asc', 'deadline_desc', 'priority_desc', 'created_desc', 'created_asc'
    public string $activeView = 'list'; // 'list', 'board', 'team'

    // Create / Edit Modal State
    public bool $showTaskModal = false;
    public bool $isEditing = false;
    public ?int $editingTaskId = null;

    // View Details Modal State
    public bool $showViewModal = false;
    public ?int $viewingTaskId = null;

    // Form fields
    public string $title = '';
    public string $description = '';
    public ?int $user_id = null; // Assigned To
    public string $priority = 'medium'; // 'low', 'medium', 'high'
    public string $status = 'pending'; // 'pending', 'in_progress', 'completed'
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
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'required|date',
        ];
    }

    protected $messages = [
        'title.required' => 'Task Title is required.',
        'title.min' => 'Task Title must be at least 3 characters.',
        'priority.required' => 'Priority is required (Low, Medium, High).',
        'priority.in' => 'Priority must be Low, Medium, or High.',
        'status.required' => 'Status is required (Pending, In Progress, Completed).',
        'status.in' => 'Status must be Pending, In Progress, or Completed.',
        'due_date.required' => 'Due Date is required.',
    ];

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

    // View Modal Trigger
    public function openViewModal(int $taskId): void
    {
        $this->viewingTaskId = $taskId;
        $this->showViewModal = true;
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
        $this->priority = in_array($task->priority, ['low', 'medium', 'high']) ? $task->priority : 'high';
        $this->status = in_array($task->status, ['pending', 'in_progress', 'completed']) ? $task->status : 'pending';
        $this->due_date = $task->due_date ? $task->due_date->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        
        // Close view modal if opening edit from view modal
        $this->showViewModal = false;
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

    // Quick Priority Update
    public function updateTaskPriority(int $taskId, string $newPriority): void
    {
        if (!in_array($newPriority, ['low', 'medium', 'high'])) {
            return;
        }

        $task = Task::findOrFail($taskId);
        $task->priority = $newPriority;
        $task->save();

        Flux::toast(variant: 'success', text: __("Task priority set to :priority.", ['priority' => ucfirst($newPriority)]));
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

        $completionRate = $total > 0 ? round(($completed / $total) * 100) : 0;

        return [
            'total' => $total,
            'pending' => $pending,
            'in_progress' => $inProgress,
            'completed' => $completed,
            'high_priority' => $highPriority,
            'completion_rate' => $completionRate,
        ];
    }

    #[Computed]
    public function users()
    {
        return User::orderBy('name')->get();
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

        // Search Filter (Task Title & Description)
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

        // Assigned To Filter
        if ($this->assigneeFilter !== 'all') {
            if ($this->assigneeFilter === 'unassigned') {
                $query->whereNull('user_id');
            } else {
                $query->where('user_id', (int) $this->assigneeFilter);
            }
        }

        // Sorting
        switch ($this->sortBy) {
            case 'deadline_desc':
                $query->orderByRaw('due_date IS NULL, due_date DESC');
                break;
            case 'priority_desc':
                $query->orderByRaw("CASE priority WHEN 'high' THEN 1 WHEN 'medium' THEN 2 WHEN 'low' THEN 3 ELSE 4 END");
                break;
            case 'created_asc':
                $query->oldest('created_at');
                break;
            case 'created_desc':
            case 'newest':
                $query->latest('created_at');
                break;
            case 'deadline_asc':
            default:
                $query->orderByRaw('due_date IS NULL, due_date ASC');
                break;
        }

        $tasks = $query->paginate(12);
        $allTasksForBoard = $this->activeView === 'board' ? (clone $query)->limit(100)->get() : collect();

        return view('livewire.task-tracker', [
            'tasks' => $tasks,
            'allTasksForBoard' => $allTasksForBoard,
        ]);
    }
}