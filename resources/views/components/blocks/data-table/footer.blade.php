@props(['payload'])

@php
	$links = data_get($payload, 'links', []);
@endphp

<div
	class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center"
>
	<x-narsil::blocks.data-table.selection
		:payload="$payload"
	/>
	<div
		class="flex items-center gap-4"
	>
		<x-narsil::blocks.data-table.page-size
			:payload="$payload"
		/>
		<x-narsil::blocks.data-table.results
			:payload="$payload"
		/>
		<x-narsil::ui.pagination.root
			class="flex items-center gap-2"
		>
			@foreach ($links as $link)
				<x-narsil::ui.pagination.link
					:active="$link['active'] ?? false"
					:disabled="!($link['url'] ?? null)"
					:href="$link['url'] ?? null"
				>
					{!! $link['label'] !!}
				</x-narsil::ui.pagination.link>
			@endforeach
		</x-narsil::ui.pagination.root>
	</div>
</div>
