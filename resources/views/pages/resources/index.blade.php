@extends('narsil::layouts.auth')

@php
	$payload =
	    is_object($collection) && method_exists($collection, 'toBladeData') ? $collection->toBladeData() : $collection;
@endphp

@section('body')
	<main
		class="h-[calc(100vh-3.25rem)] overflow-hidden"
	>
		<x-narsil::ui.section.root
			class="animate-in fade-in-0 h-full gap-2 p-4"
		>
			<x-narsil::ui.section.header
				class="flex items-center justify-between gap-2"
			>
				<x-narsil::ui.heading.root
					class="min-w-1/5"
					level="h1"
					variant="h4"
				>
					{{ $title }}
				</x-narsil::ui.heading.root>
				@if (data_get($payload, 'meta.routes.create'))
					<x-narsil::ui.button.root
						:href="route(data_get($payload, 'meta.routes.create'), data_get($payload, 'meta.routes.parameters', []))"
						native-button="false"
					>
						<x-narsil::ui.icon.root
							name="plus"
						/>
						{{ trans('narsil::ui.create') }}
					</x-narsil::ui.button.root>
				@endif
			</x-narsil::ui.section.header>
			<x-narsil::ui.section.content
				class="min-h-0 grow gap-3"
			>
				<x-narsil::blocks.data-table.root
					:payload="$payload"
				/>
			</x-narsil::ui.section.content>
		</x-narsil::ui.section.root>
	</main>
@endsection
