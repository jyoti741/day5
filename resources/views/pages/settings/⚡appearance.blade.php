<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Appearance settings')] class extends Component {
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading level="2" class="sr-only">{{ __('Appearance settings') }}</flux:heading>

    <x-pages::settings.layout :heading="__('Theme & Appearance')" :subheading="__('Choose your preferred visual theme for the ASTGD Task Tracker interface')">
        <div class="space-y-4">
            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                <flux:radio value="light" icon="sun">{{ __('Bright (Light)') }}</flux:radio>
                <flux:radio value="dark" icon="moon">{{ __('Dark Mode') }}</flux:radio>
                <flux:radio value="system" icon="computer-desktop">{{ __('System Default') }}</flux:radio>
            </flux:radio.group>

            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                Choose <strong class="text-zinc-700 dark:text-zinc-300">Bright</strong> for a crisp, high-contrast light mode, <strong class="text-zinc-700 dark:text-zinc-300">Dark</strong> for a sleek dark mode, or <strong class="text-zinc-700 dark:text-zinc-300">System</strong> to match your device preference automatically.
            </p>
        </div>
    </x-pages::settings.layout>
</section>
