@extends('narsil::layouts.auth')

@section('hideBreadcrumb', 'true')

@section('body')
	<main
		class="flex min-h-[calc(100vh-3.25rem)] w-full items-center justify-center"
	>
		<x-narsil::ui.container.container-root
			class="h-[inherit] min-h-[inherit] justify-center"
			variant="sm"
		>
			<x-narsil::ui.heading.heading-root
				class="text-center"
				level="h1"
				variant="h3"
			>
				{{ $title }}
			</x-narsil::ui.heading.heading-root>
			<p
				class="text-center text-base"
			>
				{{ $description }}
			</p>
		</x-narsil::ui.container.container-root>
	</main>
@endsection
