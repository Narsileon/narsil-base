<form
	action="{{ request()->url() }}"
	class="flex grow justify-start"
	method="GET"
>
	<x-narsil::ui.input-group.input-group-root
		class="max-w-3xs transition-all duration-300 focus-within:max-w-sm"
	>
		<x-narsil::ui.input-group.input-group-addon>
			<x-narsil::ui.icon.icon-root
				name="search"
			/>
		</x-narsil::ui.input-group.input-group-addon>
		<x-narsil::ui.input-group.input-group-input
			name="global_filter"
			placeholder="{{ trans('narsil::placeholders.search') }}"
			value="{{ $state['global_filter'] ?? '' }}"
		/>
	</x-narsil::ui.input-group.input-group-root>
</form>
