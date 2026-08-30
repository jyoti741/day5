<x-layouts::auth :title="request()->query('portal') === 'admin' ? __('Admin Portal Login') : __('Log in')">
    <div x-data="{
        portal: '{{ request()->query('portal', 'staff') }}',
        email: '{{ old('email', '') }}',
        password: '',
        fillAdmin() {
            this.portal = 'admin';
            this.email = 'admin@astgd.com';
            this.password = 'password';
        }
    }" class="flex flex-col gap-6">
        
        {{-- Portal Switcher Pills --}}
        <div class="flex items-center p-1 rounded-xl bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-xs font-semibold">
            <button
                type="button"
                @click="portal = 'staff'"
                :class="portal === 'staff' ? 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white shadow-xs' : 'text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200'"
                class="flex-1 py-2 rounded-lg text-center transition cursor-pointer flex items-center justify-center gap-1.5"
            >
                <flux:icon name="user" class="size-3.5" />
                <span>Staff Login</span>
            </button>

            <button
                type="button"
                @click="portal = 'admin'"
                :class="portal === 'admin' ? 'bg-indigo-600 text-white shadow-xs font-bold' : 'text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200'"
                class="flex-1 py-2 rounded-lg text-center transition cursor-pointer flex items-center justify-center gap-1.5"
            >
                <flux:icon name="shield-check" class="size-3.5" />
                <span>🛡️ Admin Portal</span>
            </button>
        </div>

        {{-- Admin Banner Header --}}
        <template x-if="portal === 'admin'">
            <div class="p-4 rounded-xl bg-gradient-to-r from-indigo-900 via-indigo-950 to-slate-900 text-white border border-indigo-700/60 shadow-sm space-y-1">
                <div class="flex items-center gap-2 text-indigo-300 text-xs font-extrabold uppercase tracking-wider">
                    <flux:icon name="shield-check" class="size-4 text-indigo-400" />
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
                        <flux:icon name="bolt" class="size-3.5 text-amber-300" />
                        <span>Quick Fill Admin Credentials (admin@astgd.com)</span>
                    </button>
                </div>
            </div>
        </template>

        <div x-show="portal === 'admin'">
            <x-auth-header :title="__('Log in to Admin Portal')" :description="__('Enter your administrator email and password below')" />
        </div>
        <div x-show="portal !== 'admin'">
            <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <x-passkey-verify />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                x-model="email"
                :label="__('Email address')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    x-model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button
                    variant="primary"
                    type="submit"
                    class="w-full"
                    data-test="login-button"
                >
                    <span x-text="portal === 'admin' ? '{{ __('Sign In as Administrator') }}' : '{{ __('Log in') }}'"></span>
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Don\'t have an account?') }}</span>
            <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
