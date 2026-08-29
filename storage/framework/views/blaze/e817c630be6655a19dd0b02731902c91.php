<?php
if (!function_exists('__e817c630be6655a19dd0b02731902c91')):
function __e817c630be6655a19dd0b02731902c91($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'iconVariant' => 'mini',
    'size' => null,
];
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$size ??= $attributes['size'] ?? $__defaults['size']; unset($attributes['size']);
unset($__defaults);
?>

<?php
$attributes = $attributes->merge([
    'variant' => 'subtle',
    'class' => '-me-1 [[data-flux-input]:has(input:placeholder-shown)_&]:hidden [[data-flux-input]:has(input[disabled])_&]:hidden',
    'square' => true,
    'size' => null,
]);
?>

<?php if (!function_exists('__f11fa0a7608cc6489e16ab42a05e2490')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/f11fa0a7608cc6489e16ab42a05e2490.php'); require $__blaze->compiledPath.'/f11fa0a7608cc6489e16ab42a05e2490.php'; } ?>
<?php if (isset($__slotsf11fa0a7608cc6489e16ab42a05e2490)) { $__slotsStackf11fa0a7608cc6489e16ab42a05e2490[] = $__slotsf11fa0a7608cc6489e16ab42a05e2490; } ?>
<?php if (isset($__attrsf11fa0a7608cc6489e16ab42a05e2490)) { $__attrsStackf11fa0a7608cc6489e16ab42a05e2490[] = $__attrsf11fa0a7608cc6489e16ab42a05e2490; } ?>
<?php $__attrsf11fa0a7608cc6489e16ab42a05e2490 = ['attributes' => $attributes,'size' => $size === 'sm' || $size === 'xs' ? 'xs' : 'sm','xData' => 'fluxInputClearable','xOn:click' => 'clear()','tabindex' => '-1','ariaLabel' => e(__('Clear input')),'dataFluxClearButton' => true]; ?>
<?php $__slotsf11fa0a7608cc6489e16ab42a05e2490 = []; ?>
<?php $__blaze->pushData($__attrsf11fa0a7608cc6489e16ab42a05e2490); ?>
<?php ob_start(); ?>
    <?php if (!function_exists('__6771c66c15589a7e7291974d15048375')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/x-mark.blade.php', $__blaze->compiledPath.'/6771c66c15589a7e7291974d15048375.php'); require $__blaze->compiledPath.'/6771c66c15589a7e7291974d15048375.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant]); ?>
<?php __6771c66c15589a7e7291974d15048375($__blaze, ['variant' => $iconVariant], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
<?php $__slotsf11fa0a7608cc6489e16ab42a05e2490['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsf11fa0a7608cc6489e16ab42a05e2490); ?>
<?php __f11fa0a7608cc6489e16ab42a05e2490($__blaze, $__attrsf11fa0a7608cc6489e16ab42a05e2490, $__slotsf11fa0a7608cc6489e16ab42a05e2490, ['attributes', 'size', 'dataFluxClearButton'], ['xData' => 'x-data', 'xOn:click' => 'x-on:click', 'ariaLabel' => 'aria-label', 'dataFluxClearButton' => 'data-flux-clear-button'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackf11fa0a7608cc6489e16ab42a05e2490)) { $__slotsf11fa0a7608cc6489e16ab42a05e2490 = array_pop($__slotsStackf11fa0a7608cc6489e16ab42a05e2490); } ?>
<?php if (! empty($__attrsStackf11fa0a7608cc6489e16ab42a05e2490)) { $__attrsf11fa0a7608cc6489e16ab42a05e2490 = array_pop($__attrsStackf11fa0a7608cc6489e16ab42a05e2490); } ?>
<?php $__blaze->popData(); ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/input/clearable.blade.php ENDPATH**/ ?>