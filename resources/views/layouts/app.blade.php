<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main class="flex flex-col min-h-[calc(100vh-theme(spacing.16))]">
        <div class="flex-1">
            {{ $slot }}
        </div>
        @include('partials.footer')
    </flux:main>
</x-layouts::app.sidebar>
