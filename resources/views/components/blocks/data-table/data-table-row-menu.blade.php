@php $routeParameters = [...$parameters, data_get($routes, 'parameter', 'id') => $id]; @endphp
<x-narsil::ui.dropdown-menu.dropdown-menu-root>
	<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
		aria-label="{{ trans('narsil::ui.menu') }}"
		variant="ghost-secondary"
	>
		<x-narsil::ui.icon.icon-root
			name="more-horizontal"
		/>
	</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
	<x-narsil::ui.dropdown-menu.dropdown-menu-positioner
		align="end"
	>
		<x-narsil::ui.dropdown-menu.dropdown-menu-popup>
			@if (data_get($routes, 'edit'))
				<x-narsil::ui.dropdown-menu.dropdown-menu-item
					:href="route(data_get($routes, 'edit'), $routeParameters)"
				>
					<x-narsil::ui.icon.icon-root
						name="edit"
					/>
					{{ trans('narsil::ui.edit') }}
				</x-narsil::ui.dropdown-menu.dropdown-menu-item>
			@endif
			@if (data_get($routes, 'destroy'))
				<form
					action="{{ route(data_get($routes, 'destroy'), $routeParameters) }}"
					method="POST"
				>
					@csrf @method('DELETE')
					<button
						class="flex w-full items-center gap-2 px-3 py-2 text-left text-sm"
						type="submit"
					>
						<x-narsil::ui.icon.icon-root
							name="trash"
						/>
						{{ trans('narsil::ui.delete') }}
					</button>
				</form>
			@endif
		</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
	</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
</x-narsil::ui.dropdown-menu.dropdown-menu-root>
