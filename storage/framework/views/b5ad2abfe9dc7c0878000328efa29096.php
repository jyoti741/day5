<?php
if (!function_exists('_b5ad2abfe9dc7c0878000328efa29096')):
function _b5ad2abfe9dc7c0878000328efa29096($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
$__defaults = [
    'name' => null,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
unset($__defaults);
?>

<?php
// We only want to show the name attribute on the checkbox if it has been set
// manually, but not if it has been set from the wire:model attribute...
$showName = isset($name);

if (! isset($name)) {
    $name = $attributes->whereStartsWith('wire:model')->first();
}

$classes = Flux::classes()
    ->add('flex size-[1.125rem] rounded-[.3rem] mt-px outline-offset-2')
    ;
?>

<?php if (!function_exists('_7ff3e6e905538466497c0a059f55e593')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/with-inline-field.blade.php', $__blaze->compiledPath.'/7ff3e6e905538466497c0a059f55e593.php'); require $__blaze->compiledPath.'/7ff3e6e905538466497c0a059f55e593.php'; } ?>
<?php if (isset($__slots7ff3e6e905538466497c0a059f55e593)) { $__slotsStack7ff3e6e905538466497c0a059f55e593[] = $__slots7ff3e6e905538466497c0a059f55e593; } ?>
<?php if (isset($__attrs7ff3e6e905538466497c0a059f55e593)) { $__attrsStack7ff3e6e905538466497c0a059f55e593[] = $__attrs7ff3e6e905538466497c0a059f55e593; } ?>
<?php $__attrs7ff3e6e905538466497c0a059f55e593 = ['attributes' => $attributes]; ?>
<?php $__slots7ff3e6e905538466497c0a059f55e593 = []; ?>
<?php $__blaze->pushData($__attrs7ff3e6e905538466497c0a059f55e593); ?>
<?php ob_start(); ?>
    <ui-checkbox <?php echo e($attributes->class($classes)); ?> <?php if($showName): ?> name="<?php echo e($name); ?>" <?php endif; ?> data-flux-control data-flux-checkbox>
        <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::checkbox.indicator", []); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php if (!function_exists('_c8d148dc5aa5dd4e1aaac4dde0db630d')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/checkbox/indicator.blade.php', $__blaze->compiledPath.'/c8d148dc5aa5dd4e1aaac4dde0db630d.php'); require $__blaze->compiledPath.'/c8d148dc5aa5dd4e1aaac4dde0db630d.php'; } ?>
<?php $__blaze->pushData([]); ?>
<?php _c8d148dc5aa5dd4e1aaac4dde0db630d($__blaze, [], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
    </ui-checkbox>
<?php $__slots7ff3e6e905538466497c0a059f55e593['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots7ff3e6e905538466497c0a059f55e593); ?>
<?php _7ff3e6e905538466497c0a059f55e593($__blaze, $__attrs7ff3e6e905538466497c0a059f55e593, $__slots7ff3e6e905538466497c0a059f55e593, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack7ff3e6e905538466497c0a059f55e593)) { $__slots7ff3e6e905538466497c0a059f55e593 = array_pop($__slotsStack7ff3e6e905538466497c0a059f55e593); } ?>
<?php if (! empty($__attrsStack7ff3e6e905538466497c0a059f55e593)) { $__attrs7ff3e6e905538466497c0a059f55e593 = array_pop($__attrsStack7ff3e6e905538466497c0a059f55e593); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/checkbox/variants/default.blade.php ENDPATH**/ ?>