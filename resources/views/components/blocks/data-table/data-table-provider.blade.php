@php
	$state = data_get($payload, 'meta.state', []);
	$state = is_object($state) && method_exists($state, 'toArray') ? $state->toArray() : (array) $state;
	$uuid = data_get($state, 'uuid');
@endphp

<div
	x-data="{
    search: @js(data_get($state, 'global_filter', '')),
    visible: @js(data_get($state, 'column_visibility', [])),
    order: @js(data_get($state, 'column_order', [])),
    filters: @js(data_get($state, 'column_filters', [])),
    sorting: @js(data_get($state, 'sorting', [])),
    pageSize: @js(data_get($state, 'page_size', 10)),
    ids: {!! e($idsJson) !!},
    selected: {},
    persist() {
        const form = this.$refs.state;
        form.querySelector('[name=global_filter]').value = this.search;
        form.querySelector('[name=column_filters]').value = JSON.stringify(this.filters);
        form.querySelector('[name=column_order]').value = JSON.stringify(this.order);
        form.querySelector('[name=column_visibility]').value = JSON.stringify(this.visible);
        form.querySelector('[name=page_size]').value = this.pageSize;
        form.querySelector('[name=sorting]').value = JSON.stringify(this.sorting);
        form.querySelector('[name=row_selection]').value = JSON.stringify(this.selected);
        form.submit();
    },
    sort(id) {
        const current = this.sorting[0];
        this.sorting = !current || current.id !== id ? [{ id, desc: false }] : current.desc ? [] : [{ id, desc: true }];
        this.persist();
    },
    toggleColumn(id) {
        this.visible[id] = this.visible[id] === false;
        this.persist();
    },
    move(id, direction) {
        const index = this.order.indexOf(id),
            next = index + direction;
        if (index < 0 || next < 0 || next >= this.order.length) return;
        [this.order[index], this.order[next]] = [this.order[next], this.order[index]];
        this.persist();
    },
    selectAll(checked, ids) { this.selected = checked ? Object.fromEntries(ids.map((id) => [id, true])) : {}; },
    select(id, checked) { checked ? this.selected[id] = true : delete this.selected[id]; }
}"
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
		x-data="{ open: false, url: '' }"
		x-on:alert-dialog-close="open = false"
		x-on:data-table-delete.window="url = $event.detail.url; open = true"
	>
		<x-narsil::ui.alert-dialog.alert-dialog-backdrop
			x-on:click.self="open = false"
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
						x-bind:action="url"
					>
						@csrf @method('DELETE')
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
