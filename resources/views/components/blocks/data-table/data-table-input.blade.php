@php
	$state = data_get($payload, 'meta.state', []);
@endphp

<form
	action="{{ request()->url() }}"
	class="flex grow justify-end"
	method="GET"
>
	<x-narsil::ui.input-group.input-group-root
		class="max-w-3xs transition-all duration-300 focus-within:max-w-lg"
	>
		<x-narsil::ui.input-group.input-group-addon>
			<x-narsil::ui.icon.icon-root
				name="search"
			/>
		</x-narsil::ui.input-group.input-group-addon>
		<x-narsil::ui.input-group.input-group-input
			name="global_filter"
			placeholder="{{ trans('narsil::placeholders.search') }}"
			value="{{ data_get($state, 'global_filter', '') }}"
		/>
	</x-narsil::ui.input-group.input-group-root>
</form>
