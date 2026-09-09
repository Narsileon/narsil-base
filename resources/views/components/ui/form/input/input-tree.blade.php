<div
	class="grid gap-4"
	x-data="narsilTreeInput({
    formLanguage: @js(app()->getLocale()),
    items: @js($items),
    name: @js($name),
    rootExclusive: @js($rootExclusive),
})"
	x-on:alert-dialog-close="deleteDialogOpen = false"
	x-on:form-language-change.window="formLanguage = $event.detail.value"
	x-on:sortable-list-move.window="moveById($event.detail.id, $event.detail.direction)"
	x-on:tree-delete.window="deleteDialogUrl = $event.detail.url; deleteDialogOpen = true"
>
	<div
		class="hidden"
		x-ref="input"
	></div>
	@if (count($items) > 0)
		<div
			class="grid"
			x-init="syncInputs()"
			x-ref="items"
			x-sort:config="treeSortConfig()"
			x-sort="syncOrder()"
		>
			@foreach ($items as $item)
				<div
					class="bg-card text-card-foreground relative overflow-hidden rounded-xl border shadow-sm"
					data-tree-item="{{ $item['id'] }}"
					x-bind:style="'margin-left: ' + getItemDepth({{ Illuminate\Support\Js::from($item['id']) }}, {{ $item['depth'] }}) * 16 + 'px'"
					x-data="{ order: [] }"
					x-effect="order = getSiblingIds({{ Illuminate\Support\Js::from($item['id']) }})"
					x-show="activeId === null || !isDescendant({{ Illuminate\Support\Js::from($item['id']) }}, activeId)"
					x-sort:item="{{ $item['id'] }}"
				>
					<div
						class="bg-card flex min-h-9 items-center justify-between gap-2 py-0 pr-1"
					>
						<x-narsil::ui.sortable.sortable-handle
							:disabled="$rootExclusive && $item['depth'] === 0"
							aria-label="{{ trans('narsil::ui.move') }}"
						/>
						<div
							class="flex min-w-0 grow items-center justify-start gap-2 px-2"
						>
							@if ($item['edit_url'] ?? null)
								<a
									class="min-w-0 grow cursor-pointer"
									href="{{ $item['edit_url'] }}"
								>
									<span
										class="block truncate font-normal"
										x-text="getLabel({{ Illuminate\Support\Js::from($item['label'] ?? '') }}) + ' (id: {{ $item['id'] }})'"
									>
										{{ is_array($item['label'] ?? null) ? $item['label'][app()->getLocale()] ?? (array_values($item['label'])[0] ?? '') : $item['label'] ?? '' }}
										(id: {{ $item['id'] }})
									</span>
								</a>
							@else
								<span
									class="min-w-0 grow truncate font-normal"
									x-text="getLabel({{ Illuminate\Support\Js::from($item['label'] ?? '') }}) + ' (id: {{ $item['id'] }})'"
								>
									{{ is_array($item['label'] ?? null) ? $item['label'][app()->getLocale()] ?? (array_values($item['label'])[0] ?? '') : $item['label'] ?? '' }}
									(id: {{ $item['id'] }})
								</span>
							@endif
							@if ($item['badge'] ?? null)
								<x-narsil::ui.badge.badge-root
									variant="secondary"
								>
									{{ $item['badge'] }}
								</x-narsil::ui.badge.badge-root>
							@endif
						</div>
						<x-narsil::ui.sortable-item-menu.root
							:id="$item['id']"
						>
							@if ($item['create_url'] ?? null)
								<x-narsil::ui.dropdown-menu.dropdown-menu-item
									:href="$item['create_url']"
								>
									<x-narsil::ui.icon.icon-root
										name="fa-regular-plus"
									/>
									{{ trans('narsil::ui.add_child') }}
								</x-narsil::ui.dropdown-menu.dropdown-menu-item>
							@endif
							@if ($item['edit_url'] ?? null)
								<x-narsil::ui.dropdown-menu.dropdown-menu-item
									:href="$item['edit_url']"
								>
									<x-narsil::ui.icon.icon-root
										name="fa-regular-edit"
									/>
									{{ trans('narsil::ui.edit') }}
								</x-narsil::ui.dropdown-menu.dropdown-menu-item>
							@endif
							@if ($item['destroy_url'] ?? null)
								<x-narsil::ui.dropdown-menu.dropdown-menu-separator />
								<x-narsil::ui.dropdown-menu.dropdown-menu-item
									class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
									data-tree-delete-url="{{ $item['destroy_url'] }}"
									x-on:click="$dispatch('tree-delete', { url: $el.dataset.treeDeleteUrl }); dropdownOpen = false"
								>
									<x-narsil::ui.icon.icon-root
										class="text-destructive"
										name="fa-regular-trash"
									/>
									{{ trans('narsil::ui.delete') }}
								</x-narsil::ui.dropdown-menu.dropdown-menu-item>
							@endif
						</x-narsil::ui.sortable-item-menu.root>
					</div>
				</div>
			@endforeach
		</div>
	@endif
	<div
		class="fixed inset-0 z-50 bg-black/50"
		x-cloak
		x-on:click.self="deleteDialogOpen = false"
		x-show="deleteDialogOpen"
	></div>
	<section
		aria-modal="true"
		class="bg-background text-foreground ring-foreground/10 fixed left-1/2 top-1/2 z-50 grid w-full max-w-xs -translate-x-1/2 -translate-y-1/2 gap-4 rounded-xl p-4 shadow-lg outline-none ring-1 sm:max-w-sm"
		role="alertdialog"
		x-cloak
		x-show="deleteDialogOpen"
	>
		<x-narsil::ui.alert-dialog.alert-dialog-header>
			<x-narsil::ui.alert-dialog.alert-dialog-title>
				{{ trans('narsil::dialogs.titles.delete') }}
			</x-narsil::ui.alert-dialog.alert-dialog-title>
			<x-narsil::ui.alert-dialog.alert-dialog-description>
				{{ trans('narsil::dialogs.descriptions.delete') }}
			</x-narsil::ui.alert-dialog.alert-dialog-description>
		</x-narsil::ui.alert-dialog.alert-dialog-header>
		<x-narsil::ui.alert-dialog.alert-dialog-footer>
			<x-narsil::ui.alert-dialog.alert-dialog-action
				type="button"
				x-on:click="submitDelete()"
			>
				{{ trans('narsil::ui.confirm') }}
			</x-narsil::ui.alert-dialog.alert-dialog-action>
			<x-narsil::ui.alert-dialog.alert-dialog-cancel>
				{{ trans('narsil::ui.cancel') }}
			</x-narsil::ui.alert-dialog.alert-dialog-cancel>
		</x-narsil::ui.alert-dialog.alert-dialog-footer>
	</section>
</div>
