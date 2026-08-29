<footer class="mt-auto py-4 px-4 sm:px-6 border-t border-zinc-200 dark:border-zinc-800 text-xs text-zinc-500 dark:text-zinc-400">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 max-w-7xl mx-auto w-full">
        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 text-center sm:text-start">
            <span>&copy; {{ date('Y') }}</span>
            <span class="font-semibold text-zinc-800 dark:text-zinc-200">{{ config('office.company_name', 'ASTGD') }}</span>
            <span class="hidden sm:inline">&middot;</span>
            <span class="hidden sm:inline">{{ config('office.app_name', config('app.name', 'ASTGD Task Tracker')) }}</span>

            @if (! app()->isProduction())
                @php
                    $envName = match (app()->environment()) {
                        'local', 'dev', 'development' => 'Development',
                        default => ucfirst(app()->environment()),
                    };
                @endphp
                <span class="hidden sm:inline">&middot;</span>
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/70 dark:text-amber-300 border border-amber-300/80 dark:border-amber-700/80">
                    <span class="size-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>Environment: {{ $envName }}</span>
                </span>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <span class="text-zinc-400 dark:text-zinc-500">Contact:</span>
            <a
                href="mailto:{{ config('office.company_email', 'office@example.com') }}"
                class="inline-flex items-center gap-1.5 font-medium text-indigo-600 dark:text-indigo-400 hover:underline transition"
            >
                <flux:icon name="envelope" class="size-3.5" />
                <span>{{ config('office.company_email', 'office@example.com') }}</span>
            </a>
        </div>
    </div>
</footer>
