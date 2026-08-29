<?php
if (!function_exists('__a8b254cf7ad0e5893fea9210f23ca2c4')):
function __a8b254cf7ad0e5893fea9210f23ca2c4($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<div class="-mx-[.3125rem] my-[.3125rem] h-px" <?php echo e($attributes); ?> data-flux-menu-separator>
    <?php if (!function_exists('__ddc706e8acb0f5b0f6204181629e08b9')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/separator.blade.php', $__blaze->compiledPath.'/ddc706e8acb0f5b0f6204181629e08b9.php'); require $__blaze->compiledPath.'/ddc706e8acb0f5b0f6204181629e08b9.php'; } ?>
<?php $__blaze->pushData(['class' => 'dark:bg-zinc-600!']); ?>
<?php __ddc706e8acb0f5b0f6204181629e08b9($__blaze, ['class' => 'dark:bg-zinc-600!'], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
</div>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/separator.blade.php ENDPATH**/ ?>