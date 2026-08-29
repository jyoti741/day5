<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2.5 me-6 shrink-0">
                <div class="flex aspect-square size-8 items-center justify-center rounded-lg bg-indigo-600 text-white font-bold shadow-sm">
                    <flux:icon name="clipboard-document-check" class="size-5" />
                </div>
                <span class="font-bold text-base text-zinc-900 dark:text-white tracking-tight">
                    {{ config('office.app_name', 'ASTGD Task Tracker') }}
                </span>
            </a>

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                <flux:navbar.item icon="clipboard-document-list" :href="route('tasks')" :current="request()->routeIs('tasks')" wire:navigate>
                    {{ __('Task Management') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-2 space-x-1.5 rtl:space-x-reverse py-0! flex items-center">
                {{-- Bright & Dark Theme Mode Switcher --}}
                <flux:dropdown position="bottom" align="end">
                    <button
                        type="button"
                        class="flex h-9 items-center gap-1.5 px-3 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700/70 shadow-2xs transition cursor-pointer text-xs font-semibold"
                        aria-label="Theme mode switcher"
                        title="Theme: Bright / Dark Mode"
                    >
                        <span class="dark:hidden flex items-center gap-1.5 text-amber-600">
                            <flux:icon name="sun" class="size-4" />
                            <span>Bright</span>
                        </span>
                        <span class="hidden dark:flex items-center gap-1.5 text-indigo-400">
                            <flux:icon name="moon" class="size-4" />
                            <span>Dark</span>
                        </span>
                        <flux:icon name="chevron-down" class="size-3 text-zinc-400" />
                    </button>

                    <flux:menu class="w-44">
                        <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">
                            <span class="font-medium">Bright (Light)</span>
                        </flux:menu.item>
                        <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">
                            <span class="font-medium">Dark Mode</span>
                        </flux:menu.item>
                        <flux:menu.separator />
                        <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">
                            <span class="font-medium">System Default</span>
                        </flux:menu.item>
                    </flux:menu>
                </flux:dropdown>

                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
                <flux:tooltip :content="__('Repository')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="folder-git-2"
                        href="https://github.com/laravel/livewire-starter-kit"
                        target="_blank"
                        :label="__('Repository')"
                    />
                </flux:tooltip>
                <flux:tooltip :content="__('Documentation')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="book-open-text"
                        href="https://laravel.com/docs/starter-kits#livewire"
                        target="_blank"
                        :label="__('Documentation')"
                    />
                </flux:tooltip>
            </flux:navbar>

            <x-desktop-user-menu />
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Platform')">
                    <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard')  }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
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

            {{-- Company Info in Mobile Sidebar --}}
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
        </flux:sidebar>

        <div class="flex flex-col min-h-[calc(100vh-theme(spacing.16))]">
            <div class="flex-1">
                {{ $slot }}
            </div>
            @include('partials.footer')
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
