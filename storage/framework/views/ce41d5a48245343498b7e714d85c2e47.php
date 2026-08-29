<?php
if (!function_exists('_ce41d5a48245343498b7e714d85c2e47')):
function _ce41d5a48245343498b7e714d85c2e47($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
extract(Flux::forwardedAttributes($attributes, [
    'tooltipPosition',
    'tooltipKbd',
    'tooltip',
]));
?>

<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
unset($__defaults);
?>

<?php if ($tooltip): ?>
    <?php if (!function_exists('_f686bb577e0fbe9a9e749c7a771376b0')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/f686bb577e0fbe9a9e749c7a771376b0.php'); require $__blaze->compiledPath.'/f686bb577e0fbe9a9e749c7a771376b0.php'; } ?>
<?php if (isset($__slotsf686bb577e0fbe9a9e749c7a771376b0)) { $__slotsStackf686bb577e0fbe9a9e749c7a771376b0[] = $__slotsf686bb577e0fbe9a9e749c7a771376b0; } ?>
<?php if (isset($__attrsf686bb577e0fbe9a9e749c7a771376b0)) { $__attrsStackf686bb577e0fbe9a9e749c7a771376b0[] = $__attrsf686bb577e0fbe9a9e749c7a771376b0; } ?>
<?php $__attrsf686bb577e0fbe9a9e749c7a771376b0 = ['class' => 'inline-flex','content' => $tooltip,'position' => $tooltipPosition,'kbd' => $tooltipKbd]; ?>
<?php $__slotsf686bb577e0fbe9a9e749c7a771376b0 = []; ?>
<?php $__blaze->pushData($__attrsf686bb577e0fbe9a9e749c7a771376b0); ?>
<?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php $__slotsf686bb577e0fbe9a9e749c7a771376b0['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsf686bb577e0fbe9a9e749c7a771376b0); ?>
<?php _f686bb577e0fbe9a9e749c7a771376b0($__blaze, $__attrsf686bb577e0fbe9a9e749c7a771376b0, $__slotsf686bb577e0fbe9a9e749c7a771376b0, ['content', 'position', 'kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackf686bb577e0fbe9a9e749c7a771376b0)) { $__slotsf686bb577e0fbe9a9e749c7a771376b0 = array_pop($__slotsStackf686bb577e0fbe9a9e749c7a771376b0); } ?>
<?php if (! empty($__attrsStackf686bb577e0fbe9a9e749c7a771376b0)) { $__attrsf686bb577e0fbe9a9e749c7a771376b0 = array_pop($__attrsStackf686bb577e0fbe9a9e749c7a771376b0); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/with-tooltip.blade.php ENDPATH**/ ?>