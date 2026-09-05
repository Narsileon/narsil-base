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
	<x-narsil::blocks.select.select-root
		:id="'page-size'"
		:name="'page_size'"
		:options="$options()"
		:value="(string) data_get($state, 'page_size', 10)"
		x-on:select-change="$el.closest('form').submit()"
	/>
</form>
