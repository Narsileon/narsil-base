<main class="relative flex min-h-[calc(100vh-3.25rem)] items-center justify-center overflow-hidden">
    <x-narsil::ui.container.root
        class="h-[inherit] min-h-[inherit] justify-center"
        variant="sm"
    >
        <x-narsil::ui.section.root
            class="animate-in py-4 fade-in-0 slide-in-from-bottom-10"
        >
            <x-narsil::ui.section.header>
                <x-narsil::ui.heading.root
                    level="h1"
                    variant="h4"
                >
                    {{ trans('narsil::ui.connection') }}
                </x-narsil::ui.heading.root>
            </x-narsil::ui.section.header>
            <x-narsil::ui.section.content>
                <x-narsil::block.login-form />
            </x-narsil::ui.section.content>
        </x-narsil::ui.section.root>
    </x-narsil::ui.container.root>
</main>
