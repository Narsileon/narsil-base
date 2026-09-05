@php
	$routeParameters = [...$parameters, data_get($routes, 'parameter', 'id') => $id];
	$destroyUrl = data_get($routes, 'destroy') ? route(data_get($routes, 'destroy'), $routeParameters) : null;
	$replicateUrl = data_get($routes, 'replicate') ? route(data_get($routes, 'replicate'), $routeParameters) : null;
@endphp
	<x-narsil::ui.dropdown-menu.dropdown-menu-root>
	<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
		aria-label="{{ trans('narsil::ui.menu') }}"
		class="inline-flex size-9 items-center justify-center"
		variant="ghost-secondary"
	>
		<x-narsil::ui.icon.icon-root
			name="more-horizontal"
		/>
	</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
	<x-narsil::ui.dropdown-menu.dropdown-menu-portal>
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
				@if ($replicateUrl)
					<form
						action="{{ $replicateUrl }}"
						class="w-full"
						method="POST"
					>
						@csrf
						<input
							name="_back"
							type="hidden"
							value="1"
						>
						<x-narsil::ui.button.button-root
							class="w-full justify-start"
							size="sm"
							type="submit"
							variant="ghost"
						>
							<x-narsil::ui.icon.icon-root name="copy" />
							{{ trans('narsil::ui.duplicate') }}
						</x-narsil::ui.button.button-root>
					</form>
				@endif
				@if ($destroyUrl && (data_get($routes, 'edit') || $replicateUrl))
					<x-narsil::ui.dropdown-menu.dropdown-menu-separator />
				@endif
				@if (data_get($routes, 'destroy'))
					<x-narsil::ui.dropdown-menu.dropdown-menu-item
						class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
						x-on:click="$dispatch('dropdown-menu-close'); $dispatch('data-table-delete', { url: '{{ $destroyUrl }}' })"
					>
						<x-narsil::ui.icon.icon-root
							class="text-destructive"
							name="trash"
						/>
						{{ trans('narsil::ui.delete') }}
					</x-narsil::ui.dropdown-menu.dropdown-menu-item>
				@endif
			</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
		</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
	</x-narsil::ui.dropdown-menu.dropdown-menu-portal>
	</x-narsil::ui.dropdown-menu.dropdown-menu-root>
