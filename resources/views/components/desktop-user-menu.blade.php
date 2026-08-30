<flux:dropdown position="bottom" align="start">
    <flux:sidebar.profile
        :name="auth()->user()->name"
        :initials="auth()->user()->initials()"
        icon:trailing="chevrons-up-down"
        data-test="sidebar-menu-button"
    />

    <flux:menu>
        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
            <flux:avatar
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
            />
            <div class="grid flex-1 text-start text-sm leading-tight">
                <div class="flex items-center gap-1.5">
                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                    @if (auth()->user()->isAdmin())
                        <span class="px-1.5 py-0.5 text-[10px] font-black uppercase text-indigo-700 dark:text-indigo-300 bg-indigo-100 dark:bg-indigo-950 rounded border border-indigo-300 dark:border-indigo-700">
                            🛡️ Admin
                        </span>
                    @endif
                </div>
                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
            </div>
        </div>
        <flux:menu.separator />
        <flux:menu.radio.group>
            <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">
                <span>{{ __('Bright Theme') }}</span>
            </flux:menu.item>
            <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">
                <span>{{ __('Dark Theme') }}</span>
            </flux:menu.item>
        </flux:menu.radio.group>
        <flux:menu.separator />
        <flux:menu.radio.group>
            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                {{ __('Settings') }}
            </flux:menu.item>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer"
                    data-test="logout-button"
                >
                    {{ __('Log out') }}
                </flux:menu.item>
            </form>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
