<?php
if (!function_exists('__4287419b9814dac267a5711c04267528')):
function __4287419b9814dac267a5711c04267528($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
$__defaults = [
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'resize' => 'vertical',
    'invalid' => null,
    'rows' => 4,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
$resize ??= $attributes['resize'] ?? $__defaults['resize']; unset($attributes['resize']);
$invalid ??= $attributes['invalid'] ?? $__defaults['invalid']; unset($attributes['invalid']);
$rows ??= $attributes['rows'] ?? $__defaults['rows']; unset($attributes['rows']);
unset($__defaults);
?>

<?php
$classes = Flux::classes()
    ->add('block p-3 w-full')
    ->add('shadow-xs disabled:shadow-none border rounded-lg')
    ->add('bg-white dark:bg-white/10 dark:disabled:bg-white/[7%]')
    ->add($resize ? match ($resize) {
        'none' => 'resize-none',
        'both' => 'resize',
        'horizontal' => 'resize-x',
        'vertical' => 'resize-y',
        default => 'resize-y',
    } : 'resize-none')
    ->add($rows === 'auto' ? 'field-sizing-content' : '')
    ->add('text-base sm:text-sm text-zinc-700 disabled:text-zinc-500 placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:text-zinc-300 dark:disabled:text-zinc-400 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500')
    ->add('border-zinc-200 border-b-zinc-300/80 dark:border-white/10')
    ->add('data-invalid:shadow-none data-invalid:border-red-500 dark:data-invalid:border-red-500')
    ;
?>

<?php if (!function_exists('__97926898616e2325f7f301abb4e86790')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php', $__blaze->compiledPath.'/97926898616e2325f7f301abb4e86790.php'); require $__blaze->compiledPath.'/97926898616e2325f7f301abb4e86790.php'; } ?>
<?php if (isset($__slots97926898616e2325f7f301abb4e86790)) { $__slotsStack97926898616e2325f7f301abb4e86790[] = $__slots97926898616e2325f7f301abb4e86790; } ?>
<?php if (isset($__attrs97926898616e2325f7f301abb4e86790)) { $__attrsStack97926898616e2325f7f301abb4e86790[] = $__attrs97926898616e2325f7f301abb4e86790; } ?>
<?php $__attrs97926898616e2325f7f301abb4e86790 = ['attributes' => $attributes]; ?>
<?php $__slots97926898616e2325f7f301abb4e86790 = []; ?>
<?php $__blaze->pushData($__attrs97926898616e2325f7f301abb4e86790); ?>
<?php ob_start(); ?>
    <textarea
        <?php echo e($attributes->class($classes)); ?>

        rows="<?php echo e($rows); ?>"
        <?php if(isset($name)): ?> name="<?php echo e($name); ?>" <?php endif; ?>
        [STARTCOMPILEDUNBLAZE:2qjwLceFx5]<?php \Livewire\Blaze\Unblaze::storeScope("2qjwLceFx5", scope: ['name' => $name ?? null, 'invalid' => $invalid ?? false]) ?><?php \Livewire\Blaze\Unblaze::storeReplacement("2qjwLceFx5", "CiAgICAgICAgPD9waHAgaWYgKCRzY29wZVsnaW52YWxpZCddIHx8ICgkc2NvcGVbJ25hbWUnXSAmJiAkZXJyb3JzLT5oYXMoJHNjb3BlWyduYW1lJ10pKSk6ID8+CiAgICAgICAgYXJpYS1pbnZhbGlkPSJ0cnVlIiBkYXRhLWludmFsaWQKICAgICAgICA8P3BocCBlbmRpZjsgPz4KICAgICAgICA=") ?>[ENDCOMPILEDUNBLAZE:2qjwLceFx5]
        data-flux-control
        data-flux-textarea
    ><?php echo e($slot); ?></textarea>
<?php $__slots97926898616e2325f7f301abb4e86790['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots97926898616e2325f7f301abb4e86790); ?>
<?php __97926898616e2325f7f301abb4e86790($__blaze, $__attrs97926898616e2325f7f301abb4e86790, $__slots97926898616e2325f7f301abb4e86790, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack97926898616e2325f7f301abb4e86790)) { $__slots97926898616e2325f7f301abb4e86790 = array_pop($__slotsStack97926898616e2325f7f301abb4e86790); } ?>
<?php if (! empty($__attrsStack97926898616e2325f7f301abb4e86790)) { $__attrs97926898616e2325f7f301abb4e86790 = array_pop($__attrsStack97926898616e2325f7f301abb4e86790); } ?>
<?php $__blaze->popData(); ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/textarea.blade.php ENDPATH**/ ?>