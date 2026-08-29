<?php
if (!function_exists('_f686bb577e0fbe9a9e749c7a771376b0')):
function _f686bb577e0fbe9a9e749c7a771376b0($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'interactive' => null,
    'position' => 'top',
    'align' => 'center',
    'content' => null,
    'kbd' => null,
    'toggleable' => null,
];
$interactive ??= $attributes['interactive'] ?? $__defaults['interactive']; unset($attributes['interactive']);
$position ??= $attributes['position'] ?? $__defaults['position']; unset($attributes['position']);
$align ??= $attributes['align'] ?? $__defaults['align']; unset($attributes['align']);
$content ??= $attributes['content'] ?? $__defaults['content']; unset($attributes['content']);
$kbd ??= $attributes['kbd'] ?? $__defaults['kbd']; unset($attributes['kbd']);
$toggleable ??= $attributes['toggleable'] ?? $__defaults['toggleable']; unset($attributes['toggleable']);
unset($__defaults);
?>

<?php
// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}
?>

<?php if ($toggleable): ?>
    <ui-dropdown position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php if (!function_exists('_8cec44085e10c83d0312eb6d242daa86')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/8cec44085e10c83d0312eb6d242daa86.php'); require $__blaze->compiledPath.'/8cec44085e10c83d0312eb6d242daa86.php'; } ?>
<?php if (isset($__slots8cec44085e10c83d0312eb6d242daa86)) { $__slotsStack8cec44085e10c83d0312eb6d242daa86[] = $__slots8cec44085e10c83d0312eb6d242daa86; } ?>
<?php if (isset($__attrs8cec44085e10c83d0312eb6d242daa86)) { $__attrsStack8cec44085e10c83d0312eb6d242daa86[] = $__attrs8cec44085e10c83d0312eb6d242daa86; } ?>
<?php $__attrs8cec44085e10c83d0312eb6d242daa86 = ['kbd' => $kbd]; ?>
<?php $__slots8cec44085e10c83d0312eb6d242daa86 = []; ?>
<?php $__blaze->pushData($__attrs8cec44085e10c83d0312eb6d242daa86); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slots8cec44085e10c83d0312eb6d242daa86['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots8cec44085e10c83d0312eb6d242daa86); ?>
<?php _8cec44085e10c83d0312eb6d242daa86($__blaze, $__attrs8cec44085e10c83d0312eb6d242daa86, $__slots8cec44085e10c83d0312eb6d242daa86, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack8cec44085e10c83d0312eb6d242daa86)) { $__slots8cec44085e10c83d0312eb6d242daa86 = array_pop($__slotsStack8cec44085e10c83d0312eb6d242daa86); } ?>
<?php if (! empty($__attrsStack8cec44085e10c83d0312eb6d242daa86)) { $__attrs8cec44085e10c83d0312eb6d242daa86 = array_pop($__attrsStack8cec44085e10c83d0312eb6d242daa86); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-dropdown>
<?php else: ?>
    <ui-tooltip position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip <?php if($interactive): ?> interactive <?php endif; ?>>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php if (!function_exists('_8cec44085e10c83d0312eb6d242daa86')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/8cec44085e10c83d0312eb6d242daa86.php'); require $__blaze->compiledPath.'/8cec44085e10c83d0312eb6d242daa86.php'; } ?>
<?php if (isset($__slots8cec44085e10c83d0312eb6d242daa86)) { $__slotsStack8cec44085e10c83d0312eb6d242daa86[] = $__slots8cec44085e10c83d0312eb6d242daa86; } ?>
<?php if (isset($__attrs8cec44085e10c83d0312eb6d242daa86)) { $__attrsStack8cec44085e10c83d0312eb6d242daa86[] = $__attrs8cec44085e10c83d0312eb6d242daa86; } ?>
<?php $__attrs8cec44085e10c83d0312eb6d242daa86 = ['kbd' => $kbd]; ?>
<?php $__slots8cec44085e10c83d0312eb6d242daa86 = []; ?>
<?php $__blaze->pushData($__attrs8cec44085e10c83d0312eb6d242daa86); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slots8cec44085e10c83d0312eb6d242daa86['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots8cec44085e10c83d0312eb6d242daa86); ?>
<?php _8cec44085e10c83d0312eb6d242daa86($__blaze, $__attrs8cec44085e10c83d0312eb6d242daa86, $__slots8cec44085e10c83d0312eb6d242daa86, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack8cec44085e10c83d0312eb6d242daa86)) { $__slots8cec44085e10c83d0312eb6d242daa86 = array_pop($__slotsStack8cec44085e10c83d0312eb6d242daa86); } ?>
<?php if (! empty($__attrsStack8cec44085e10c83d0312eb6d242daa86)) { $__attrs8cec44085e10c83d0312eb6d242daa86 = array_pop($__attrsStack8cec44085e10c83d0312eb6d242daa86); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-tooltip>
<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php ENDPATH**/ ?>