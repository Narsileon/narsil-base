<div
	x-data="{
    search: @js($state['global_filter'] ?? ''),
    visible: Object.assign({}, @js($state['column_visibility'] ?? [])),
    order: @js($order),
    filters: @js($state['column_filters'] ?? []),
    sorting: @js($state['sorting'] ?? []),
    pageSize: @js($state['page_size'] ?? 10),
    editingFilterIndex: null,
    ids: {!! e($idsJson) !!},
    selected: {},
    rememberFocus() {
        const element = document.activeElement;

        if (element?.matches('[name=global_filter]')) {
            sessionStorage.setItem('narsil-data-table-focus', JSON.stringify({
                end: element.selectionEnd,
                path: window.location.pathname,
                start: element.selectionStart,
            }));
        }
    },
    persist() {
        this.rememberFocus();
        const form = this.$refs.state;
        form.querySelector('[name=global_filter]').value = this.search;
        form.querySelector('[name=column_filters]').value = JSON.stringify(this.filters);
        form.querySelector('[name=column_order]').value = JSON.stringify(this.order);
        form.querySelector('[name=column_visibility]').value = JSON.stringify(this.visible);
        form.querySelector('[name=page_size]').value = this.pageSize;
        form.querySelector('[name=sorting]').value = JSON.stringify(this.sorting);
        form.querySelector('[name=row_selection]').value = JSON.stringify(this.selected);
        form.requestSubmit();
    },
    applyFilter(form) {
        const data = new FormData(form);
        const filter = {
            id: data.get('column_filters[0][id]'),
            value: {
                operator: data.get('column_filters[0][value][operator]'),
                value: data.get('column_filters[0][value][value]'),
            },
        };
        const nextFilters = [...this.filters];

        if (this.editingFilterIndex === null) {
            nextFilters.push(filter);
        } else {
            nextFilters[this.editingFilterIndex] = filter;
        }

        this.filters = nextFilters;
        this.persist();
    },
    removeFilter() {
        this.filters = this.editingFilterIndex === null ? [] :
            this.filters.filter((_, index) => index !== this.editingFilterIndex);
        this.persist();
    },
    sort(id) {
        const current = this.sorting[0];
        this.sorting = !current || current.id !== id ? [{ id, desc: false }] : current.desc ? [] : [{ id, desc: true }];
        this.persist();
    },
    toggleColumn(id, checked) {
        this.visible[id] = checked;
    },
    selectAll(checked, ids) { this.selected = checked ? Object.fromEntries(ids.map((id) => [id, true])) : {}; },
    select(id, checked) { checked ? this.selected[id] = true : delete this.selected[id]; }
}"
	x-on:sortable-list-change.window="order = $event.detail.order"
>
	<form
		action="{{ $uuid ? route('narsil.tables.update', $uuid) : '' }}"
		class="hidden"
		method="POST"
		x-ref="state"
	>
		@csrf @method('PATCH')
		@foreach (['global_filter', 'column_filters', 'column_order', 'column_visibility', 'page_size', 'sorting', 'row_selection'] as $field)
			<input
				name="{{ $field }}"
				type="hidden"
			>
		@endforeach
	</form>
	{{ $slot }}
	<div
		x-data="{ alertDialogOpen: false, deleteDialogUrl: '' }"
		x-on:alert-dialog-close="alertDialogOpen = false"
		x-on:data-table-delete.window="deleteDialogUrl = $event.detail.url; alertDialogOpen = true"
	>
		<x-narsil::ui.alert-dialog.alert-dialog-backdrop
			x-on:click.self="alertDialogOpen = false"
		/>
		<x-narsil::ui.alert-dialog.alert-dialog-popup>
			<x-narsil::ui.alert-dialog.alert-dialog-header>
				<x-narsil::ui.alert-dialog.alert-dialog-title>
					{{ trans('narsil::dialogs.titles.delete') }}
				</x-narsil::ui.alert-dialog.alert-dialog-title>
				<x-narsil::ui.alert-dialog.alert-dialog-description>
					{{ trans('narsil::dialogs.descriptions.delete') }}
				</x-narsil::ui.alert-dialog.alert-dialog-description>
			</x-narsil::ui.alert-dialog.alert-dialog-header>
			<x-narsil::ui.alert-dialog.alert-dialog-footer>
				<div
					class="flex items-center gap-2"
				>
					<form
						method="POST"
						x-bind:action="deleteDialogUrl"
					>
						@csrf @method('DELETE')
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
						<x-narsil::ui.alert-dialog.alert-dialog-action
							type="submit"
						>
							{{ trans('narsil::ui.confirm') }}
						</x-narsil::ui.alert-dialog.alert-dialog-action>
					</form>
				</div>
				<x-narsil::ui.alert-dialog.alert-dialog-cancel>
					{{ trans('narsil::ui.cancel') }}
				</x-narsil::ui.alert-dialog.alert-dialog-cancel>
			</x-narsil::ui.alert-dialog.alert-dialog-footer>
		</x-narsil::ui.alert-dialog.alert-dialog-popup>
	</div>
</div>
