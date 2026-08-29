<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0" name="viewport">
    <link href="/favicon.svg" rel="icon">
    <script>
        (() => {
            const theme = @js(session(\Narsil\Base\Models\Users\UserConfiguration::THEME, \Narsil\Base\Enums\ThemeEnum::SYSTEM->value));
            const isDark = theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            const root = document.documentElement;

            root.classList.toggle('dark', isDark);
            root.classList.toggle('light', !isDark);

            const storedColor = JSON.parse(localStorage.getItem('narsil:color') || 'null');
            const storedRadius = JSON.parse(localStorage.getItem('narsil:radius') || 'null');

            if (storedColor?.state?.color)
                root.dataset.color = storedColor.state.color;

            if (storedRadius?.state?.radius !== undefined)
                root.style.setProperty('--radius', `${storedRadius.state.radius}rem`);
        })();
    </script>
    @vite('resources/css/backend.css')
    @livewireStyles
</head>
<body class="min-h-screen bg-background text-foreground antialiased">
    @php($menu = app(\Narsil\Base\Contracts\Menus\GuestMenu::class)->jsonSerialize())
    <header class="sticky top-0 z-10 flex h-13 items-center border-b bg-sidebar shadow">
        <div class="mx-auto flex h-full w-full max-w-7xl items-center justify-between px-4 md:px-8">
            <x-narsil::ui.logo.root :show-name="false" />
            <x-narsil::ui.dropdown-menu.root>
                <x-narsil::ui.dropdown-menu.trigger
                    aria-label="{{ trans('narsil-cms::accessibility.user_menu') }}"
                    class="inline-flex size-9 items-center justify-center rounded-full text-primary transition-colors hover:bg-accent hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                >
                    <x-narsil::ui.icon.root class="size-5" name="bars" />
                </x-narsil::ui.dropdown-menu.trigger>
                <x-narsil::ui.dropdown-menu.positioner align="end">
                    <x-narsil::ui.dropdown-menu.popup class="border">
                    @foreach ($menu as $item)
                        @if (($item['id'] ?? null) === 'settings')
                            <x-narsil::ui.dropdown-menu.item
                                x-on:click="$dispatch('open-user-settings'); $dispatch('dialog-open')"
                            >
                                <x-narsil::ui.icon.root class="size-5 text-primary" :name="$item['icon'] ?? ''" />
                                {{ $item['label'] }}
                            </x-narsil::ui.dropdown-menu.item>
                        @else
                            <x-narsil::ui.dropdown-menu.item
                                :href="route($item['route'], $item['parameters'] ?? [])"
                            >
                                <x-narsil::ui.icon.root class="size-5 text-primary" :name="$item['icon'] ?? ''" />
                                {{ $item['label'] }}
                            </x-narsil::ui.dropdown-menu.item>
                        @endif
                    @endforeach
                    <x-narsil::ui.dropdown-menu.separator />
                    <div class="px-1 py-1">
                        <livewire:narsil-theme />
                    </div>
                    </x-narsil::ui.dropdown-menu.popup>
                </x-narsil::ui.dropdown-menu.positioner>
            </x-narsil::ui.dropdown-menu.root>
        </div>
    </header>
    <livewire:narsil-user-settings />
    @yield('body')
    @livewireScripts
</body>
</html>
