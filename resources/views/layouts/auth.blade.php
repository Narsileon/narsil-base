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
    <x-narsil::block.auth-header />
    <livewire:narsil-user-settings />
    @yield('body')
    @livewireScripts
</body>
</html>
