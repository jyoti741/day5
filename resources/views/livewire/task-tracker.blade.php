<div class="flex flex-col gap-6 w-full">
    {{-- Header Banner & Actions --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pb-2 border-b border-zinc-200 dark:border-zinc-700">
        <div>
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center size-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold shadow-md shadow-indigo-500/20">
                    <flux:icon name="check-circle" class="size-6" />
                </div>
                <div>
                    <flux:heading size="xl" class="font-bold tracking-tight text-zinc-900 dark:text-white">
                        Task Management System
                    </flux:heading>
                    <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">
                        Create, assign, track priorities, deadlines, and completion of office tasks
                    </flux:text>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            {{-- View Switcher Buttons --}}
            <div class="inline-flex rounded-lg p-1 bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-xs">
                <button
                    type="button"
                    wire:click="$set('activeView', 'list')"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-md font-medium transition {{ $activeView === 'list' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white' }}"
                >
                    <flux:icon name="bars-3" class="size-4" />
                    <span>Task List</span>
                </button>
                <button
                    type="button"
                    wire:click="$set('activeView', 'board')"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-md font-medium transition {{ $activeView === 'board' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white' }}"
                >
                    <flux:icon name="squares-2x2" class="size-4" />
                    <span>Board View</span>
                </button>
                <button
                    type="button"
                    wire:click="$set('activeView', 'team')"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-md font-medium transition {{ $activeView === 'team' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white' }}"
                >
                    <flux:icon name="users" class="size-4" />
                    <span>Assigned Team</span>
                </button>
            </div>

            <flux:button variant="primary" icon="plus" wire:click="openCreateModal" class="cursor-pointer shadow-sm">
                Add New Task
            </flux:button>
        </div>
    </div>

    {{-- Top 5 Metric Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        {{-- Total Tasks --}}
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm hover:border-zinc-300 dark:hover:border-zinc-700 transition">
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
            <div class="mt-3 flex items-center gap-2">
                <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-indigo-500 h-full rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>

        {{-- Pending Tasks --}}
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm hover:border-amber-300/50 dark:hover:border-amber-700/50 transition">
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
            <div class="mt-3">
                <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-amber-500 h-full rounded-full" style="width: {{ $this->metrics['total'] > 0 ? ($this->metrics['pending'] / $this->metrics['total']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        {{-- In Progress Tasks --}}
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm hover:border-blue-300/50 dark:hover:border-blue-700/50 transition">
            <div class="flex items-center justify-between">
                <flux:text class="text-xs font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">In Progress</flux:text>
                <div class="p-2 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50">
                    <flux:icon name="arrow-path" class="size-5" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-blue-600 dark:text-blue-400">{{ $this->metrics['in_progress'] }}</span>
                <span class="text-xs font-medium text-zinc-500">actively working</span>
            </div>
            <div class="mt-3">
                <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-blue-500 h-full rounded-full" style="width: {{ $this->metrics['total'] > 0 ? ($this->metrics['in_progress'] / $this->metrics['total']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        {{-- Completed Tasks --}}
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm hover:border-emerald-300/50 dark:hover:border-emerald-700/50 transition">
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
            <div class="mt-3">
                <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full" style="width: {{ $this->metrics['completion_rate'] }}%"></div>
                </div>
            </div>
        </div>

        {{-- High Priority Tasks --}}
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm hover:border-rose-300/50 dark:hover:border-rose-700/50 transition">
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
            <div class="mt-3">
                <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-rose-500 h-full rounded-full" style="width: {{ $this->metrics['total'] > 0 ? ($this->metrics['high_priority'] / $this->metrics['total']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter and Search Control Bar --}}
    <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-3 bg-white dark:bg-zinc-900 p-4 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
        {{-- Search Input --}}
        <div class="flex-1 relative">
            <flux:input
                wire:model.live.debounce.250ms="search"
                icon="magnifying-glass"
                placeholder="Search tasks by title, description, or assigned person's name..."
                class="w-full"
                clearable
            />
        </div>

        {{-- Filter dropdowns --}}
        <div class="flex flex-wrap items-center gap-2">
            {{-- Status Filter (All, Pending, In Progress, Completed) --}}
            <flux:select wire:model.live="statusFilter" class="min-w-[130px]" placeholder="Status">
                <flux:select.option value="all">All</flux:select.option>
                <flux:select.option value="pending">Pending</flux:select.option>
                <flux:select.option value="in_progress">In Progress</flux:select.option>
                <flux:select.option value="completed">Completed</flux:select.option>
            </flux:select>

            {{-- Priority Filter (All, Low, Medium, High) --}}
            <flux:select wire:model.live="priorityFilter" class="min-w-[130px]" placeholder="Priority">
                <flux:select.option value="all">All</flux:select.option>
                <flux:select.option value="low">Low</flux:select.option>
                <flux:select.option value="medium">Medium</flux:select.option>
                <flux:select.option value="high">High</flux:select.option>
            </flux:select>

            {{-- Assigned To Filter --}}
            <flux:select wire:model.live="assigneeFilter" class="min-w-[160px]" placeholder="Assigned To">
                <flux:select.option value="all">All Assigned Users</flux:select.option>
                <flux:select.option value="unassigned">Unassigned</flux:select.option>
                @foreach ($this->users as $u)
                    <flux:select.option value="{{ $u->id }}">{{ $u->name }}</flux:select.option>
                @endforeach
            </flux:select>

            {{-- Sort By --}}
            <flux:select wire:model.live="sortBy" class="min-w-[160px]" placeholder="Sort By">
                <flux:select.option value="deadline_asc">Due Date (Soonest)</flux:select.option>
                <flux:select.option value="deadline_desc">Due Date (Latest)</flux:select.option>
                <flux:select.option value="created_desc">Created Date (Newest)</flux:select.option>
                <flux:select.option value="created_asc">Created Date (Oldest)</flux:select.option>
                <flux:select.option value="priority_desc">Priority (Highest)</flux:select.option>
            </flux:select>

            {{-- Reset Filters Button (when any filter is active) --}}
            @if ($statusFilter !== 'all' || $priorityFilter !== 'all' || $assigneeFilter !== 'all' || !empty($search))
                <button
                    type="button"
                    wire:click="resetFilters"
                    class="px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/60 hover:bg-rose-100 dark:hover:bg-rose-900/60 transition cursor-pointer flex items-center gap-1"
                    title="Reset all filters"
                >
                    <flux:icon name="x-mark" class="size-3.5" />
                    <span>Reset Filters</span>
                </button>
            @endif
        </div>
    </div>

    {{-- Active Filter Pills --}}
    @if ($statusFilter !== 'all' || $priorityFilter !== 'all' || $assigneeFilter !== 'all' || !empty($search))
        <div class="flex flex-wrap items-center gap-2 text-xs">
            <span class="text-zinc-400 font-medium">Active Filters:</span>

            @if ($statusFilter !== 'all')
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-800">
                    <span>Status: <strong>{{ ucfirst(str_replace('_', ' ', $statusFilter)) }}</strong></span>
                    <button type="button" wire:click="$set('statusFilter', 'all')" class="hover:text-rose-600 cursor-pointer">
                        <flux:icon name="x-mark" class="size-3" />
                    </button>
                </span>
            @endif

            @if ($priorityFilter !== 'all')
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-800">
                    <span>Priority: <strong>{{ ucfirst($priorityFilter) }}</strong></span>
                    <button type="button" wire:click="$set('priorityFilter', 'all')" class="hover:text-rose-600 cursor-pointer">
                        <flux:icon name="x-mark" class="size-3" />
                    </button>
                </span>
            @endif

            @if ($assigneeFilter !== 'all')
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-800">
                    <span>Assignee: <strong>{{ $assigneeFilter === 'unassigned' ? 'Unassigned' : ($this->users->find($assigneeFilter)->name ?? 'User') }}</strong></span>
                    <button type="button" wire:click="$set('assigneeFilter', 'all')" class="hover:text-rose-600 cursor-pointer">
                        <flux:icon name="x-mark" class="size-3" />
                    </button>
                </span>
            @endif

            @if (!empty($search))
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-800">
                    <span>Search: "<strong>{{ $search }}</strong>"</span>
                    <button type="button" wire:click="$set('search', '')" class="hover:text-rose-600 cursor-pointer">
                        <flux:icon name="x-mark" class="size-3" />
                    </button>
                </span>
            @endif
        </div>
    @endif

    {{-- VIEW MODE 1: Table / Task List View --}}
    @if ($activeView === 'list')
        <div class="overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-start text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200 dark:border-zinc-800 bg-zinc-50/75 dark:bg-zinc-800/50 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                            <th class="py-3.5 px-4 text-start">Task Title & Description</th>
                            <th class="py-3.5 px-4 text-start">Assigned To</th>
                            <th class="py-3.5 px-4 text-start">Priority</th>
                            <th class="py-3.5 px-4 text-start">Status</th>
                            <th class="py-3.5 px-4 text-start">Due Date</th>
                            <th class="py-3.5 px-4 text-start">Created Date</th>
                            <th class="py-3.5 px-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse ($tasks as $task)
                            <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/40 transition group">
                                {{-- Task Title & Description --}}
                                <td class="py-4 px-4 align-top max-w-sm">
                                    <div class="flex items-start gap-3">
                                        {{-- 1-Click Status Quick Completion Checkbox --}}
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

                                        <div class="space-y-1">
                                            <span class="font-semibold text-zinc-900 dark:text-zinc-100 {{ $task->status === 'completed' ? 'line-through text-zinc-400 dark:text-zinc-500' : '' }}">
                                                {{ $task->title }}
                                            </span>
                                            @if ($task->description)
                                                <p class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                                    {{ $task->description }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Assigned To --}}
                                <td class="py-4 px-4 align-top whitespace-nowrap">
                                    @if ($task->assignee)
                                        <div class="flex items-center gap-2">
                                            <div class="flex size-7 shrink-0 items-center justify-center rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 text-white text-xs font-bold shadow-sm">
                                                {{ $task->assignee->initials() }}
                                            </div>
                                            <div class="leading-tight">
                                                <p class="text-xs font-semibold text-zinc-900 dark:text-zinc-100">{{ $task->assignee->name }}</p>
                                                <p class="text-[11px] text-zinc-400 truncate max-w-[130px]">{{ $task->assignee->email }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-xs text-zinc-400 italic">
                                            <flux:icon name="user" class="size-3.5" />
                                            Unassigned
                                        </span>
                                    @endif
                                </td>

                                {{-- Priority (Low, Medium, High) with quick dropdown --}}
                                <td class="py-4 px-4 align-top whitespace-nowrap">
                                    <flux:dropdown>
                                        <button type="button" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border transition cursor-pointer
                                            {{ $task->priority === 'high' ? 'bg-rose-50 text-rose-700 dark:bg-rose-950/60 dark:text-rose-400 border-rose-200 dark:border-rose-800' :
                                               ($task->priority === 'medium' ? 'bg-sky-50 text-sky-700 dark:bg-sky-950/60 dark:text-sky-400 border-sky-200 dark:border-sky-800' :
                                               'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 border-zinc-200 dark:border-zinc-700') }}"
                                            title="Click to change Priority">
                                            <span class="size-1.5 rounded-full {{ $task->priority === 'high' ? 'bg-rose-500' : ($task->priority === 'medium' ? 'bg-sky-500' : 'bg-zinc-400') }}"></span>
                                            <span>{{ ucfirst($task->priority) }}</span>
                                            <flux:icon name="chevron-down" class="size-3 opacity-60" />
                                        </button>

                                        <flux:menu>
                                            <flux:menu.item wire:click="updateTaskPriority({{ $task->id }}, 'high')" class="text-rose-600">
                                                High Priority
                                            </flux:menu.item>
                                            <flux:menu.item wire:click="updateTaskPriority({{ $task->id }}, 'medium')" class="text-sky-600">
                                                Medium Priority
                                            </flux:menu.item>
                                            <flux:menu.item wire:click="updateTaskPriority({{ $task->id }}, 'low')" class="text-zinc-600">
                                                Low Priority
                                            </flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>

                                {{-- Status (Pending, In Progress, Completed) with quick dropdown --}}
                                <td class="py-4 px-4 align-top whitespace-nowrap">
                                    <flux:dropdown>
                                        <button type="button" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold border transition cursor-pointer
                                            {{ $task->status === 'completed' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800' :
                                               ($task->status === 'in_progress' ? 'bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-400 border-blue-200 dark:border-blue-800' :
                                               'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-400 border-amber-200 dark:border-amber-800') }}"
                                            title="Click to change Status">
                                            <span>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                                            <flux:icon name="chevron-down" class="size-3 opacity-60" />
                                        </button>

                                        <flux:menu>
                                            <flux:menu.item wire:click="updateTaskStatus({{ $task->id }}, 'pending')" icon="clock">
                                                Pending
                                            </flux:menu.item>
                                            <flux:menu.item wire:click="updateTaskStatus({{ $task->id }}, 'in_progress')" icon="arrow-path">
                                                In Progress
                                            </flux:menu.item>
                                            <flux:menu.item wire:click="updateTaskStatus({{ $task->id }}, 'completed')" icon="check">
                                                Completed
                                            </flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>

                                {{-- Due Date --}}
                                <td class="py-4 px-4 align-top whitespace-nowrap">
                                    @if ($task->due_date)
                                        <div class="space-y-0.5">
                                            <div class="flex items-center gap-1.5 text-xs font-medium text-zinc-800 dark:text-zinc-200">
                                                <flux:icon name="calendar" class="size-3.5 text-zinc-400" />
                                                <span>{{ $task->due_date->format('M d, Y') }}</span>
                                            </div>
                                            @if ($task->status === 'completed')
                                                <span class="text-[11px] text-emerald-600 dark:text-emerald-400 flex items-center gap-0.5">
                                                    Done {{ $task->completed_at ? $task->completed_at->diffForHumans() : '' }}
                                                </span>
                                            @elseif ($task->isOverdue())
                                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/60 px-1.5 py-0.5 rounded border border-rose-200 dark:border-rose-800">
                                                    <flux:icon name="exclamation-triangle" class="size-3" />
                                                    Overdue by {{ $task->due_date->diffInDays(now()) }}d
                                                </span>
                                            @elseif ($task->due_date->isToday())
                                                <span class="text-[11px] font-semibold text-amber-600 dark:text-amber-400">
                                                    Due Today
                                                </span>
                                            @else
                                                <span class="text-[11px] text-zinc-500 dark:text-zinc-400">
                                                    In {{ $task->due_date->diffInDays(now()) }} days
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-xs text-zinc-400 italic">No due date</span>
                                    @endif
                                </td>

                                {{-- Created Date --}}
                                <td class="py-4 px-4 align-top whitespace-nowrap">
                                    <div class="space-y-0.5 text-xs text-zinc-600 dark:text-zinc-400">
                                        <div class="font-medium text-zinc-800 dark:text-zinc-200">
                                            {{ $task->created_at ? $task->created_at->format('M d, Y') : '-' }}
                                        </div>
                                        <div class="text-[11px] text-zinc-400">
                                            {{ $task->created_at ? $task->created_at->diffForHumans() : '' }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Actions (View, Edit, Delete) --}}
                                <td class="py-4 px-4 align-top text-end whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1">
                                        {{-- View Option --}}
                                        <button
                                            type="button"
                                            wire:click="openViewModal({{ $task->id }})"
                                            class="p-1.5 rounded-lg text-zinc-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/50 transition cursor-pointer"
                                            title="View Task Details"
                                        >
                                            <flux:icon name="eye" class="size-4" />
                                        </button>

                                        {{-- Edit Option --}}
                                        <button
                                            type="button"
                                            wire:click="openEditModal({{ $task->id }})"
                                            class="p-1.5 rounded-lg text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 transition cursor-pointer"
                                            title="Edit Task"
                                        >
                                            <flux:icon name="pencil-square" class="size-4" />
                                        </button>

                                        {{-- Delete Option --}}
                                        <button
                                            type="button"
                                            wire:click="confirmDelete({{ $task->id }})"
                                            class="p-1.5 rounded-lg text-zinc-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/50 transition cursor-pointer"
                                            title="Delete Task"
                                        >
                                            <flux:icon name="trash" class="size-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-zinc-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <flux:icon name="inbox" class="size-10 text-zinc-300 dark:text-zinc-600" />
                                        <p class="font-semibold text-zinc-700 dark:text-zinc-300">No tasks found matching selected criteria</p>
                                        <p class="text-xs text-zinc-400">Try adjusting your Status or Priority filter options, or clear them to see all tasks.</p>
                                        @if ($statusFilter !== 'all' || $priorityFilter !== 'all' || $assigneeFilter !== 'all' || !empty($search))
                                            <button
                                                type="button"
                                                wire:click="resetFilters"
                                                class="mt-2 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60 hover:bg-indigo-100 transition cursor-pointer"
                                            >
                                                Clear All Filters
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($tasks->hasPages())
                <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>

    {{-- VIEW MODE 2: Kanban Board View --}}
    @elseif ($activeView === 'board')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Column: Pending --}}
            <div class="flex flex-col gap-4 bg-zinc-50/75 dark:bg-zinc-900/60 p-4 rounded-2xl border border-zinc-200 dark:border-zinc-800">
                <div class="flex items-center justify-between pb-2 border-b border-amber-200 dark:border-amber-900/50">
                    <div class="flex items-center gap-2">
                        <span class="size-2.5 rounded-full bg-amber-500"></span>
                        <h3 class="font-bold text-sm text-zinc-900 dark:text-white">Pending</h3>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-950/80 text-amber-700 dark:text-amber-300">
                        {{ $allTasksForBoard->where('status', 'pending')->count() }}
                    </span>
                </div>

                <div class="flex flex-col gap-3 min-h-[300px]">
                    @forelse ($allTasksForBoard->where('status', 'pending') as $bTask)
                        <div class="bg-white dark:bg-zinc-800 p-4 rounded-xl border border-zinc-200 dark:border-zinc-700/80 shadow-sm space-y-3 hover:shadow-md transition">
                            <div class="flex items-start justify-between gap-2">
                                <span class="text-[11px] font-semibold px-2 py-0.5 rounded {{ $bTask->priority === 'high' ? 'bg-rose-50 text-rose-700 dark:bg-rose-950 dark:text-rose-400 border border-rose-200' : ($bTask->priority === 'medium' ? 'bg-sky-50 text-sky-700 dark:bg-sky-950 dark:text-sky-400 border border-sky-200' : 'bg-zinc-100 text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 border border-zinc-200') }}">
                                    {{ ucfirst($bTask->priority) }} Priority
                                </span>
                                <div class="flex items-center gap-1">
                                    <button
                                        type="button"
                                        wire:click="openViewModal({{ $bTask->id }})"
                                        class="p-1 rounded text-zinc-400 hover:text-indigo-600 transition"
                                        title="View Details"
                                    >
                                        <flux:icon name="eye" class="size-3.5" />
                                    </button>
                                    <span class="text-[10px] text-zinc-400">Due {{ $bTask->due_date ? $bTask->due_date->format('M d') : '-' }}</span>
                                </div>
                            </div>
                            <h4 class="font-semibold text-sm text-zinc-900 dark:text-white leading-snug">{{ $bTask->title }}</h4>
                            @if ($bTask->description)
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-2">{{ $bTask->description }}</p>
                            @endif
                            <div class="flex items-center justify-between pt-2 border-t border-zinc-100 dark:border-zinc-700 text-xs">
                                <div class="flex items-center gap-1.5">
                                    @if ($bTask->assignee)
                                        <div class="size-5 rounded-full bg-indigo-500 text-white text-[10px] font-bold flex items-center justify-center">
                                            {{ $bTask->assignee->initials() }}
                                        </div>
                                        <span class="text-zinc-600 dark:text-zinc-300 font-medium truncate max-w-[100px]">{{ $bTask->assignee->name }}</span>
                                    @else
                                        <span class="text-zinc-400 italic">Unassigned</span>
                                    @endif
                                </div>
                                <button
                                    type="button"
                                    wire:click="updateTaskStatus({{ $bTask->id }}, 'in_progress')"
                                    class="text-xs text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 cursor-pointer"
                                >
                                    <span>Start</span>
                                    <flux:icon name="arrow-right" class="size-3" />
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-zinc-400 italic">No pending tasks</div>
                    @endforelse
                </div>
            </div>

            {{-- Column: In Progress --}}
            <div class="flex flex-col gap-4 bg-zinc-50/75 dark:bg-zinc-900/60 p-4 rounded-2xl border border-zinc-200 dark:border-zinc-800">
                <div class="flex items-center justify-between pb-2 border-b border-blue-200 dark:border-blue-900/50">
                    <div class="flex items-center gap-2">
                        <span class="size-2.5 rounded-full bg-blue-500"></span>
                        <h3 class="font-bold text-sm text-zinc-900 dark:text-white">In Progress</h3>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-950/80 text-blue-700 dark:text-blue-300">
                        {{ $allTasksForBoard->where('status', 'in_progress')->count() }}
                    </span>
                </div>

                <div class="flex flex-col gap-3 min-h-[300px]">
                    @forelse ($allTasksForBoard->where('status', 'in_progress') as $bTask)
                        <div class="bg-white dark:bg-zinc-800 p-4 rounded-xl border border-zinc-200 dark:border-zinc-700/80 shadow-sm space-y-3 hover:shadow-md transition">
                            <div class="flex items-start justify-between gap-2">
                                <span class="text-[11px] font-semibold px-2 py-0.5 rounded {{ $bTask->priority === 'high' ? 'bg-rose-50 text-rose-700 dark:bg-rose-950 dark:text-rose-400 border border-rose-200' : ($bTask->priority === 'medium' ? 'bg-sky-50 text-sky-700 dark:bg-sky-950 dark:text-sky-400 border border-sky-200' : 'bg-zinc-100 text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 border border-zinc-200') }}">
                                    {{ ucfirst($bTask->priority) }} Priority
                                </span>
                                <div class="flex items-center gap-1">
                                    <button
                                        type="button"
                                        wire:click="openViewModal({{ $bTask->id }})"
                                        class="p-1 rounded text-zinc-400 hover:text-indigo-600 transition"
                                        title="View Details"
                                    >
                                        <flux:icon name="eye" class="size-3.5" />
                                    </button>
                                    <span class="text-[10px] text-zinc-400">Due {{ $bTask->due_date ? $bTask->due_date->format('M d') : '-' }}</span>
                                </div>
                            </div>
                            <h4 class="font-semibold text-sm text-zinc-900 dark:text-white leading-snug">{{ $bTask->title }}</h4>
                            @if ($bTask->description)
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-2">{{ $bTask->description }}</p>
                            @endif
                            <div class="flex items-center justify-between pt-2 border-t border-zinc-100 dark:border-zinc-700 text-xs">
                                <div class="flex items-center gap-1.5">
                                    @if ($bTask->assignee)
                                        <div class="size-5 rounded-full bg-indigo-500 text-white text-[10px] font-bold flex items-center justify-center">
                                            {{ $bTask->assignee->initials() }}
                                        </div>
                                        <span class="text-zinc-600 dark:text-zinc-300 font-medium truncate max-w-[100px]">{{ $bTask->assignee->name }}</span>
                                    @else
                                        <span class="text-zinc-400 italic">Unassigned</span>
                                    @endif
                                </div>
                                <button
                                    type="button"
                                    wire:click="updateTaskStatus({{ $bTask->id }}, 'completed')"
                                    class="text-xs text-emerald-600 hover:text-emerald-700 font-medium flex items-center gap-1 cursor-pointer"
                                >
                                    <span>Complete</span>
                                    <flux:icon name="check" class="size-3" />
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-zinc-400 italic">No tasks in progress</div>
                    @endforelse
                </div>
            </div>

            {{-- Column: Completed --}}
            <div class="flex flex-col gap-4 bg-zinc-50/75 dark:bg-zinc-900/60 p-4 rounded-2xl border border-zinc-200 dark:border-zinc-800">
                <div class="flex items-center justify-between pb-2 border-b border-emerald-200 dark:border-emerald-900/50">
                    <div class="flex items-center gap-2">
                        <span class="size-2.5 rounded-full bg-emerald-500"></span>
                        <h3 class="font-bold text-sm text-zinc-900 dark:text-white">Completed</h3>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">
                        {{ $allTasksForBoard->where('status', 'completed')->count() }}
                    </span>
                </div>

                <div class="flex flex-col gap-3 min-h-[300px]">
                    @forelse ($allTasksForBoard->where('status', 'completed') as $bTask)
                        <div class="bg-white/80 dark:bg-zinc-800/80 p-4 rounded-xl border border-zinc-200 dark:border-zinc-700/80 shadow-sm space-y-3 opacity-80 hover:opacity-100 transition">
                            <div class="flex items-start justify-between gap-2">
                                <span class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1">
                                    <flux:icon name="check" class="size-3" /> Completed
                                </span>
                                <div class="flex items-center gap-1">
                                    <button
                                        type="button"
                                        wire:click="openViewModal({{ $bTask->id }})"
                                        class="p-1 rounded text-zinc-400 hover:text-indigo-600 transition"
                                        title="View Details"
                                    >
                                        <flux:icon name="eye" class="size-3.5" />
                                    </button>
                                    <span class="text-[10px] text-zinc-400">Done {{ $bTask->completed_at ? $bTask->completed_at->format('M d') : '' }}</span>
                                </div>
                            </div>
                            <h4 class="font-semibold text-sm text-zinc-700 dark:text-zinc-300 line-through leading-snug">{{ $bTask->title }}</h4>
                            <div class="flex items-center justify-between pt-2 border-t border-zinc-100 dark:border-zinc-700 text-xs">
                                <div class="flex items-center gap-1.5">
                                    @if ($bTask->assignee)
                                        <div class="size-5 rounded-full bg-zinc-400 text-white text-[10px] font-bold flex items-center justify-center">
                                            {{ $bTask->assignee->initials() }}
                                        </div>
                                        <span class="text-zinc-500 font-medium truncate max-w-[100px]">{{ $bTask->assignee->name }}</span>
                                    @endif
                                </div>
                                <button
                                    type="button"
                                    wire:click="updateTaskStatus({{ $bTask->id }}, 'in_progress')"
                                    class="text-xs text-zinc-400 hover:text-zinc-600 font-medium cursor-pointer"
                                >
                                    Reopen
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-zinc-400 italic">No completed tasks yet</div>
                    @endforelse
                </div>
            </div>
        </div>

    {{-- VIEW MODE 3: Assigned Team Overview --}}
    @elseif ($activeView === 'team')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($this->teamWorkload as $member)
                <div class="bg-white dark:bg-zinc-900 p-5 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-600 text-white font-bold text-base shadow-sm">
                            {{ $member->initials() }}
                        </div>
                        <div class="overflow-hidden">
                            <h4 class="font-bold text-zinc-900 dark:text-white truncate">{{ $member->name }}</h4>
                            <p class="text-xs text-zinc-400 truncate">{{ $member->email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800 text-center">
                        <div class="p-2 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200/40 dark:border-amber-800/40">
                            <span class="text-lg font-bold text-amber-600 dark:text-amber-400">{{ $member->pending_tasks_count }}</span>
                            <p class="text-[10px] uppercase font-semibold text-amber-600/80 tracking-wider">Pending</p>
                        </div>
                        <div class="p-2 rounded-xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200/40 dark:border-blue-800/40">
                            <span class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $member->in_progress_tasks_count }}</span>
                            <p class="text-[10px] uppercase font-semibold text-blue-600/80 tracking-wider">In Progress</p>
                        </div>
                        <div class="p-2 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/40 dark:border-emerald-800/40">
                            <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $member->completed_tasks_count }}</span>
                            <p class="text-[10px] uppercase font-semibold text-emerald-600/80 tracking-wider">Completed</p>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <div class="flex justify-between text-xs font-medium text-zinc-500">
                            <span>Total Assigned: {{ $member->total_tasks_count }}</span>
                            <span>{{ $member->total_tasks_count > 0 ? round(($member->completed_tasks_count / $member->total_tasks_count) * 100) : 0 }}% completed</span>
                        </div>
                        <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-2 rounded-full overflow-hidden">
                            <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $member->total_tasks_count > 0 ? ($member->completed_tasks_count / $member->total_tasks_count) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button
                            type="button"
                            wire:click="$set('assigneeFilter', '{{ $member->id }}'); $set('activeView', 'list');"
                            class="w-full py-1.5 px-3 rounded-lg text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 transition cursor-pointer"
                        >
                            View Tasks Assigned To {{ $member->name }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- VIEW TASK DETAILS MODAL --}}
    <flux:modal wire:model="showViewModal" class="md:w-[620px]">
        @if ($this->viewingTask)
            <div class="space-y-6">
                {{-- Modal Header --}}
                <div class="flex items-start justify-between gap-4 pb-4 border-b border-zinc-200 dark:border-zinc-800">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold
                                {{ $this->viewingTask->priority === 'high' ? 'bg-rose-50 text-rose-700 dark:bg-rose-950/60 dark:text-rose-400 border border-rose-200 dark:border-rose-800' :
                                   ($this->viewingTask->priority === 'medium' ? 'bg-sky-50 text-sky-700 dark:bg-sky-950/60 dark:text-sky-400 border border-sky-200 dark:border-sky-800' :
                                   'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700') }}">
                                <span class="size-1.5 rounded-full {{ $this->viewingTask->priority === 'high' ? 'bg-rose-500' : ($this->viewingTask->priority === 'medium' ? 'bg-sky-500' : 'bg-zinc-400') }}"></span>
                                {{ ucfirst($this->viewingTask->priority) }} Priority
                            </span>

                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold
                                {{ $this->viewingTask->status === 'completed' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800' :
                                   ($this->viewingTask->status === 'in_progress' ? 'bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-400 border border-blue-200 dark:border-blue-800' :
                                   'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-400 border border-amber-200 dark:border-amber-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $this->viewingTask->status)) }}
                            </span>
                        </div>
                        <flux:heading size="xl" class="font-bold text-zinc-900 dark:text-white leading-tight">
                            {{ $this->viewingTask->title }}
                        </flux:heading>
                    </div>
                </div>

                {{-- Task Description --}}
                <div class="space-y-2">
                    <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Description</flux:text>
                    <div class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 text-sm text-zinc-800 dark:text-zinc-200 whitespace-pre-line leading-relaxed">
                        {{ $this->viewingTask->description ?: 'No detailed description provided.' }}
                    </div>
                </div>

                {{-- Task Details Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    {{-- Assigned To --}}
                    <div class="p-3.5 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 space-y-1.5">
                        <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Assigned To</flux:text>
                        @if ($this->viewingTask->assignee)
                            <div class="flex items-center gap-2.5 pt-1">
                                <div class="flex size-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 text-white text-xs font-bold shadow-sm">
                                    {{ $this->viewingTask->assignee->initials() }}
                                </div>
                                <div class="leading-tight overflow-hidden">
                                    <p class="font-semibold text-zinc-900 dark:text-zinc-100 truncate">{{ $this->viewingTask->assignee->name }}</p>
                                    <p class="text-xs text-zinc-400 truncate">{{ $this->viewingTask->assignee->email }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-xs text-zinc-400 italic pt-1">Unassigned</p>
                        @endif
                    </div>

                    {{-- Due Date & Overdue Info --}}
                    <div class="p-3.5 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 space-y-1.5">
                        <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Due Date</flux:text>
                        <div class="pt-1 space-y-1">
                            @if ($this->viewingTask->due_date)
                                <div class="flex items-center gap-2 font-semibold text-zinc-900 dark:text-white">
                                    <flux:icon name="calendar" class="size-4 text-indigo-500" />
                                    <span>{{ $this->viewingTask->due_date->format('F d, Y') }}</span>
                                </div>
                                @if ($this->viewingTask->status === 'completed')
                                    <span class="text-xs text-emerald-600 font-medium">Completed on {{ $this->viewingTask->completed_at ? $this->viewingTask->completed_at->format('M d, Y') : '-' }}</span>
                                @elseif ($this->viewingTask->isOverdue())
                                    <span class="text-xs font-bold text-rose-600 bg-rose-50 dark:bg-rose-950/60 px-2 py-0.5 rounded border border-rose-200 dark:border-rose-800 inline-block">
                                        Overdue by {{ $this->viewingTask->due_date->diffInDays(now()) }} days
                                    </span>
                                @else
                                    <span class="text-xs text-zinc-500">Remaining: {{ $this->viewingTask->due_date->diffForHumans(null, true) }} left</span>
                                @endif
                            @else
                                <p class="text-xs text-zinc-400 italic">No deadline specified</p>
                            @endif
                        </div>
                    </div>

                    {{-- Created Date --}}
                    <div class="p-3.5 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 space-y-1.5">
                        <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Created Date</flux:text>
                        <div class="pt-1 space-y-0.5">
                            <p class="font-semibold text-zinc-900 dark:text-white">
                                {{ $this->viewingTask->created_at ? $this->viewingTask->created_at->format('F d, Y - h:i A') : '-' }}
                            </p>
                            <p class="text-xs text-zinc-400">
                                {{ $this->viewingTask->created_at ? $this->viewingTask->created_at->diffForHumans() : '' }}
                            </p>
                        </div>
                    </div>

                    {{-- Quick Status Changer Inside View --}}
                    <div class="p-3.5 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 space-y-1.5">
                        <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Update Status</flux:text>
                        <div class="flex items-center gap-1.5 pt-1">
                            <button
                                type="button"
                                wire:click="updateTaskStatus({{ $this->viewingTask->id }}, 'pending')"
                                class="px-2.5 py-1 rounded text-xs font-medium transition cursor-pointer {{ $this->viewingTask->status === 'pending' ? 'bg-amber-500 text-white font-bold' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-600 hover:bg-amber-100' }}"
                            >
                                Pending
                            </button>
                            <button
                                type="button"
                                wire:click="updateTaskStatus({{ $this->viewingTask->id }}, 'in_progress')"
                                class="px-2.5 py-1 rounded text-xs font-medium transition cursor-pointer {{ $this->viewingTask->status === 'in_progress' ? 'bg-blue-500 text-white font-bold' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-600 hover:bg-blue-100' }}"
                            >
                                In Progress
                            </button>
                            <button
                                type="button"
                                wire:click="updateTaskStatus({{ $this->viewingTask->id }}, 'completed')"
                                class="px-2.5 py-1 rounded text-xs font-medium transition cursor-pointer {{ $this->viewingTask->status === 'completed' ? 'bg-emerald-500 text-white font-bold' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-600 hover:bg-emerald-100' }}"
                            >
                                Completed
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="flex items-center justify-between pt-4 border-t border-zinc-200 dark:border-zinc-800">
                    <button
                        type="button"
                        wire:click="confirmDelete({{ $this->viewingTask->id }})"
                        class="text-xs text-rose-600 hover:text-rose-700 font-semibold flex items-center gap-1 cursor-pointer"
                    >
                        <flux:icon name="trash" class="size-4" />
                        <span>Delete Task</span>
                    </button>

                    <div class="flex items-center gap-3">
                        <flux:button variant="ghost" wire:click="$set('showViewModal', false)">
                            Close
                        </flux:button>
                        <flux:button variant="primary" icon="pencil-square" wire:click="openEditModal({{ $this->viewingTask->id }})">
                            Edit Task
                        </flux:button>
                    </div>
                </div>
            </div>
        @endif
    </flux:modal>

    {{-- Create / Edit Task Modal Form with Validation Messages --}}
    <flux:modal wire:model="showTaskModal" class="md:w-[560px]">
        <form wire:submit.prevent="saveTask" class="space-y-5">
            <div>
                <flux:heading size="lg" class="font-bold">
                    {{ $isEditing ? __('Edit Task') : __('Add New Task') }}
                </flux:heading>
                <flux:text class="text-xs text-zinc-500">
                    {{ $isEditing ? __('Update task title, description, assigned user, priority, status, and due date.') : __('Fill in all required task details, select the responsible team member, priority, status, and due date.') }}
                </flux:text>
            </div>

            {{-- Task Title --}}
            <div>
                <flux:input
                    wire:model.live.debounce.300ms="title"
                    label="Task Title *"
                    placeholder="Enter task title..."
                    autofocus
                />
                @error('title')
                    <p class="text-xs font-semibold text-rose-600 dark:text-rose-400 mt-1.5 flex items-center gap-1">
                        <flux:icon name="exclamation-circle" class="size-3.5 shrink-0" />
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <flux:textarea
                    wire:model.live.debounce.300ms="description"
                    label="Description"
                    placeholder="Enter detailed task description..."
                    rows="3"
                />
                @error('description')
                    <p class="text-xs font-semibold text-rose-600 dark:text-rose-400 mt-1.5 flex items-center gap-1">
                        <flux:icon name="exclamation-circle" class="size-3.5 shrink-0" />
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Assigned To (User Dropdown) --}}
            <div>
                <flux:select wire:model.live="user_id" label="Assigned To *" placeholder="Select responsible team member">
                    <flux:select.option value="">-- Select responsible team member --</flux:select.option>
                    @foreach ($this->users as $u)
                        <flux:select.option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</flux:select.option>
                    @endforeach
                </flux:select>
                @error('user_id')
                    <p class="text-xs font-semibold text-rose-600 dark:text-rose-400 mt-1.5 flex items-center gap-1">
                        <flux:icon name="exclamation-circle" class="size-3.5 shrink-0" />
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- Priority (Low, Medium, High) --}}
                <div>
                    <flux:select wire:model.live="priority" label="Priority *">
                        <flux:select.option value="low">Low</flux:select.option>
                        <flux:select.option value="medium">Medium</flux:select.option>
                        <flux:select.option value="high">High</flux:select.option>
                    </flux:select>
                    @error('priority')
                        <p class="text-xs font-semibold text-rose-600 dark:text-rose-400 mt-1 flex items-center gap-1">
                            <flux:icon name="exclamation-circle" class="size-3.5 shrink-0" />
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Status (Pending, In Progress, Completed) --}}
                <div>
                    <flux:select wire:model.live="status" label="Status *">
                        <flux:select.option value="pending">Pending</flux:select.option>
                        <flux:select.option value="in_progress">In Progress</flux:select.option>
                        <flux:select.option value="completed">Completed</flux:select.option>
                    </flux:select>
                    @error('status')
                        <p class="text-xs font-semibold text-rose-600 dark:text-rose-400 mt-1 flex items-center gap-1">
                            <flux:icon name="exclamation-circle" class="size-3.5 shrink-0" />
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div>
                    <flux:input
                        wire:model.live="due_date"
                        type="date"
                        label="Due Date *"
                    />
                    @error('due_date')
                        <p class="text-xs font-semibold text-rose-600 dark:text-rose-400 mt-1 flex items-center gap-1">
                            <flux:icon name="exclamation-circle" class="size-3.5 shrink-0" />
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <flux:button variant="ghost" wire:click="$set('showTaskModal', false)">
                    Cancel
                </flux:button>
                <flux:button variant="primary" type="submit">
                    {{ $isEditing ? __('Update Task') : __('Create Task') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Delete Confirmation Modal --}}
    <flux:modal wire:model="showDeleteModal" class="md:w-[420px]">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-full bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-800">
                    <flux:icon name="exclamation-triangle" class="size-6" />
                </div>
                <div>
                    <flux:heading size="md" class="font-bold">Delete Task?</flux:heading>
                    <flux:text class="text-xs text-zinc-500">This action cannot be undone.</flux:text>
                </div>
            </div>

            <p class="text-sm text-zinc-700 dark:text-zinc-300">
                Are you sure you want to delete <span class="font-semibold text-zinc-900 dark:text-white">"{{ $deletingTaskTitle }}"</span>?
            </p>

            <div class="flex items-center justify-end gap-3 pt-2">
                <flux:button variant="ghost" wire:click="$set('showDeleteModal', false)">
                    Cancel
                </flux:button>
                <flux:button variant="danger" wire:click="deleteTask">
                    Delete Task
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>