<form
	action="{{ $uuid ? route('narsil.tables.update', $uuid) : request()->url() }}"
	class="flex flex-col gap-3"
	method="{{ $uuid ? 'POST' : 'GET' }}"
	@if ($uuid)
		x-on:submit.prevent="editingFilterIndex = {{ $hasFilter ? $filter['index'] : 'null' }}; applyFilter($el); $dispatch('popover-close')"
	@endif
>
	@if ($uuid)
		@csrf @method('PATCH')
	@endif
	<x-narsil::blocks.select.select-root
		:id="'filter-column'"
		:name="'column_filters[0][id]'"
		:options="$columnOptions()"
		:required="true"
		:value="$columnValue()"
	/>
	<x-narsil::blocks.select.select-root
		:id="'filter-operator'"
		:name="'column_filters[0][value][operator]'"
		:options="$operatorOptions()"
		:required="true"
		:value="$operatorValue()"
	/>
	<x-narsil::ui.input.input-root
		name="column_filters[0][value][value]"
		required
		value="{{ $value() }}"
	/>
	<div
		class="flex gap-2"
	>
		@if (!$hasFilter && $uuid)
			<x-narsil::ui.button.button-root
				class="flex-1"
				type="button"
				variant="secondary"
				x-on:click="filters = []; persist(); $dispatch('popover-close')"
			>
				{{ trans('narsil::ui.reset') }}
			</x-narsil::ui.button.button-root>
		@endif
		@if ($hasFilter)
			<x-narsil::ui.button.button-root
				class="flex-1"
				type="button"
				variant="secondary"
				x-on:click="editingFilterIndex = {{ $filter['index'] }}; removeFilter(); $dispatch('popover-close')"
			>
				{{ trans('narsil::ui.delete') }}
			</x-narsil::ui.button.button-root>
		@endif
		<x-narsil::ui.button.button-root
			class="flex-1"
			type="submit"
		>
			{{ trans('narsil::ui.apply') }}
		</x-narsil::ui.button.button-root>
	</div>
</form>
