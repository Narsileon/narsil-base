@extends('narsil::layouts.auth')

@section('body')
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
                        {{ $title }}
                    </x-narsil::ui.heading.root>
                </x-narsil::ui.section.header>
                <x-narsil::ui.section.content>
                    <x-narsil::block.fortify-form :form="$form" :token="$token ?? null" />
                </x-narsil::ui.section.content>
            </x-narsil::ui.section.root>
        </x-narsil::ui.container.root>
    </main>
@endsection
