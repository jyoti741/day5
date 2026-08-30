<?php # [BlazeFolded]:{flux::icon}:{C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php}:{1787526214} ?>
<?php # [BlazeFolded]:{flux::icon}:{C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php}:{1787526214} ?>
<?php # [BlazeFolded]:{flux::icon}:{C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php}:{1787526214} ?>
<?php # [BlazeFolded]:{flux::icon}:{C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php}:{1787526214} ?>
<?php # [BlazeFolded]:{flux::link}:{C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/link.blade.php}:{1787526214} ?>
<?php # [BlazeFolded]:{flux::button}:{C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php}:{1787526214} ?>
<?php # [BlazeFolded]:{flux::link}:{C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/link.blade.php}:{1787526214} ?>
<?php if (isset($component)) { $__componentOriginal08b8a564843783787e0bee3357e24f38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal08b8a564843783787e0bee3357e24f38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'f4ac99e09542ff494432bc959d4fee61::auth','data' => ['title' => request()->query('portal') === 'admin' ? __('Admin Portal Login') : __('Log in')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts::auth'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->query('portal') === 'admin' ? __('Admin Portal Login') : __('Log in'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div x-data="{
        portal: '<?php echo e(request()->query('portal', 'staff')); ?>',
        email: '<?php echo e(old('email', '')); ?>',
        password: '',
        fillAdmin() {
            this.portal = 'admin';
            this.email = 'admin@astgd.com';
            this.password = 'password';
        }
    }" class="flex flex-col gap-6">
        
        
        <div class="flex items-center p-1 rounded-xl bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-xs font-semibold">
            <button
                type="button"
                @click="portal = 'staff'"
                :class="portal === 'staff' ? 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white shadow-xs' : 'text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200'"
                class="flex-1 py-2 rounded-lg text-center transition cursor-pointer flex items-center justify-center gap-1.5"
            >
                <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-3.5" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                <span>Staff Login</span>
            </button>

            <button
                type="button"
                @click="portal = 'admin'"
                :class="portal === 'admin' ? 'bg-indigo-600 text-white shadow-xs font-bold' : 'text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200'"
                class="flex-1 py-2 rounded-lg text-center transition cursor-pointer flex items-center justify-center gap-1.5"
            >
                <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-3.5" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                <span>🛡️ Admin Portal</span>
            </button>
        </div>

        
        <template x-if="portal === 'admin'">
            <div class="p-4 rounded-xl bg-gradient-to-r from-indigo-900 via-indigo-950 to-slate-900 text-white border border-indigo-700/60 shadow-sm space-y-1">
                <div class="flex items-center gap-2 text-indigo-300 text-xs font-extrabold uppercase tracking-wider">
                    <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-4 text-indigo-400" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                    <span>Administrator Control Portal</span>
                </div>
                <h3 class="font-bold text-sm text-white">System Admin Sign-In</h3>
                <p class="text-xs text-indigo-200/80 leading-relaxed">
                    Access task administrative metrics, user assignments, and office tracker configuration.
                </p>

                <div class="pt-2">
                    <button
                        type="button"
                        @click="fillAdmin()"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold bg-indigo-500/30 hover:bg-indigo-500/50 text-indigo-100 border border-indigo-400/40 transition cursor-pointer flex items-center gap-1.5"
                    >
                        <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-3.5 text-amber-300" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                        <span>Quick Fill Admin Credentials (admin@astgd.com)</span>
                    </button>
                </div>
            </div>
        </template>

        <div x-show="portal === 'admin'">
            <?php if (isset($component)) { $__componentOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-header','data' => ['title' => __('Log in to Admin Portal'),'description' => __('Enter your administrator email and password below')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Log in to Admin Portal')),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter your administrator email and password below'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd)): ?>
<?php $attributes = $__attributesOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd; ?>
<?php unset($__attributesOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd)): ?>
<?php $component = $__componentOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd; ?>
<?php unset($__componentOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd); ?>
<?php endif; ?>
        </div>
        <div x-show="portal !== 'admin'">
            <?php if (isset($component)) { $__componentOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-header','data' => ['title' => __('Log in to your account'),'description' => __('Enter your email and password below to log in')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Log in to your account')),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter your email and password below to log in'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd)): ?>
<?php $attributes = $__attributesOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd; ?>
<?php unset($__attributesOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd)): ?>
<?php $component = $__componentOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd; ?>
<?php unset($__componentOriginale5d2f2831f58fdbe96ad6d7cbd41a7dd); ?>
<?php endif; ?>
        </div>

        <!-- Session Status -->
        <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'text-center','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-center','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal360dec750a5c22110ff2b6afe54f0581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal360dec750a5c22110ff2b6afe54f0581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.passkey-verify','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('passkey-verify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal360dec750a5c22110ff2b6afe54f0581)): ?>
<?php $attributes = $__attributesOriginal360dec750a5c22110ff2b6afe54f0581; ?>
<?php unset($__attributesOriginal360dec750a5c22110ff2b6afe54f0581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal360dec750a5c22110ff2b6afe54f0581)): ?>
<?php $component = $__componentOriginal360dec750a5c22110ff2b6afe54f0581; ?>
<?php unset($__componentOriginal360dec750a5c22110ff2b6afe54f0581); ?>
<?php endif; ?>

        <form method="POST" action="<?php echo e(route('login.store')); ?>" class="flex flex-col gap-6">
            <?php echo csrf_field(); ?>

            <!-- Email Address -->
            <?php if (!function_exists('_01037a522a3e13ab534f873493276cad')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/input/index.blade.php', $__blaze->compiledPath.'/01037a522a3e13ab534f873493276cad.php'); require $__blaze->compiledPath.'/01037a522a3e13ab534f873493276cad.php'; } ?>
<?php $__blaze->pushData(['name' => 'email','xModel' => 'email','label' => __('Email address'),'type' => 'email','required' => true,'autofocus' => true,'autocomplete' => 'email','placeholder' => 'email@example.com']); ?>
<?php _01037a522a3e13ab534f873493276cad($__blaze, ['name' => 'email','xModel' => 'email','label' => __('Email address'),'type' => 'email','required' => true,'autofocus' => true,'autocomplete' => 'email','placeholder' => 'email@example.com'], [], ['label', 'required', 'autofocus'], ['xModel' => 'x-model'], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>

            <!-- Password -->
            <div class="relative">
                <?php if (!function_exists('_01037a522a3e13ab534f873493276cad')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/input/index.blade.php', $__blaze->compiledPath.'/01037a522a3e13ab534f873493276cad.php'); require $__blaze->compiledPath.'/01037a522a3e13ab534f873493276cad.php'; } ?>
<?php $__blaze->pushData(['name' => 'password','xModel' => 'password','label' => __('Password'),'type' => 'password','required' => true,'autocomplete' => 'current-password','placeholder' => __('Password'),'viewable' => true]); ?>
<?php _01037a522a3e13ab534f873493276cad($__blaze, ['name' => 'password','xModel' => 'password','label' => __('Password'),'type' => 'password','required' => true,'autocomplete' => 'current-password','placeholder' => __('Password'),'viewable' => true], [], ['label', 'required', 'placeholder', 'viewable'], ['xModel' => 'x-model'], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('password.request')): ?>
                    <?php ob_start(); ?><a class="inline font-medium underline-offset-[6px] hover:decoration-current underline [[data-color]&gt;&amp;]:text-inherit [[data-color]&gt;&amp;]:decoration-current/20 dark:[[data-color]&gt;&amp;]:decoration-current/50 [[data-color]&gt;&amp;]:hover:decoration-current text-[var(--color-accent-content)] decoration-[color-mix(in_oklab,var(--color-accent-content),transparent_80%)] absolute top-0 text-sm end-0" <?php if (($__blazeAttr = route('password.request')) !== false && !is_null($__blazeAttr)): ?>href="<?php echo e($__blazeAttr === true ? 'href' : $__blazeAttr); ?>"<?php endif; unset($__blazeAttr); ?> wire:navigate="" data-flux-link ><?php ob_start(); ?>
                        <?php echo e(__('Forgot your password?')); ?>

                    <?php echo trim(ob_get_clean()); ?></a><?php echo ltrim(ob_get_clean()); ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Remember Me -->
            <?php if (!function_exists('_0306ad73cadfeba2c469b8189f97c47e')) { $__blaze->compile('C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\vendor\livewire\flux\src/../stubs/resources/views/flux/checkbox/index.blade.php', $__blaze->compiledPath.'/0306ad73cadfeba2c469b8189f97c47e.php'); require $__blaze->compiledPath.'/0306ad73cadfeba2c469b8189f97c47e.php'; } ?>
<?php $__blaze->pushData(['name' => 'remember','label' => __('Remember me'),'checked' => old('remember')]); ?>
<?php _0306ad73cadfeba2c469b8189f97c47e($__blaze, ['name' => 'remember','label' => __('Remember me'),'checked' => old('remember')], [], ['label', 'checked'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>

            <div class="flex items-center justify-end">
                <?php ob_start(); ?><button type="submit" class="relative items-center font-medium justify-center whitespace-nowrap disabled:opacity-50 dark:disabled:opacity-50 disabled:cursor-default disabled:pointer-events-none disabled:shadow-none justify-center h-10 text-sm rounded-lg gap-2 ps-4 pe-4 inline-flex  bg-[var(--color-accent)] hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] text-[var(--color-accent-foreground)] border border-black/10 dark:border-0 shadow-[inset_0px_1px_--theme(--color-white/.2)] [[data-flux-button-group]_&amp;]:border-e-0 [:is([data-flux-button-group]&gt;&amp;:last-child,_[data-flux-button-group]_:last-child&gt;&amp;)]:border-e-[1px] dark:[:is([data-flux-button-group]&gt;&amp;:last-child,_[data-flux-button-group]_:last-child&gt;&amp;)]:border-e-0 dark:[:is([data-flux-button-group]&gt;&amp;:last-child,_[data-flux-button-group]_:last-child&gt;&amp;)]:border-s-[1px] [:is([data-flux-button-group]&gt;&amp;:not(:first-child),_[data-flux-button-group]_:not(:first-child)&gt;&amp;)]:border-s-[color-mix(in_srgb,var(--color-accent-foreground),transparent_85%)] *:transition-opacity [&amp;[disabled]&gt;:not([data-flux-loading-indicator])]:opacity-0 [&amp;[disabled]&gt;[data-flux-loading-indicator]]:opacity-100 [&amp;[disabled]]:pointer-events-none  w-full" data-flux-button="data-flux-button" data-flux-group-target="data-flux-group-target" data-test="login-button">
        <div class="absolute inset-0 flex items-center justify-center opacity-0" data-flux-loading-indicator>
                <svg class="shrink-0 [:where(&amp;)]:size-4 animate-spin" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" data-slot="icon">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
</svg>
                    </div>
        
        
                    
            
            <span><?php ob_start(); ?>
                    <span x-text="portal === 'admin' ? '<?php echo e(__('Sign In as Administrator')); ?>' : '<?php echo e(__('Log in')); ?>'"></span>
                <?php echo trim(ob_get_clean()); ?></span>
    </button>
<?php echo ltrim(ob_get_clean()); ?>
            </div>
        </form>

        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
            <span><?php echo e(__('Don\'t have an account?')); ?></span>
            <?php ob_start(); ?><a class="inline font-medium underline-offset-[6px] hover:decoration-current underline [[data-color]&gt;&amp;]:text-inherit [[data-color]&gt;&amp;]:decoration-current/20 dark:[[data-color]&gt;&amp;]:decoration-current/50 [[data-color]&gt;&amp;]:hover:decoration-current text-[var(--color-accent-content)] decoration-[color-mix(in_oklab,var(--color-accent-content),transparent_80%)]" <?php if (($__blazeAttr = route('register')) !== false && !is_null($__blazeAttr)): ?>href="<?php echo e($__blazeAttr === true ? 'href' : $__blazeAttr); ?>"<?php endif; unset($__blazeAttr); ?> wire:navigate="" data-flux-link ><?php ob_start(); ?><?php echo e(__('Sign up')); ?><?php echo trim(ob_get_clean()); ?></a><?php echo ltrim(ob_get_clean()); ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal08b8a564843783787e0bee3357e24f38)): ?>
<?php $attributes = $__attributesOriginal08b8a564843783787e0bee3357e24f38; ?>
<?php unset($__attributesOriginal08b8a564843783787e0bee3357e24f38); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal08b8a564843783787e0bee3357e24f38)): ?>
<?php $component = $__componentOriginal08b8a564843783787e0bee3357e24f38; ?>
<?php unset($__componentOriginal08b8a564843783787e0bee3357e24f38); ?>
<?php endif; ?>
<?php /**PATH C:\Users\farza\.gemini\antigravity-ide\scratch\office-task-manager\resources\views/pages/auth/login.blade.php ENDPATH**/ ?>