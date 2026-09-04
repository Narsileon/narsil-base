@extends('narsil::layouts.auth')

@php
	$payload =
	    is_object($collection) && method_exists($collection, 'toBladeData') ? $collection->toBladeData() : $collection;
@endphp

@section('body')
	<main
		class="h-full overflow-hidden"
	>
		<x-narsil::ui.section.section-root
			class="animate-in fade-in-0 h-full gap-2 p-4"
		>
			<x-narsil::ui.section.section-header
				class="flex items-center justify-between gap-2"
			>
				<x-narsil::ui.heading.heading-root
					class="min-w-1/5"
					level="h1"
					variant="h4"
				>
					{{ $title }}
				</x-narsil::ui.heading.heading-root>
				@if (data_get($payload, 'meta.routes.create'))
					<x-narsil::ui.button.button-root
						:href="route(data_get($payload, 'meta.routes.create'), data_get($payload, 'meta.routes.parameters', []))"
						native-button="false"
					>
						<x-narsil::ui.icon.icon-root
							name="plus"
						/>
						{{ trans('narsil::ui.create') }}
					</x-narsil::ui.button.button-root>
				@endif
			</x-narsil::ui.section.section-header>
			<x-narsil::ui.section.section-content
				class="min-h-0 grow gap-3"
			>
				<x-narsil::blocks.data-table.data-table-root
					:payload="$payload"
				/>
			</x-narsil::ui.section.section-content>
		</x-narsil::ui.section.section-root>
	</main>
@endsection
