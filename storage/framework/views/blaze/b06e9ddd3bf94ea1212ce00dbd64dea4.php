<?php
if (!function_exists('__b06e9ddd3bf94ea1212ce00dbd64dea4')):
function __b06e9ddd3bf94ea1212ce00dbd64dea4($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'length' => null,
    'private' => false,
];
$length ??= $attributes['length'] ?? $__defaults['length']; unset($attributes['length']);
$private ??= $attributes['private'] ?? $__defaults['private']; unset($attributes['private']);
unset($__defaults);
?>

<?php
    $classes = Flux::classes()
        ->add('flex items-center gap-2 isolate w-fit')
        ->add('[&_[data-flux-input-group]]:w-auto')
?>

<?php if (!function_exists('__97926898616e2325f7f301abb4e86790')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php', $__blaze->compiledPath.'/97926898616e2325f7f301abb4e86790.php'); require $__blaze->compiledPath.'/97926898616e2325f7f301abb4e86790.php'; } ?>
<?php if (isset($__slots97926898616e2325f7f301abb4e86790)) { $__slotsStack97926898616e2325f7f301abb4e86790[] = $__slots97926898616e2325f7f301abb4e86790; } ?>
<?php if (isset($__attrs97926898616e2325f7f301abb4e86790)) { $__attrsStack97926898616e2325f7f301abb4e86790[] = $__attrs97926898616e2325f7f301abb4e86790; } ?>
<?php $__attrs97926898616e2325f7f301abb4e86790 = ['attributes' => $attributes]; ?>
<?php $__slots97926898616e2325f7f301abb4e86790 = []; ?>
<?php $__blaze->pushData($__attrs97926898616e2325f7f301abb4e86790); ?>
<?php ob_start(); ?>
    <ui-otp
        <?php echo e($attributes->class($classes)); ?>

        data-flux-otp
        data-flux-control
        role="group"
        data-flux-input-aria-label="<?php echo e(__('Character {current} of {total}')); ?>"
    >
        <?php if($slot->isEmpty() && $length): ?>
            <?php for($i = 0; $i < $length; $i++): ?>
                <?php if (!function_exists('__12f617478fc068d1cc1ec8a3ae8cde12')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/otp/input.blade.php', $__blaze->compiledPath.'/12f617478fc068d1cc1ec8a3ae8cde12.php'); require $__blaze->compiledPath.'/12f617478fc068d1cc1ec8a3ae8cde12.php'; } ?>
<?php $__blaze->pushData([]); ?>
<?php __12f617478fc068d1cc1ec8a3ae8cde12($__blaze, [], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
            <?php endfor; ?>
        <?php else: ?>
            <?php echo e($slot); ?>

        <?php endif; ?>
    </ui-otp>
<?php $__slots97926898616e2325f7f301abb4e86790['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots97926898616e2325f7f301abb4e86790); ?>
<?php __97926898616e2325f7f301abb4e86790($__blaze, $__attrs97926898616e2325f7f301abb4e86790, $__slots97926898616e2325f7f301abb4e86790, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack97926898616e2325f7f301abb4e86790)) { $__slots97926898616e2325f7f301abb4e86790 = array_pop($__slotsStack97926898616e2325f7f301abb4e86790); } ?>
<?php if (! empty($__attrsStack97926898616e2325f7f301abb4e86790)) { $__attrs97926898616e2325f7f301abb4e86790 = array_pop($__attrsStack97926898616e2325f7f301abb4e86790); } ?>
<?php $__blaze->popData(); ?><?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/otp/index.blade.php ENDPATH**/ ?>