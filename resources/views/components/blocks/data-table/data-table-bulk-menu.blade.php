<x-narsil::ui.dropdown-menu.dropdown-menu-root>
	<x-narsil::blocks.tooltip.tooltip-root
		:tooltip="trans('narsil::ui.menu')"
	>
		<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
			aria-label="{{ trans('narsil::ui.menu') }}"
			size="icon-sm"
			variant="ghost-secondary"
		>
			<x-narsil::ui.icon.icon-root
				name="more-horizontal"
			/>
		</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
	</x-narsil::blocks.tooltip.tooltip-root>
	<x-narsil::ui.dropdown-menu.dropdown-menu-portal>
		<x-narsil::ui.dropdown-menu.dropdown-menu-positioner
			align="end"
		>
			<x-narsil::ui.dropdown-menu.dropdown-menu-popup>
				<x-narsil::ui.dropdown-menu.dropdown-menu-item
					x-on:click="selected = {}; $dispatch('dropdown-menu-close')"
				>
					<x-narsil::ui.icon.icon-root
						name="xmark"
					/>
					{{ trans('narsil::data-table.deselect_all') }}
				</x-narsil::ui.dropdown-menu.dropdown-menu-item>
				@if ($replicateUrl)
					<form
						action="{{ $replicateUrl }}"
						method="POST"
						x-on:submit="$dispatch('dropdown-menu-close')"
					>
						@csrf
						<input
							name="_back"
							type="hidden"
							value="1"
						>
						<template
							x-bind:key="id"
							x-for="id in Object.keys(selected).filter((id) => selected[id])"
						>
							<input
								name="ids[]"
								type="hidden"
								x-bind:value="id"
							>
						</template>
						<x-narsil::ui.dropdown-menu.dropdown-menu-item
							x-on:click="$event.preventDefault(); $el.closest('form').requestSubmit()"
						>
							<x-narsil::ui.icon.icon-root
								name="copy"
							/>
							{{ trans('narsil::data-table.duplicate_selected') }}
						</x-narsil::ui.dropdown-menu.dropdown-menu-item>
					</form>
				@endif
				@if ($destroyUrl)
					<x-narsil::ui.dropdown-menu.dropdown-menu-separator />
					<x-narsil::ui.dropdown-menu.dropdown-menu-item
						class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
						x-on:click="$dispatch('dropdown-menu-close'); $dispatch('data-table-delete', { url: '{{ $destroyUrl }}' })"
					>
						<x-narsil::ui.icon.icon-root
							class="text-destructive"
							name="trash"
						/>
						{{ trans('narsil::data-table.delete_selected') }}
					</x-narsil::ui.dropdown-menu.dropdown-menu-item>
				@endif
			</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
		</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
	</x-narsil::ui.dropdown-menu.dropdown-menu-portal>
</x-narsil::ui.dropdown-menu.dropdown-menu-root>
