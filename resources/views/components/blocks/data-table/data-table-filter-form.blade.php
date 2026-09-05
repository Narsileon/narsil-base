<form
	action="{{ request()->url() }}"
	class="flex flex-col gap-3"
	method="GET"
>
	<x-narsil::blocks.select.select-root
		:id="'filter-column'"
		:name="'column_filters[0][id]'"
		:options="$columnOptions()"
		:required="true"
		:value="$columnOptions()[0]['value'] ?? null"
	/>
	<x-narsil::blocks.select.select-root
		:id="'filter-operator'"
		:name="'column_filters[0][value][operator]'"
		:options="$operatorOptions()"
		:required="true"
		:value="$operatorOptions()[0]['value'] ?? null"
	/>
	<x-narsil::ui.input.input-root
		name="column_filters[0][value][value]"
		required
	/>
	<x-narsil::ui.button.button-root
		type="submit"
	>
		{{ trans('narsil::ui.apply') }}
	</x-narsil::ui.button.button-root>
</form>
