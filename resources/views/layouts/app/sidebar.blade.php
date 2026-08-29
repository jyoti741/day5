<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2.5 min-w-0">
                    <div class="flex aspect-square size-8 items-center justify-center rounded-lg bg-indigo-600 text-white font-bold shadow-sm shrink-0">
                        <flux:icon name="clipboard-document-check" class="size-5" />
                    </div>
                    <span class="font-bold text-base text-zinc-900 dark:text-white tracking-tight truncate">
                        {{ config('office.app_name', 'ASTGD Task Tracker') }}
                    </span>
                </a>
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="config('office.app_name', config('app.name', 'ASTGD Task Tracker'))" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="clipboard-document-list" :href="route('tasks')" :current="request()->routeIs('tasks')" wire:navigate>
                        {{ __('Task Management') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>

                {{-- Bright & Dark Mode Segmented Switcher in Sidebar --}}
                <div class="px-2 pt-2">
                    <div class="flex items-center p-1 rounded-xl bg-zinc-200/70 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700/60 text-xs font-semibold">
                        <button
                            type="button"
                            x-on:click="$flux.appearance = 'light'"
                            class="flex-1 flex items-center justify-center gap-1.5 py-1.5 rounded-lg transition cursor-pointer"
                            :class="($flux.appearance === 'light' || ($flux.appearance === 'system' && ! $flux.dark)) ? 'bg-white dark:bg-zinc-700 text-amber-600 font-bold shadow-xs' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-200'"
                            title="Switch to Bright (Light) Mode"
                        >
                            <flux:icon name="sun" class="size-3.5" />
                            <span>Bright</span>
                        </button>
                        <button
                            type="button"
                            x-on:click="$flux.appearance = 'dark'"
                            class="flex-1 flex items-center justify-center gap-1.5 py-1.5 rounded-lg transition cursor-pointer"
                            :class="($flux.appearance === 'dark' || ($flux.appearance === 'system' && $flux.dark)) ? 'bg-white dark:bg-zinc-700 text-indigo-500 font-bold shadow-xs' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-200'"
                            title="Switch to Dark Mode"
                        >
                            <flux:icon name="moon" class="size-3.5" />
                            <span>Dark</span>
                        </button>
                    </div>
                </div>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            {{-- Company & Office Info in Sidebar --}}
            <div class="px-3 py-2.5 mx-1 mb-2 rounded-xl bg-zinc-100/80 dark:bg-zinc-800/60 border border-zinc-200/70 dark:border-zinc-700/60 text-xs space-y-1.5">
                <div class="flex items-center gap-1.5 font-bold text-zinc-900 dark:text-zinc-100 truncate">
                    <flux:icon name="building-office-2" class="size-4 text-indigo-500 shrink-0" />
                    <span class="truncate">{{ config('office.company_name', 'ASTGD') }}</span>
                </div>
                <div class="flex items-center gap-1 text-[11px] text-zinc-500 dark:text-zinc-400">
                    <flux:icon name="envelope" class="size-3 text-zinc-400 shrink-0" />
                    <a href="mailto:{{ config('office.company_email', 'office@example.com') }}" class="truncate hover:text-indigo-600 dark:hover:text-indigo-400 hover:underline">
                        {{ config('office.company_email', 'office@example.com') }}
                    </a>
                </div>
            </div>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 font-bold text-sm text-zinc-900 dark:text-white">
                    <div class="flex aspect-square size-7 items-center justify-center rounded-lg bg-indigo-600 text-white font-bold shadow-sm">
                        <flux:icon name="clipboard-document-check" class="size-4" />
                    </div>
                    <span class="truncate">{{ config('office.app_name', 'ASTGD Task Tracker') }}</span>
                </a>
            </div>

            <div class="flex items-center gap-2">
                {{-- Quick Theme Toggle for Mobile --}}
                <button
                    type="button"
                    x-on:click="$flux.appearance = ($flux.appearance === 'dark' || ($flux.appearance === 'system' && $flux.dark)) ? 'light' : 'dark'"
                    class="p-2 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700 transition cursor-pointer"
                    aria-label="Toggle Bright/Dark Mode"
                    title="Toggle Bright/Dark Mode"
                >
                    <span class="dark:hidden">
                        <flux:icon name="sun" class="size-4 text-amber-600" />
                    </span>
                    <span class="hidden dark:inline">
                        <flux:icon name="moon" class="size-4 text-indigo-400" />
                    </span>
                </button>

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

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
                    </flux:menu.radio.group>

                    <flux:menu.separator />

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
                </flux:menu>
            </flux:dropdown>
            </div>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
