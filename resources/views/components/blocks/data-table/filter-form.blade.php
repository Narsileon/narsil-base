@props(['payload'])

@php
	$columns = collect(data_get(data_get($payload, 'meta', []), 'columns', []));
@endphp

<form
	action="{{ request()->url() }}"
	class="flex flex-col gap-3"
	method="GET"
>
	<select
		name="column_filters[0][id]"
		required
	>
		@foreach ($columns as $column)
			<option
				value="{{ data_get($column, 'id') }}"
			>
				{{ ucfirst(data_get($column, 'header', data_get($column, 'id'))) }}
			</option>
		@endforeach
	</select>
	<select
		name="column_filters[0][value][operator]"
		required
	>
		@foreach (['contains', 'equals', 'starts_with', 'ends_with'] as $operator)
			<option
				value="{{ $operator }}"
			>
				{{ trans('narsil::operators.' . $operator) }}
			</option>
		@endforeach
	</select>
	<x-narsil::ui.input.root
		name="column_filters[0][value][value]"
		required
	/>
	<x-narsil::ui.button.root
		type="submit"
	>
		{{ trans('narsil::ui.apply') }}
	</x-narsil::ui.button.root>
</form>
