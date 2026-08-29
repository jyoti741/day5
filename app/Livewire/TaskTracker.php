<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TaskTracker extends Component
{
    use WithPagination;

    // Filters & Search (Synchronized with URL query string)
    #[Url(as: 'search')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $statusFilter = 'all'; // 'all', 'pending', 'in_progress', 'completed'

    #[Url(as: 'priority')]
    public string $priorityFilter = 'all'; // 'all', 'low', 'medium', 'high'

    #[Url(as: 'overdue')]
    public string $overdueFilter = 'all'; // 'all', 'overdue'

    #[Url(as: 'assignee')]
    public string $assigneeFilter = 'all'; // 'all', 'unassigned', or user ID

    public string $sortBy = 'deadline_asc'; // 'deadline_asc', 'deadline_desc', 'priority_desc', 'created_desc', 'created_asc'

    public string $activeView = 'list'; // 'list', 'board', 'team', 'overdue_report'

    // Monthly Overdue Report Month Selector
    public string $selectedReportMonth = '';

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

    public ?int $user_id = null; // Assigned To (Required)

    public string $priority = 'medium'; // 'low', 'medium', 'high'

    public string $status = 'pending'; // 'pending', 'in_progress', 'completed'

    public string $due_date = '';

    // Delete Modal State
    public bool $showDeleteModal = false;

    public ?int $deletingTaskId = null;

    public string $deletingTaskTitle = '';

    /**
     * Strict Validation Rules
     */
    protected function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:2000',
            'user_id' => 'required|exists:users,id',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'required|date',
        ];
    }

    /**
     * Custom User-Friendly Error Messages
     */
    protected function messages(): array
    {
        return [
            'title.required' => 'Task title is required.',
            'title.min' => 'Task title must be at least 3 characters.',
            'title.max' => 'Task title cannot exceed 255 characters.',
            'user_id.required' => 'Please select or enter the person responsible for this task.',
            'user_id.exists' => 'The selected person is invalid.',
            'priority.required' => 'Priority is required.',
            'priority.in' => 'Priority must be Low, Medium, or High.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be Pending, In Progress, or Completed.',
            'due_date.required' => 'Due date is required.',
            'due_date.date' => 'Please provide a valid due date.',
            'description.max' => 'Description cannot exceed 2000 characters.',
        ];
    }

    public function mount(): void
    {
        $this->due_date = Carbon::now()->addDays(3)->format('Y-m-d');
        $this->selectedReportMonth = Carbon::now()->format('Y-m');
    }

    /**
     * Real-Time Validation: Validates and clears errors as user types/selects
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
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

    public function updatingOverdueFilter(): void
    {
        $this->resetPage();
    }

    public function updatingAssigneeFilter(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->statusFilter = 'all';
        $this->priorityFilter = 'all';
        $this->overdueFilter = 'all';
        $this->assigneeFilter = 'all';
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
        $this->user_id = Auth::id() ?: (User::first()->id ?? null);
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

        $this->showViewModal = false;
        $this->showTaskModal = true;
    }

    /**
     * Server-Side Validation & Database Protection
     */
    public function saveTask(): void
    {
        $validated = $this->validate();

        if ($this->isEditing && $this->editingTaskId) {
            $task = Task::findOrFail($this->editingTaskId);

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

    // Quick Priority Update
    public function updateTaskPriority(int $taskId, string $newPriority): void
    {
        if (! in_array($newPriority, ['low', 'medium', 'high'])) {
            return;
        }

        $task = Task::findOrFail($taskId);
        $task->priority = $newPriority;
        $task->save();

        Flux::toast(variant: 'success', text: __('Task priority set to :priority.', ['priority' => ucfirst($newPriority)]));
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

    /**
     * Monthly Overdue Report Computation
     */
    #[Computed]
    public function monthlyOverdueReport(): array
    {
        $monthStr = $this->selectedReportMonth ?: Carbon::today()->format('Y-m');
        try {
            $startOfMonth = Carbon::createFromFormat('Y-m', $monthStr)->startOfMonth();
            $endOfMonth = (clone $startOfMonth)->endOfMonth();
        } catch (\Exception $e) {
            $startOfMonth = Carbon::today()->startOfMonth();
            $endOfMonth = Carbon::today()->endOfMonth();
        }

        $overdueTasks = Task::with(['assignee', 'creator'])
            ->where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')])
            ->where('due_date', '<', Carbon::today())
            ->orderBy('due_date', 'asc')
            ->get();

        return [
            'month_label' => $startOfMonth->format('F Y'),
            'total_overdue' => $overdueTasks->count(),
            'high_priority_count' => $overdueTasks->where('priority', 'high')->count(),
            'medium_priority_count' => $overdueTasks->where('priority', 'medium')->count(),
            'low_priority_count' => $overdueTasks->where('priority', 'low')->count(),
            'tasks' => $overdueTasks,
        ];
    }

    #[Computed]
    public function availableReportMonths(): array
    {
        $months = [];
        $current = Carbon::today()->startOfMonth();
        for ($i = -6; $i <= 3; $i++) {
            $m = (clone $current)->addMonths($i);
            $months[$m->format('Y-m')] = $m->format('F Y');
        }

        return $months;
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
            'assignedTasks as pending_tasks_count' => fn ($q) => $q->where('status', 'pending'),
            'assignedTasks as in_progress_tasks_count' => fn ($q) => $q->where('status', 'in_progress'),
            'assignedTasks as completed_tasks_count' => fn ($q) => $q->where('status', 'completed'),
        ])->get();
    }

    protected function getFilteredTasksQuery()
    {
        $query = Task::with(['assignee', 'creator']);

        // Search Filter (Task Title, Description, and Assigned User's Name / Email)
        if (! empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', '%'.$term.'%')
                    ->orWhere('description', 'like', '%'.$term.'%')
                    ->orWhereHas('assignee', function ($userQuery) use ($term) {
                        $userQuery->where('name', 'like', '%'.$term.'%')
                            ->orWhere('email', 'like', '%'.$term.'%');
                    });
            });
        }

        // Status Filter (All, Pending, In Progress, Completed)
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Priority Filter (All, Low, Medium, High)
        if ($this->priorityFilter !== 'all') {
            $query->where('priority', $this->priorityFilter);
        }

        // Overdue Filter
        if ($this->overdueFilter === 'overdue') {
            $query->overdue();
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

        return $query;
    }

    public function exportCsv()
    {
        if (! config('office.enable_task_export', true)) {
            abort(403, 'Task export feature is currently disabled.');
        }

        $tasks = $this->getFilteredTasksQuery()->get();
        $appName = str(config('office.app_name', 'tasks'))->slug()->toString();
        $filename = "{$appName}-tasks-".now()->format('Y-m-d').'.csv';

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

    public function exportJson()
    {
        if (! config('office.enable_task_export', true)) {
            abort(403, 'Task export feature is currently disabled.');
        }

        $tasks = $this->getFilteredTasksQuery()->get();
        $appName = str(config('office.app_name', 'tasks'))->slug()->toString();
        $filename = "{$appName}-tasks-".now()->format('Y-m-d').'.json';

        $data = [
            'app_name' => config('office.app_name'),
            'company_name' => config('office.company_name'),
            'exported_at' => now()->toIso8601String(),
            'total_tasks' => $tasks->count(),
            'tasks' => $tasks->map(fn ($task) => [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'priority' => $task->priority,
                'status' => $task->status,
                'assignee' => $task->assignee ? [
                    'id' => $task->assignee->id,
                    'name' => $task->assignee->name,
                    'email' => $task->assignee->email,
                ] : null,
                'due_date' => $task->due_date ? $task->due_date->format('Y-m-d') : null,
                'is_overdue' => $task->isOverdue(),
                'completed_at' => $task->completed_at ? $task->completed_at->toIso8601String() : null,
                'created_at' => $task->created_at->toIso8601String(),
            ]),
        ];

        return response()->streamDownload(function () use ($data) {
            echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        }, $filename, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function exportOverdueReportCsv()
    {
        if (! config('office.enable_task_export', true)) {
            abort(403, 'Task export feature is currently disabled.');
        }

        $report = $this->monthlyOverdueReport();
        $monthLabel = str($report['month_label'])->slug()->toString();
        $filename = "overdue-report-{$monthLabel}.csv";

        return response()->streamDownload(function () use ($report) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Month',
                'Task ID',
                'Title',
                'Assigned To',
                'Priority',
                'Status',
                'Due Date',
                'Days Overdue',
            ]);

            foreach ($report['tasks'] as $task) {
                fputcsv($handle, [
                    $report['month_label'],
                    $task->id,
                    $task->title,
                    $task->assignee ? $task->assignee->name : 'Unassigned',
                    ucfirst($task->priority),
                    ucfirst(str_replace('_', ' ', $task->status)),
                    $task->due_date ? $task->due_date->format('Y-m-d') : '',
                    $task->daysOverdue(),
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
        $query = $this->getFilteredTasksQuery();

        $perPage = (int) config('office.tasks_per_page', 10);
        if ($perPage <= 0) {
            $perPage = 10;
        }

        $tasks = $query->paginate($perPage);
        $allTasksForBoard = $this->activeView === 'board' ? (clone $query)->limit(100)->get() : collect();

        return view('livewire.task-tracker', [
            'tasks' => $tasks,
            'allTasksForBoard' => $allTasksForBoard,
        ]);
    }
}
