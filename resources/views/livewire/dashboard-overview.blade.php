<div class="flex flex-col gap-8 w-full">
    {{-- Header Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-zinc-200 dark:border-zinc-800">
        <div>
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center size-11 rounded-2xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-purple-600 text-white font-bold shadow-lg shadow-indigo-500/25">
                    <flux:icon name="chart-bar-square" class="size-6" />
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <flux:heading size="xl" class="font-extrabold tracking-tight text-zinc-900 dark:text-white">
                            ASTGD Office Dashboard
                        </flux:heading>
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400 px-2 py-0.5 rounded-full border border-emerald-200 dark:border-emerald-800">
                            <span class="size-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live Tracker
                        </span>
                    </div>
                    <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">
                        Click on any metric card or tab below to inspect pending, in progress, completed, or high priority tasks
                    </flux:text>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a
                href="{{ route('tasks') }}"
                wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-500/20 transition cursor-pointer"
            >
                <flux:icon name="clipboard-document-list" class="size-4" />
                <span>Go to Task Manager</span>
            </a>
        </div>
    </div>

    {{-- Interactive 5 Metric Cards (Clickable to Filter) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        {{-- Total Tasks --}}
        <button
            type="button"
            wire:click="selectStatusTab('all')"
            class="text-start relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border p-5 shadow-sm transition cursor-pointer {{ $selectedStatusTab === 'all' ? 'ring-2 ring-indigo-500 border-indigo-500' : 'border-zinc-200 dark:border-zinc-800 hover:border-zinc-300 dark:hover:border-zinc-700' }}"
        >
            <div class="flex items-center justify-between">
                <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Tasks</flux:text>
                <div class="p-2 rounded-xl bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300">
                    <flux:icon name="clipboard-document-list" class="size-5" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-zinc-900 dark:text-white">{{ $this->metrics['total'] }}</span>
                <span class="text-xs font-medium text-zinc-500">all tasks</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-[11px] text-zinc-400">
                <span>Click to view all</span>
                <flux:icon name="chevron-right" class="size-3.5" />
            </div>
        </button>

        {{-- Pending Tasks (Clickable) --}}
        <button
            type="button"
            wire:click="selectStatusTab('pending')"
            class="text-start relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border p-5 shadow-sm transition cursor-pointer {{ $selectedStatusTab === 'pending' ? 'ring-2 ring-amber-500 border-amber-500' : 'border-zinc-200 dark:border-zinc-800 hover:border-amber-300/60 dark:hover:border-amber-700/60' }}"
        >
            <div class="flex items-center justify-between">
                <flux:text class="text-xs font-semibold uppercase tracking-wider text-amber-600 dark:text-amber-400">Pending Tasks</flux:text>
                <div class="p-2 rounded-xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 border border-amber-200/50 dark:border-amber-800/50">
                    <flux:icon name="clock" class="size-5" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-amber-600 dark:text-amber-400">{{ $this->metrics['pending'] }}</span>
                <span class="text-xs font-medium text-zinc-500">awaiting start</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-[11px] text-amber-600 dark:text-amber-400 font-medium">
                <span>Click to view pending</span>
                <flux:icon name="chevron-right" class="size-3.5" />
            </div>
        </button>

        {{-- In Progress Tasks (Clickable) --}}
        <button
            type="button"
            wire:click="selectStatusTab('in_progress')"
            class="text-start relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border p-5 shadow-sm transition cursor-pointer {{ $selectedStatusTab === 'in_progress' ? 'ring-2 ring-blue-500 border-blue-500' : 'border-zinc-200 dark:border-zinc-800 hover:border-blue-300/60 dark:hover:border-blue-700/60' }}"
        >
            <div class="flex items-center justify-between">
                <flux:text class="text-xs font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">In Progress</flux:text>
                <div class="p-2 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50">
                    <flux:icon name="arrow-path" class="size-5" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-blue-600 dark:text-blue-400">{{ $this->metrics['in_progress'] }}</span>
                <span class="text-xs font-medium text-zinc-500">in progress</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-[11px] text-blue-600 dark:text-blue-400 font-medium">
                <span>Click to view active</span>
                <flux:icon name="chevron-right" class="size-3.5" />
            </div>
        </button>

        {{-- Completed Tasks (Clickable) --}}
        <button
            type="button"
            wire:click="selectStatusTab('completed')"
            class="text-start relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border p-5 shadow-sm transition cursor-pointer {{ $selectedStatusTab === 'completed' ? 'ring-2 ring-emerald-500 border-emerald-500' : 'border-zinc-200 dark:border-zinc-800 hover:border-emerald-300/60 dark:hover:border-emerald-700/60' }}"
        >
            <div class="flex items-center justify-between">
                <flux:text class="text-xs font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Completed</flux:text>
                <div class="p-2 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200/50 dark:border-emerald-800/50">
                    <flux:icon name="check" class="size-5" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ $this->metrics['completed'] }}</span>
                <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">{{ $this->metrics['completion_rate'] }}% done</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-[11px] text-emerald-600 dark:text-emerald-400 font-medium">
                <span>Click to view completed</span>
                <flux:icon name="chevron-right" class="size-3.5" />
            </div>
        </button>

        {{-- High Priority Tasks (Clickable) --}}
        <button
            type="button"
            wire:click="selectStatusTab('high_priority')"
            class="text-start relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border p-5 shadow-sm transition cursor-pointer {{ $selectedStatusTab === 'high_priority' ? 'ring-2 ring-rose-500 border-rose-500' : 'border-zinc-200 dark:border-zinc-800 hover:border-rose-300/60 dark:hover:border-rose-700/60' }}"
        >
            <div class="flex items-center justify-between">
                <flux:text class="text-xs font-semibold uppercase tracking-wider text-rose-600 dark:text-rose-400">High Priority</flux:text>
                <div class="p-2 rounded-xl bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-200/50 dark:border-rose-800/50">
                    <flux:icon name="fire" class="size-5" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-rose-600 dark:text-rose-400">{{ $this->metrics['high_priority'] }}</span>
                <span class="text-xs font-medium text-rose-500">high priority</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-[11px] text-rose-600 dark:text-rose-400 font-medium">
                <span>Click to view priority</span>
                <flux:icon name="chevron-right" class="size-3.5" />
            </div>
        </button>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left 2 Columns: Interactive Filtered Task View --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden">
                {{-- Task Status Tabs & Header --}}
                <div class="p-5 border-b border-zinc-200 dark:border-zinc-800 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h3 class="font-bold text-base text-zinc-900 dark:text-white capitalize">
                                {{ $selectedStatusTab === 'pending' ? 'Pending Tasks' : ($selectedStatusTab === 'completed' ? 'Completed Tasks' : ($selectedStatusTab === 'in_progress' ? 'In Progress Tasks' : ($selectedStatusTab === 'high_priority' ? 'High Priority Tasks' : 'All Office Tasks'))) }}
                            </h3>
                            <p class="text-xs text-zinc-500">Showing office work matching selected status</p>
                        </div>

                        {{-- Link to Open Filtered in Task Manager --}}
                        <a
                            href="{{ route('tasks', ['status' => ($selectedStatusTab === 'high_priority' ? 'all' : $selectedStatusTab), 'priority' => ($selectedStatusTab === 'high_priority' ? 'high' : 'all')]) }}"
                            wire:navigate
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60 hover:bg-indigo-100 transition"
                        >
                            <span>Open in Task Manager</span>
                            <flux:icon name="arrow-top-right-on-square" class="size-3.5" />
                        </a>
                    </div>

                    {{-- Status Switcher Filter Buttons --}}
                    <div class="flex flex-wrap items-center gap-1.5 p-1 bg-zinc-100 dark:bg-zinc-800/80 rounded-xl text-xs font-medium">
                        <button
                            type="button"
                            wire:click="selectStatusTab('pending')"
                            class="px-3 py-1.5 rounded-lg transition cursor-pointer flex items-center gap-1.5 {{ $selectedStatusTab === 'pending' ? 'bg-white dark:bg-zinc-700 text-amber-600 dark:text-amber-400 font-bold shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white' }}"
                        >
                            <span class="size-2 rounded-full bg-amber-500"></span>
                            <span>Pending ({{ $this->metrics['pending'] }})</span>
                        </button>

                        <button
                            type="button"
                            wire:click="selectStatusTab('in_progress')"
                            class="px-3 py-1.5 rounded-lg transition cursor-pointer flex items-center gap-1.5 {{ $selectedStatusTab === 'in_progress' ? 'bg-white dark:bg-zinc-700 text-blue-600 dark:text-blue-400 font-bold shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white' }}"
                        >
                            <span class="size-2 rounded-full bg-blue-500"></span>
                            <span>In Progress ({{ $this->metrics['in_progress'] }})</span>
                        </button>

                        <button
                            type="button"
                            wire:click="selectStatusTab('completed')"
                            class="px-3 py-1.5 rounded-lg transition cursor-pointer flex items-center gap-1.5 {{ $selectedStatusTab === 'completed' ? 'bg-white dark:bg-zinc-700 text-emerald-600 dark:text-emerald-400 font-bold shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white' }}"
                        >
                            <span class="size-2 rounded-full bg-emerald-500"></span>
                            <span>Completed ({{ $this->metrics['completed'] }})</span>
                        </button>

                        <button
                            type="button"
                            wire:click="selectStatusTab('high_priority')"
                            class="px-3 py-1.5 rounded-lg transition cursor-pointer flex items-center gap-1.5 {{ $selectedStatusTab === 'high_priority' ? 'bg-white dark:bg-zinc-700 text-rose-600 dark:text-rose-400 font-bold shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white' }}"
                        >
                            <span class="size-2 rounded-full bg-rose-500"></span>
                            <span>High Priority ({{ $this->metrics['high_priority'] }})</span>
                        </button>

                        <button
                            type="button"
                            wire:click="selectStatusTab('all')"
                            class="px-3 py-1.5 rounded-lg transition cursor-pointer flex items-center gap-1.5 {{ $selectedStatusTab === 'all' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white font-bold shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white' }}"
                        >
                            <span>All Tasks ({{ $this->metrics['total'] }})</span>
                        </button>
                    </div>
                </div>

                {{-- Task Items List --}}
                <div class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse ($this->filteredDashboardTasks as $task)
                        <div class="p-4 hover:bg-zinc-50/50 dark:hover:bg-zinc-800/40 transition flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-start gap-3 flex-1 min-w-0">
                                {{-- 1-Click Status Checkbox --}}
                                <button
                                    type="button"
                                    wire:click="updateTaskStatus({{ $task->id }}, '{{ $task->status === 'completed' ? 'in_progress' : 'completed' }}')"
                                    class="mt-0.5 flex size-5 shrink-0 items-center justify-center rounded-md border transition cursor-pointer {{ $task->status === 'completed' ? 'bg-emerald-500 border-emerald-500 text-white' : 'border-zinc-300 dark:border-zinc-600 hover:border-emerald-500' }}"
                                    title="{{ $task->status === 'completed' ? 'Mark In Progress' : 'Mark Completed' }}"
                                >
                                    @if ($task->status === 'completed')
                                        <flux:icon name="check" class="size-3.5 stroke-[3]" />
                                    @endif
                                </button>

                                <div class="space-y-1 min-w-0 flex-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h4 class="font-semibold text-sm text-zinc-900 dark:text-white {{ $task->status === 'completed' ? 'line-through text-zinc-400 dark:text-zinc-500' : '' }}">
                                            {{ $task->title }}
                                        </h4>

                                        {{-- Priority Badge --}}
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $task->priority === 'high' ? 'bg-rose-50 text-rose-700 dark:bg-rose-950 dark:text-rose-400 border border-rose-200' : ($task->priority === 'medium' ? 'bg-sky-50 text-sky-700 dark:bg-sky-950 dark:text-sky-400 border border-sky-200' : 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300') }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>

                                        {{-- Status Badge --}}
                                        <span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $task->status === 'completed' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400' : ($task->status === 'in_progress' ? 'bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-400' : 'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-400') }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </div>

                                    @if ($task->description)
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-1">
                                            {{ $task->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-3 shrink-0 text-xs">
                                {{-- Assignee --}}
                                @if ($task->assignee)
                                    <div class="flex items-center gap-1.5 bg-zinc-50 dark:bg-zinc-800 px-2.5 py-1 rounded-lg border border-zinc-200 dark:border-zinc-700">
                                        <div class="size-5 rounded-full bg-indigo-500 text-white text-[10px] font-bold flex items-center justify-center">
                                            {{ $task->assignee->initials() }}
                                        </div>
                                        <span class="font-medium text-zinc-700 dark:text-zinc-300 truncate max-w-[100px]">{{ $task->assignee->name }}</span>
                                    </div>
                                @else
                                    <span class="text-zinc-400 italic">Unassigned</span>
                                @endif

                                {{-- Due Date / Done info --}}
                                <div class="text-end">
                                    @if ($task->status === 'completed')
                                        <span class="text-emerald-600 text-[11px] font-medium">Done</span>
                                    @elseif ($task->isOverdue())
                                        <span class="font-bold text-rose-600 bg-rose-50 dark:bg-rose-950/60 px-2 py-0.5 rounded border border-rose-200 text-[11px]">
                                            Overdue
                                        </span>
                                    @elseif ($task->due_date)
                                        <span class="text-zinc-500 font-medium text-[11px]">
                                            Due {{ $task->due_date->format('M d') }}
                                        </span>
                                    @endif
                                </div>

                                {{-- View Details Modal Button --}}
                                <button
                                    type="button"
                                    wire:click="openViewModal({{ $task->id }})"
                                    class="p-1.5 rounded-lg text-zinc-400 hover:text-indigo-600 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition cursor-pointer"
                                    title="View Task Details"
                                >
                                    <flux:icon name="eye" class="size-4" />
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-zinc-500">
                            <flux:icon name="inbox" class="size-10 mx-auto text-zinc-300 dark:text-zinc-600 mb-2" />
                            <p class="font-semibold text-zinc-700 dark:text-zinc-300 capitalize">No {{ str_replace('_', ' ', $selectedStatusTab) }} tasks found</p>
                            <p class="text-xs text-zinc-400 mt-1">Great job! There are no tasks currently in this category.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Footer Link --}}
                <div class="p-4 bg-zinc-50/75 dark:bg-zinc-800/40 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                    <span class="text-xs text-zinc-500">Showing top results on Dashboard</span>
                    <a
                        href="{{ route('tasks', ['status' => ($selectedStatusTab === 'high_priority' ? 'all' : $selectedStatusTab), 'priority' => ($selectedStatusTab === 'high_priority' ? 'high' : 'all')]) }}"
                        wire:navigate
                        class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1"
                    >
                        <span>Manage all in Task Manager</span>
                        <flux:icon name="arrow-right" class="size-3.5" />
                    </a>
                </div>
            </div>
        </div>

        {{-- Right 1 Column: Team Workload & Distribution --}}
        <div class="space-y-6">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <flux:icon name="users" class="size-5 text-indigo-500" />
                        <div>
                            <h3 class="font-bold text-base text-zinc-900 dark:text-white">Team Workload</h3>
                            <p class="text-xs text-zinc-400">Click a member to view their tasks</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    @foreach ($this->teamWorkload as $member)
                        <a
                            href="{{ route('tasks', ['assignee' => $member->id]) }}"
                            wire:navigate
                            class="block p-3.5 rounded-xl border border-zinc-200 dark:border-zinc-800 hover:border-indigo-300 dark:hover:border-indigo-700 hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50 transition cursor-pointer space-y-3"
                        >
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-gradient-to-tr from-indigo-500 to-purple-600 text-white font-bold text-xs shadow-sm">
                                        {{ $member->initials() }}
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="font-bold text-xs text-zinc-900 dark:text-white truncate">{{ $member->name }}</p>
                                        <p class="text-[10px] text-zinc-400">{{ $member->total_tasks_count }} assigned tasks</p>
                                    </div>
                                </div>
                                <span class="text-xs font-extrabold text-indigo-600 dark:text-indigo-400">
                                    {{ $member->total_tasks_count > 0 ? round(($member->completed_tasks_count / $member->total_tasks_count) * 100) : 0 }}%
                                </span>
                            </div>

                            <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $member->total_tasks_count > 0 ? ($member->completed_tasks_count / $member->total_tasks_count) * 100 : 0 }}%"></div>
                            </div>

                            <div class="flex items-center justify-between text-[10px] font-semibold text-zinc-500 pt-1">
                                <span class="text-amber-600">{{ $member->pending_tasks_count }} Pending</span>
                                <span class="text-blue-600">{{ $member->in_progress_tasks_count }} Active</span>
                                <span class="text-emerald-600">{{ $member->completed_tasks_count }} Done</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="pt-2">
                    <a
                        href="{{ route('tasks') }}"
                        wire:navigate
                        class="block w-full text-center py-2 px-3 rounded-xl bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-xs font-semibold text-zinc-700 dark:text-zinc-200 transition cursor-pointer"
                    >
                        Manage All Tasks
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Details View Modal --}}
    <flux:modal wire:model="showViewModal" class="md:w-[600px]">
        @if ($this->viewingTask)
            <div class="space-y-5">
                <div class="pb-3 border-b border-zinc-200 dark:border-zinc-800 space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold px-2.5 py-0.5 rounded-full {{ $this->viewingTask->priority === 'high' ? 'bg-rose-50 text-rose-700 border border-rose-200' : ($this->viewingTask->priority === 'medium' ? 'bg-sky-50 text-sky-700 border border-sky-200' : 'bg-zinc-100 text-zinc-700') }}">
                            {{ ucfirst($this->viewingTask->priority) }} Priority
                        </span>
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-lg {{ $this->viewingTask->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : ($this->viewingTask->status === 'in_progress' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700') }}">
                            {{ ucfirst(str_replace('_', ' ', $this->viewingTask->status)) }}
                        </span>
                    </div>
                    <flux:heading size="lg" class="font-bold text-zinc-900 dark:text-white">
                        {{ $this->viewingTask->title }}
                    </flux:heading>
                </div>

                <div class="space-y-1.5">
                    <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Description</flux:text>
                    <p class="text-sm text-zinc-700 dark:text-zinc-300 p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/50">
                        {{ $this->viewingTask->description ?: 'No description provided.' }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-xl border border-zinc-200 dark:border-zinc-800 space-y-1">
                        <span class="font-semibold text-zinc-400 uppercase tracking-wider text-[10px]">Assigned To</span>
                        <p class="font-bold text-zinc-900 dark:text-white">{{ $this->viewingTask->assignee ? $this->viewingTask->assignee->name : 'Unassigned' }}</p>
                    </div>
                    <div class="p-3 rounded-xl border border-zinc-200 dark:border-zinc-800 space-y-1">
                        <span class="font-semibold text-zinc-400 uppercase tracking-wider text-[10px]">Due Date</span>
                        <p class="font-bold text-zinc-900 dark:text-white">{{ $this->viewingTask->due_date ? $this->viewingTask->due_date->format('M d, Y') : 'No deadline' }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-zinc-200 dark:border-zinc-800">
                    <flux:button variant="ghost" wire:click="$set('showViewModal', false)">
                        Close
                    </flux:button>
                    <a
                        href="{{ route('tasks') }}"
                        wire:navigate
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-xs font-semibold hover:bg-indigo-700 transition"
                    >
                        Open in Task Manager
                    </a>
                </div>
            </div>
        @endif
    </flux:modal>
</div>
