<form
	action="{{ request()->url() }}"
	class="flex grow justify-start"
	method="GET"
	x-on:submit.prevent="search = $event.target.querySelector('[name=global_filter]').value; persist()"
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
			x-init="
				const focus = JSON.parse(sessionStorage.getItem('narsil-data-table-focus') || 'null');

				if (focus?.path === window.location.pathname) {
					sessionStorage.removeItem('narsil-data-table-focus');
					$nextTick(() => {
						$el.focus();
						if (focus.start !== null) $el.setSelectionRange(focus.start, focus.end);
					});
				}
			"
			x-on:input.debounce.300ms="search = $event.target.value; persist()"
		/>
	</x-narsil::ui.input-group.input-group-root>
</form>
