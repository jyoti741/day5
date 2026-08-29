<?php
if (!function_exists('_f97dcc8c5c9a38d3b1a974269a80fc38')):
function _f97dcc8c5c9a38d3b1a974269a80fc38($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $iconTrailing ??= $attributes->pluck('icon:trailing'); ?>
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php
$__awareDefaults = [ 'variant' ];
$variant = $__blaze->getConsumableData('variant');
unset($__awareDefaults);
?>

<?php
$__defaults = [
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'variant' => null,
    'iconDot' => null,
    'accent' => true,
    'badge' => null,
    'icon' => null,
];
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$badgeColor ??= $attributes['badge-color'] ?? $attributes['badgeColor'] ?? $__defaults['badgeColor']; unset($attributes['badgeColor'], $attributes['badge-color']);
$variant ??= $attributes['variant'] ?? $__defaults['variant']; unset($attributes['variant']);
$iconDot ??= $attributes['icon-dot'] ?? $attributes['iconDot'] ?? $__defaults['iconDot']; unset($attributes['iconDot'], $attributes['icon-dot']);
$accent ??= $attributes['accent'] ?? $__defaults['accent']; unset($attributes['accent']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
unset($__defaults);
?>

<?php
// Button should be a square if it has no text contents...
$square ??= $slot->isEmpty();

// Size-up icons in square/icon-only buttons...
$iconClasses = Flux::classes($square ? 'size-5!' : 'size-4!');

$classes = Flux::classes()
    ->add('h-10 lg:h-8 relative flex items-center gap-3 rounded-lg')
    ->add($square ? 'px-2.5!' : '')
    ->add('py-0 text-start w-full px-3 my-px')
    ->add('text-zinc-500 dark:text-white/80')
    ->add(match ($variant) {
        'outline' => match ($accent) {
            true => [
                'data-current:text-(--color-accent-content) hover:data-current:text-(--color-accent-content)',
                'data-current:bg-white dark:data-current:bg-white/[7%] data-current:border data-current:border-zinc-200 dark:data-current:border-transparent',
                'hover:text-zinc-800 dark:hover:text-white dark:hover:bg-white/[7%] hover:bg-zinc-800/5 ',
                'border border-transparent',
            ],
            false => [
                'data-current:text-zinc-800 dark:data-current:text-zinc-100 data-current:border-zinc-200',
                'data-current:bg-white dark:data-current:bg-white/10 data-current:border data-current:border-zinc-200 dark:data-current:border-white/10 data-current:shadow-xs',
                'hover:text-zinc-800 dark:hover:text-white',
            ],
        },
        default => match ($accent) {
            true => [
                'data-current:text-(--color-accent-content) hover:data-current:text-(--color-accent-content)',
                'data-current:bg-zinc-800/[4%] dark:data-current:bg-white/[7%]',
                'hover:text-zinc-800 dark:hover:text-white hover:bg-zinc-800/[4%] dark:hover:bg-white/[7%]',
            ],
            false => [
                'data-current:text-zinc-800 dark:data-current:text-zinc-100',
                'data-current:bg-zinc-800/[4%] dark:data-current:bg-white/10',
                'hover:text-zinc-800 dark:hover:text-white hover:bg-zinc-800/[4%] dark:hover:bg-white/10',
            ],
        },
    })
    ;
?>

<?php if (!function_exists('_9df618fa90f90ce8db365a2645931bfd')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/button-or-link.blade.php', $__blaze->compiledPath.'/9df618fa90f90ce8db365a2645931bfd.php'); require $__blaze->compiledPath.'/9df618fa90f90ce8db365a2645931bfd.php'; } ?>
<?php if (isset($__slots9df618fa90f90ce8db365a2645931bfd)) { $__slotsStack9df618fa90f90ce8db365a2645931bfd[] = $__slots9df618fa90f90ce8db365a2645931bfd; } ?>
<?php if (isset($__attrs9df618fa90f90ce8db365a2645931bfd)) { $__attrsStack9df618fa90f90ce8db365a2645931bfd[] = $__attrs9df618fa90f90ce8db365a2645931bfd; } ?>
<?php $__attrs9df618fa90f90ce8db365a2645931bfd = ['attributes' => $attributes->class($classes),'dataFluxNavlistItem' => true]; ?>
<?php $__slots9df618fa90f90ce8db365a2645931bfd = []; ?>
<?php $__blaze->pushData($__attrs9df618fa90f90ce8db365a2645931bfd); ?>
<?php ob_start(); ?>
    <?php if ($icon): ?>
        <div class="relative">
            <?php if (is_string($icon) && $icon !== ''): ?>
                <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $icon, 'variant' => $iconVariant, 'class' => $iconClasses]); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php if (!function_exists('_e08a1661f995972502d9b9feff3dd1ba')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/e08a1661f995972502d9b9feff3dd1ba.php'); require $__blaze->compiledPath.'/e08a1661f995972502d9b9feff3dd1ba.php'; } ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses]); ?>
<?php _e08a1661f995972502d9b9feff3dd1ba($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
            <?php else: ?>
                <?php echo e($icon); ?>

            <?php endif; ?>

            <?php if ($iconDot): ?>
                <div class="absolute top-[-2px] end-[-2px]">
                    <div class="size-[6px] rounded-full bg-zinc-500 dark:bg-zinc-400"></div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($slot->isNotEmpty()): ?>
        <div class="flex-1 text-sm font-medium leading-none whitespace-nowrap [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block" data-content><?php echo e($slot); ?></div>
    <?php endif; ?>

    <?php if ($iconDot && ! $icon && $iconTrailing): ?>
        <div class="relative">
            <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
                <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $iconTrailing, 'variant' => $iconVariant, 'class' => 'size-4!']); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php if (!function_exists('_e08a1661f995972502d9b9feff3dd1ba')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/e08a1661f995972502d9b9feff3dd1ba.php'); require $__blaze->compiledPath.'/e08a1661f995972502d9b9feff3dd1ba.php'; } ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'size-4!']); ?>
<?php _e08a1661f995972502d9b9feff3dd1ba($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'size-4!'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
            <?php else: ?>
                <?php echo e($iconTrailing); ?>

            <?php endif; ?>

            <div class="absolute top-[-2px] end-[-2px]">
                <div class="size-[6px] rounded-full bg-zinc-500 dark:bg-zinc-400"></div>
            </div>
        </div>
    <?php elseif (is_string($iconTrailing) && $iconTrailing !== ''): ?>
        <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $iconTrailing, 'variant' => $iconVariant, 'class' => 'size-4!']); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php if (!function_exists('_e08a1661f995972502d9b9feff3dd1ba')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/e08a1661f995972502d9b9feff3dd1ba.php'); require $__blaze->compiledPath.'/e08a1661f995972502d9b9feff3dd1ba.php'; } ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'size-4!']); ?>
<?php _e08a1661f995972502d9b9feff3dd1ba($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'size-4!'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
    <?php elseif ($iconTrailing): ?>
        <?php echo e($iconTrailing); ?>

    <?php endif; ?>

    <?php if (isset($badge) && $badge !== ''): ?>
        <?php $badgeAttributes = Flux::attributesAfter('badge:', $attributes, ['color' => $badgeColor]); ?>
        <?php if (!function_exists('_05ddb5adb7120ac43e47d20769e08cc5')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/navlist/badge.blade.php', $__blaze->compiledPath.'/05ddb5adb7120ac43e47d20769e08cc5.php'); require $__blaze->compiledPath.'/05ddb5adb7120ac43e47d20769e08cc5.php'; } ?>
<?php if (isset($__slots05ddb5adb7120ac43e47d20769e08cc5)) { $__slotsStack05ddb5adb7120ac43e47d20769e08cc5[] = $__slots05ddb5adb7120ac43e47d20769e08cc5; } ?>
<?php if (isset($__attrs05ddb5adb7120ac43e47d20769e08cc5)) { $__attrsStack05ddb5adb7120ac43e47d20769e08cc5[] = $__attrs05ddb5adb7120ac43e47d20769e08cc5; } ?>
<?php $__attrs05ddb5adb7120ac43e47d20769e08cc5 = ['attributes' => $badgeAttributes]; ?>
<?php $__slots05ddb5adb7120ac43e47d20769e08cc5 = []; ?>
<?php $__blaze->pushData($__attrs05ddb5adb7120ac43e47d20769e08cc5); ?>
<?php ob_start(); ?><?php echo e($badge); ?><?php $__slots05ddb5adb7120ac43e47d20769e08cc5['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots05ddb5adb7120ac43e47d20769e08cc5); ?>
<?php _05ddb5adb7120ac43e47d20769e08cc5($__blaze, $__attrs05ddb5adb7120ac43e47d20769e08cc5, $__slots05ddb5adb7120ac43e47d20769e08cc5, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack05ddb5adb7120ac43e47d20769e08cc5)) { $__slots05ddb5adb7120ac43e47d20769e08cc5 = array_pop($__slotsStack05ddb5adb7120ac43e47d20769e08cc5); } ?>
<?php if (! empty($__attrsStack05ddb5adb7120ac43e47d20769e08cc5)) { $__attrs05ddb5adb7120ac43e47d20769e08cc5 = array_pop($__attrsStack05ddb5adb7120ac43e47d20769e08cc5); } ?>
<?php $__blaze->popData(); ?>
    <?php endif; ?>
<?php $__slots9df618fa90f90ce8db365a2645931bfd['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots9df618fa90f90ce8db365a2645931bfd); ?>
<?php _9df618fa90f90ce8db365a2645931bfd($__blaze, $__attrs9df618fa90f90ce8db365a2645931bfd, $__slots9df618fa90f90ce8db365a2645931bfd, ['attributes', 'dataFluxNavlistItem'], ['dataFluxNavlistItem' => 'data-flux-navlist-item'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack9df618fa90f90ce8db365a2645931bfd)) { $__slots9df618fa90f90ce8db365a2645931bfd = array_pop($__slotsStack9df618fa90f90ce8db365a2645931bfd); } ?>
<?php if (! empty($__attrsStack9df618fa90f90ce8db365a2645931bfd)) { $__attrs9df618fa90f90ce8db365a2645931bfd = array_pop($__attrsStack9df618fa90f90ce8db365a2645931bfd); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/navlist/item.blade.php ENDPATH**/ ?>