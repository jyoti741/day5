<?php
if (!function_exists('_97926898616e2325f7f301abb4e86790')):
function _97926898616e2325f7f301abb4e86790($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'name',
    'descriptionTrailing',
    'description',
    'label',
    'badge',
]));
?>

<?php $descriptionTrailing = $descriptionTrailing ??= $attributes->pluck('description:trailing'); ?>

<?php
$__defaults = [
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'descriptionTrailing' => null,
    'description' => null,
    'label' => null,
    'badge' => null,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
$descriptionTrailing ??= $attributes['description-trailing'] ?? $attributes['descriptionTrailing'] ?? $__defaults['descriptionTrailing']; unset($attributes['descriptionTrailing'], $attributes['description-trailing']);
$description ??= $attributes['description'] ?? $__defaults['description']; unset($attributes['description']);
$label ??= $attributes['label'] ?? $__defaults['label']; unset($attributes['label']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
unset($__defaults);
?>

<?php if (isset($label) || isset($description) || isset($descriptionTrailing)): ?>
    <?php

        $fieldAttributes = Flux::attributesAfter('field:', $attributes, []);
        $labelAttributes = Flux::attributesAfter('label:', $attributes, ['badge' => $badge]);
        $descriptionAttributes = Flux::attributesAfter('description:', $attributes, []);
        $errorAttributes = Flux::attributesAfter('error:', $attributes, ['name' => $name]);
    ?>
    <?php if (!function_exists('_2cf4c3441fa406a3f04759f145b98513')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/field.blade.php', $__blaze->compiledPath.'/2cf4c3441fa406a3f04759f145b98513.php'); require $__blaze->compiledPath.'/2cf4c3441fa406a3f04759f145b98513.php'; } ?>
<?php if (isset($__slots2cf4c3441fa406a3f04759f145b98513)) { $__slotsStack2cf4c3441fa406a3f04759f145b98513[] = $__slots2cf4c3441fa406a3f04759f145b98513; } ?>
<?php if (isset($__attrs2cf4c3441fa406a3f04759f145b98513)) { $__attrsStack2cf4c3441fa406a3f04759f145b98513[] = $__attrs2cf4c3441fa406a3f04759f145b98513; } ?>
<?php $__attrs2cf4c3441fa406a3f04759f145b98513 = ['attributes' => $fieldAttributes]; ?>
<?php $__slots2cf4c3441fa406a3f04759f145b98513 = []; ?>
<?php $__blaze->pushData($__attrs2cf4c3441fa406a3f04759f145b98513); ?>
<?php ob_start(); ?>
        <?php if (isset($label)): ?>
            <?php if (!function_exists('_cd4bee8160ce9b6dd44f54d700dd2145')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/label.blade.php', $__blaze->compiledPath.'/cd4bee8160ce9b6dd44f54d700dd2145.php'); require $__blaze->compiledPath.'/cd4bee8160ce9b6dd44f54d700dd2145.php'; } ?>
<?php if (isset($__slotscd4bee8160ce9b6dd44f54d700dd2145)) { $__slotsStackcd4bee8160ce9b6dd44f54d700dd2145[] = $__slotscd4bee8160ce9b6dd44f54d700dd2145; } ?>
<?php if (isset($__attrscd4bee8160ce9b6dd44f54d700dd2145)) { $__attrsStackcd4bee8160ce9b6dd44f54d700dd2145[] = $__attrscd4bee8160ce9b6dd44f54d700dd2145; } ?>
<?php $__attrscd4bee8160ce9b6dd44f54d700dd2145 = ['attributes' => $labelAttributes]; ?>
<?php $__slotscd4bee8160ce9b6dd44f54d700dd2145 = []; ?>
<?php $__blaze->pushData($__attrscd4bee8160ce9b6dd44f54d700dd2145); ?>
<?php ob_start(); ?><?php echo e($label); ?><?php $__slotscd4bee8160ce9b6dd44f54d700dd2145['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotscd4bee8160ce9b6dd44f54d700dd2145); ?>
<?php _cd4bee8160ce9b6dd44f54d700dd2145($__blaze, $__attrscd4bee8160ce9b6dd44f54d700dd2145, $__slotscd4bee8160ce9b6dd44f54d700dd2145, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackcd4bee8160ce9b6dd44f54d700dd2145)) { $__slotscd4bee8160ce9b6dd44f54d700dd2145 = array_pop($__slotsStackcd4bee8160ce9b6dd44f54d700dd2145); } ?>
<?php if (! empty($__attrsStackcd4bee8160ce9b6dd44f54d700dd2145)) { $__attrscd4bee8160ce9b6dd44f54d700dd2145 = array_pop($__attrsStackcd4bee8160ce9b6dd44f54d700dd2145); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <?php if (!function_exists('_d766067b11a2cad82d279cf655e4f20f')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/d766067b11a2cad82d279cf655e4f20f.php'); require $__blaze->compiledPath.'/d766067b11a2cad82d279cf655e4f20f.php'; } ?>
<?php if (isset($__slotsd766067b11a2cad82d279cf655e4f20f)) { $__slotsStackd766067b11a2cad82d279cf655e4f20f[] = $__slotsd766067b11a2cad82d279cf655e4f20f; } ?>
<?php if (isset($__attrsd766067b11a2cad82d279cf655e4f20f)) { $__attrsStackd766067b11a2cad82d279cf655e4f20f[] = $__attrsd766067b11a2cad82d279cf655e4f20f; } ?>
<?php $__attrsd766067b11a2cad82d279cf655e4f20f = ['attributes' => $descriptionAttributes]; ?>
<?php $__slotsd766067b11a2cad82d279cf655e4f20f = []; ?>
<?php $__blaze->pushData($__attrsd766067b11a2cad82d279cf655e4f20f); ?>
<?php ob_start(); ?><?php echo e($description); ?><?php $__slotsd766067b11a2cad82d279cf655e4f20f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsd766067b11a2cad82d279cf655e4f20f); ?>
<?php _d766067b11a2cad82d279cf655e4f20f($__blaze, $__attrsd766067b11a2cad82d279cf655e4f20f, $__slotsd766067b11a2cad82d279cf655e4f20f, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackd766067b11a2cad82d279cf655e4f20f)) { $__slotsd766067b11a2cad82d279cf655e4f20f = array_pop($__slotsStackd766067b11a2cad82d279cf655e4f20f); } ?>
<?php if (! empty($__attrsStackd766067b11a2cad82d279cf655e4f20f)) { $__attrsd766067b11a2cad82d279cf655e4f20f = array_pop($__attrsStackd766067b11a2cad82d279cf655e4f20f); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php echo e($slot); ?>


        
        <?php $__getScope = fn($scope = []) => $scope; ?><?php if (isset($scope)) $__scope = $scope; ?><?php $scope = $__getScope(scope: ['attributes' => $errorAttributes->getAttributes()]); ?>
        <?php if (!function_exists('_1e6f2b93e77b15c916945ea489404873')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/error.blade.php', $__blaze->compiledPath.'/1e6f2b93e77b15c916945ea489404873.php'); require $__blaze->compiledPath.'/1e6f2b93e77b15c916945ea489404873.php'; } ?>
<?php $__blaze->pushData(['attributes' => new \Illuminate\View\ComponentAttributeBag($scope['attributes'])]); ?>
<?php _1e6f2b93e77b15c916945ea489404873($__blaze, ['attributes' => new \Illuminate\View\ComponentAttributeBag($scope['attributes'])], [], ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
        <?php if (isset($__scope)) { $scope = $__scope; unset($__scope); } ?>

        <?php if (isset($descriptionTrailing)): ?>
            <?php if (!function_exists('_d766067b11a2cad82d279cf655e4f20f')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/d766067b11a2cad82d279cf655e4f20f.php'); require $__blaze->compiledPath.'/d766067b11a2cad82d279cf655e4f20f.php'; } ?>
<?php if (isset($__slotsd766067b11a2cad82d279cf655e4f20f)) { $__slotsStackd766067b11a2cad82d279cf655e4f20f[] = $__slotsd766067b11a2cad82d279cf655e4f20f; } ?>
<?php if (isset($__attrsd766067b11a2cad82d279cf655e4f20f)) { $__attrsStackd766067b11a2cad82d279cf655e4f20f[] = $__attrsd766067b11a2cad82d279cf655e4f20f; } ?>
<?php $__attrsd766067b11a2cad82d279cf655e4f20f = ['attributes' => $descriptionAttributes]; ?>
<?php $__slotsd766067b11a2cad82d279cf655e4f20f = []; ?>
<?php $__blaze->pushData($__attrsd766067b11a2cad82d279cf655e4f20f); ?>
<?php ob_start(); ?><?php echo e($descriptionTrailing); ?><?php $__slotsd766067b11a2cad82d279cf655e4f20f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsd766067b11a2cad82d279cf655e4f20f); ?>
<?php _d766067b11a2cad82d279cf655e4f20f($__blaze, $__attrsd766067b11a2cad82d279cf655e4f20f, $__slotsd766067b11a2cad82d279cf655e4f20f, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackd766067b11a2cad82d279cf655e4f20f)) { $__slotsd766067b11a2cad82d279cf655e4f20f = array_pop($__slotsStackd766067b11a2cad82d279cf655e4f20f); } ?>
<?php if (! empty($__attrsStackd766067b11a2cad82d279cf655e4f20f)) { $__attrsd766067b11a2cad82d279cf655e4f20f = array_pop($__attrsStackd766067b11a2cad82d279cf655e4f20f); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slots2cf4c3441fa406a3f04759f145b98513['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots2cf4c3441fa406a3f04759f145b98513); ?>
<?php _2cf4c3441fa406a3f04759f145b98513($__blaze, $__attrs2cf4c3441fa406a3f04759f145b98513, $__slots2cf4c3441fa406a3f04759f145b98513, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack2cf4c3441fa406a3f04759f145b98513)) { $__slots2cf4c3441fa406a3f04759f145b98513 = array_pop($__slotsStack2cf4c3441fa406a3f04759f145b98513); } ?>
<?php if (! empty($__attrsStack2cf4c3441fa406a3f04759f145b98513)) { $__attrs2cf4c3441fa406a3f04759f145b98513 = array_pop($__attrsStack2cf4c3441fa406a3f04759f145b98513); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php ENDPATH**/ ?>