@props(['payload'])

@php $state = data_get(data_get($payload, 'meta', []), 'state', []); @endphp

<form
	action="{{ route('narsil.tables.update', data_get($state, 'uuid')) }}"
	class="flex items-center gap-2"
	method="POST"
>
	@csrf @method('PATCH')
	<span>
		{{ trans('narsil::data-table.pagination') }}
	</span>
	<select
		name="page_size"
		onchange="this.form.submit()"
	>
		@foreach ([10, 25, 50, 100] as $size)
			<option
				@selected((int) data_get($state, 'page_size', 10) === $size)
				value="{{ $size }}"
			>
				{{ $size }}
			</option>
		@endforeach
	</select>
</form>
