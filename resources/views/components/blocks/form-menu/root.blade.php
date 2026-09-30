@if ($hasActions && !$actionsOnly)
	<div
		{{ $attributes->twMerge() }}
		data-slot="form-menu"
	>
		<x-narsil::ui.dropdown-menu.dropdown-menu-root>
			<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
				aria-label="{{ trans('narsil::ui.menu') }}"
				size="icon"
				variant="outline"
			>
				<x-narsil::ui.icon.icon-root
					name="fa-regular-ellipsis"
				/>
			</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
			<x-narsil::ui.dropdown-menu.dropdown-menu-portal>
				<x-narsil::ui.dropdown-menu.dropdown-menu-positioner
					align="end"
				>
					<x-narsil::ui.dropdown-menu.dropdown-menu-popup>
						@if ($unpublishUrl)
							<x-narsil::ui.dropdown-menu.dropdown-menu-item
								:form="$unpublishFormId"
								type="submit"
								x-on:click="$dispatch('dropdown-menu-close')"
							>
								<x-narsil::ui.icon.icon-root
									name="fa-regular-eye-slash"
								/>
								{{ trans('narsil::ui.unpublish') }}
							</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						@endif
						@if ($deleteUrl && $unpublishUrl)
							<x-narsil::ui.dropdown-menu.dropdown-menu-separator />
						@endif
						@if ($deleteUrl)
							<x-narsil::ui.dropdown-menu.dropdown-menu-item
								class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
								x-on:click="$dispatch('dropdown-menu-close'); $dispatch('alert-dialog-open')"
							>
								<x-narsil::ui.icon.icon-root
									class="text-destructive"
									name="fa-regular-trash"
								/>
								{{ trans('narsil::ui.delete') }}
							</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						@endif
					</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
				</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
			</x-narsil::ui.dropdown-menu.dropdown-menu-portal>
		</x-narsil::ui.dropdown-menu.dropdown-menu-root>
	</div>
@elseif ($hasActions && $actionsOnly)
	<div
		{{ $attributes->twMerge() }}
		data-slot="form-menu-actions"
	>
		@if ($unpublishUrl)
			<form
				action="{{ $unpublishUrl }}"
				id="{{ $unpublishFormId }}"
				method="POST"
			>
				@csrf
			</form>
		@endif
		@if ($deleteUrl)
			<x-narsil::blocks.alert-dialog.alert-dialog-root
				:actions="[['href' => $deleteUrl, 'method' => 'DELETE']]"
				:description="trans('narsil::dialogs.descriptions.delete')"
				:title="trans('narsil::dialogs.titles.delete')"
			/>
		@endif
	</div>
@endif
