@props(['column', 'payload'])
@php
	$state = data_get($payload, 'meta.state', []);
	$sorting = data_get($state, 'sorting', []);
	$current = collect($sorting)->firstWhere('id', $column['id']);
@endphp
<button
	class="flex items-center gap-1 font-medium"
	type="button"
	x-on:click="sort('{{ $column['id'] }}')"
>
	{{ ucfirst($column['header'] ?? $column['id']) }}
	<x-narsil::ui.icon.root
		:name="$current ? ($current['desc'] ? 'chevron-down' : 'chevron-up') : 'chevrons-up-down'"
	/>
</button>
