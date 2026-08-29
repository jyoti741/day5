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
                        Executive overview of office operations, team workload, urgent deadlines, and overall progress
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
                <span class="text-xs font-medium text-zinc-500">all office tasks</span>
            </div>
            <div class="mt-3">
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
                <span class="text-xs font-medium text-zinc-500">in progress</span>
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

    {{-- Main Content Grid: Team Workload + Urgent High Priority Tasks --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left 2 Columns: Urgent & High Priority Action Items --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- High Priority Tasks Box --}}
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between p-5 border-b border-zinc-200 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <div class="p-1.5 rounded-lg bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400">
                            <flux:icon name="fire" class="size-5" />
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-zinc-900 dark:text-white">Urgent & High Priority Office Work</h3>
                            <p class="text-xs text-zinc-500">Tasks that require immediate focus and tracking</p>
                        </div>
                    </div>
                    <a
                        href="{{ route('tasks') }}"
                        wire:navigate
                        class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1"
                    >
                        <span>View All Tasks</span>
                        <flux:icon name="chevron-right" class="size-3.5" />
                    </a>
                </div>

                <div class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse ($this->highPriorityTasks as $task)
                        <div class="p-4 hover:bg-zinc-50/50 dark:hover:bg-zinc-800/40 transition flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-start gap-3 flex-1 min-w-0">
                                <button
                                    type="button"
                                    wire:click="updateTaskStatus({{ $task->id }}, 'completed')"
                                    class="mt-0.5 flex size-5 shrink-0 items-center justify-center rounded-md border border-zinc-300 dark:border-zinc-600 hover:border-emerald-500 text-transparent hover:text-emerald-500 transition cursor-pointer"
                                    title="Mark Completed"
                                >
                                    <flux:icon name="check" class="size-3.5 stroke-[3]" />
                                </button>
                                <div class="space-y-1 min-w-0 flex-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h4 class="font-semibold text-sm text-zinc-900 dark:text-white truncate">
                                            {{ $task->title }}
                                        </h4>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-700 dark:bg-rose-950 dark:text-rose-400 border border-rose-200">
                                            High Priority
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

                                {{-- Due Date --}}
                                @if ($task->due_date)
                                    <div class="text-end">
                                        @if ($task->isOverdue())
                                            <span class="font-bold text-rose-600 bg-rose-50 dark:bg-rose-950/60 px-2 py-0.5 rounded border border-rose-200 text-[11px]">
                                                Overdue
                                            </span>
                                        @else
                                            <span class="text-zinc-500 font-medium">
                                                Due {{ $task->due_date->format('M d') }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- View Modal Button --}}
                                <button
                                    type="button"
                                    wire:click="openViewModal({{ $task->id }})"
                                    class="p-1.5 rounded-lg text-zinc-400 hover:text-indigo-600 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition cursor-pointer"
                                    title="View Details"
                                >
                                    <flux:icon name="eye" class="size-4" />
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-xs text-zinc-400">
                            <flux:icon name="check-badge" class="size-8 mx-auto mb-2 text-emerald-500" />
                            <p class="font-semibold text-zinc-700 dark:text-zinc-300">No urgent tasks pending!</p>
                            <p class="text-[11px] text-zinc-400 mt-0.5">All high priority work is up to date.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Office Work Feed --}}
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm p-5 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <flux:icon name="clock" class="size-5 text-indigo-500" />
                        <h3 class="font-bold text-base text-zinc-900 dark:text-white">Recent Task Activity</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($this->recentTasks as $rTask)
                        <div class="p-3.5 rounded-xl border border-zinc-200/80 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/30 space-y-2">
                            <div class="flex items-center justify-between gap-2">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $rTask->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : ($rTask->status === 'in_progress' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700') }}">
                                    {{ ucfirst(str_replace('_', ' ', $rTask->status)) }}
                                </span>
                                <span class="text-[10px] text-zinc-400">{{ $rTask->created_at ? $rTask->created_at->diffForHumans() : '' }}</span>
                            </div>
                            <h4 class="font-semibold text-xs text-zinc-900 dark:text-white truncate">{{ $rTask->title }}</h4>
                            <div class="flex items-center justify-between text-[11px] text-zinc-500 pt-1 border-t border-zinc-200/60 dark:border-zinc-700/60">
                                <span>{{ $rTask->assignee ? $rTask->assignee->name : 'Unassigned' }}</span>
                                <span class="capitalize font-medium {{ $rTask->priority === 'high' ? 'text-rose-600' : 'text-zinc-600' }}">{{ $rTask->priority }} Priority</span>
                            </div>
                        </div>
                    @endforeach
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
                            <p class="text-xs text-zinc-400">Task distribution by team member</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    @foreach ($this->teamWorkload as $member)
                        <div class="p-3.5 rounded-xl border border-zinc-200 dark:border-zinc-800 space-y-3">
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
                                <span class="text-blue-600">{{ $member->in_progress_tasks_count }} In Progress</span>
                                <span class="text-emerald-600">{{ $member->completed_tasks_count }} Done</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pt-2">
                    <a
                        href="{{ route('tasks') }}"
                        wire:navigate
                        class="block w-full text-center py-2 px-3 rounded-xl bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-xs font-semibold text-zinc-700 dark:text-zinc-200 transition cursor-pointer"
                    >
                        Manage & Assign Tasks
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
                        <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                            {{ ucfirst($this->viewingTask->priority) }} Priority
                        </span>
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-lg bg-blue-50 text-blue-700 border border-blue-200">
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
