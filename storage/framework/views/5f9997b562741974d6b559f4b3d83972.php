<?php
if (!function_exists('_5f9997b562741974d6b559f4b3d83972')):
function _5f9997b562741974d6b559f4b3d83972($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'class' => '-me-1',
    'square' => true,
    'size' => null,
]);
?>

<?php if (!function_exists('_f11fa0a7608cc6489e16ab42a05e2490')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/f11fa0a7608cc6489e16ab42a05e2490.php'); require $__blaze->compiledPath.'/f11fa0a7608cc6489e16ab42a05e2490.php'; } ?>
<?php if (isset($__slotsf11fa0a7608cc6489e16ab42a05e2490)) { $__slotsStackf11fa0a7608cc6489e16ab42a05e2490[] = $__slotsf11fa0a7608cc6489e16ab42a05e2490; } ?>
<?php if (isset($__attrsf11fa0a7608cc6489e16ab42a05e2490)) { $__attrsStackf11fa0a7608cc6489e16ab42a05e2490[] = $__attrsf11fa0a7608cc6489e16ab42a05e2490; } ?>
<?php $__attrsf11fa0a7608cc6489e16ab42a05e2490 = ['attributes' => $attributes,'size' => $size === 'sm' || $size === 'xs' ? 'xs' : 'sm','xData' => 'fluxInputViewable','xOn:click' => 'toggle()','xBind:dataViewableOpen' => 'open','ariaLabel' => e(__('Toggle password visibility'))]; ?>
<?php $__slotsf11fa0a7608cc6489e16ab42a05e2490 = []; ?>
<?php $__blaze->pushData($__attrsf11fa0a7608cc6489e16ab42a05e2490); ?>
<?php ob_start(); ?>
    <?php if (!function_exists('_20b37c713ce494d16c7035808443ad97')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/eye-slash.blade.php', $__blaze->compiledPath.'/20b37c713ce494d16c7035808443ad97.php'); require $__blaze->compiledPath.'/20b37c713ce494d16c7035808443ad97.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'hidden [[data-viewable-open]>&]:block']); ?>
<?php _20b37c713ce494d16c7035808443ad97($__blaze, ['variant' => $iconVariant,'class' => 'hidden [[data-viewable-open]>&]:block'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
    <?php if (!function_exists('_d18e3b6dd09ef35f1ddba219d113bb47')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/eye.blade.php', $__blaze->compiledPath.'/d18e3b6dd09ef35f1ddba219d113bb47.php'); require $__blaze->compiledPath.'/d18e3b6dd09ef35f1ddba219d113bb47.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'block [[data-viewable-open]>&]:hidden']); ?>
<?php _d18e3b6dd09ef35f1ddba219d113bb47($__blaze, ['variant' => $iconVariant,'class' => 'block [[data-viewable-open]>&]:hidden'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
<?php $__slotsf11fa0a7608cc6489e16ab42a05e2490['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsf11fa0a7608cc6489e16ab42a05e2490); ?>
<?php _f11fa0a7608cc6489e16ab42a05e2490($__blaze, $__attrsf11fa0a7608cc6489e16ab42a05e2490, $__slotsf11fa0a7608cc6489e16ab42a05e2490, ['attributes', 'size'], ['xData' => 'x-data', 'xOn:click' => 'x-on:click', 'xBind:dataViewableOpen' => 'x-bind:data-viewable-open', 'ariaLabel' => 'aria-label'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackf11fa0a7608cc6489e16ab42a05e2490)) { $__slotsf11fa0a7608cc6489e16ab42a05e2490 = array_pop($__slotsStackf11fa0a7608cc6489e16ab42a05e2490); } ?>
<?php if (! empty($__attrsStackf11fa0a7608cc6489e16ab42a05e2490)) { $__attrsf11fa0a7608cc6489e16ab42a05e2490 = array_pop($__attrsStackf11fa0a7608cc6489e16ab42a05e2490); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/input/viewable.blade.php ENDPATH**/ ?>