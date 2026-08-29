<?php # [BlazeFolded]:{flux::icon}:{C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php}:{1787526214} ?>
<footer class="mt-auto py-4 px-4 sm:px-6 border-t border-zinc-200 dark:border-zinc-800 text-xs text-zinc-500 dark:text-zinc-400">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 max-w-7xl mx-auto w-full">
        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 text-center sm:text-start">
            <span>&copy; <?php echo e(date('Y')); ?></span>
            <span class="font-semibold text-zinc-800 dark:text-zinc-200"><?php echo e(config('office.company_name', 'ASTGD')); ?></span>
            <span class="hidden sm:inline">&middot;</span>
            <span class="hidden sm:inline"><?php echo e(config('office.app_name', config('app.name', 'ASTGD Task Tracker'))); ?></span>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! app()->isProduction()): ?>
                <?php
                    $envName = match (app()->environment()) {
                        'local', 'dev', 'development' => 'Development',
                        default => ucfirst(app()->environment()),
                    };
                ?>
                <span class="hidden sm:inline">&middot;</span>
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[11px] font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/70 dark:text-amber-300 border border-amber-300/80 dark:border-amber-700/80">
                    <span class="size-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>Environment: <?php echo e($envName); ?></span>
                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="flex items-center gap-4">
            <span class="text-zinc-400 dark:text-zinc-500">Contact:</span>
            <a
                href="mailto:<?php echo e(config('office.company_email', 'office@example.com')); ?>"
                class="inline-flex items-center gap-1.5 font-medium text-indigo-600 dark:text-indigo-400 hover:underline transition"
            >
                <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-3.5" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                <span><?php echo e(config('office.company_email', 'office@example.com')); ?></span>
            </a>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\resources\views/partials/footer.blade.php ENDPATH**/ ?>