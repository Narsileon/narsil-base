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
				@if ($editUrl)
					<x-narsil::ui.dropdown-menu.dropdown-menu-item
						:href="$editUrl"
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
							<x-narsil::ui.icon.icon-root
								name="copy"
							/>
							{{ trans('narsil::ui.duplicate') }}
						</x-narsil::ui.button.button-root>
					</form>
				@endif
				@if ($destroyUrl && ($editUrl || $replicateUrl))
					<x-narsil::ui.dropdown-menu.dropdown-menu-separator />
				@endif
				@if ($destroyUrl)
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
