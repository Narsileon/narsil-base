<x-narsil::ui.table.table-wrapper
	class="min-h-0 grow"
>
	<x-narsil::ui.table.table-root
		class="min-w-max"
	>
		<x-narsil::ui.table.table-header>
			<x-narsil::ui.table.table-row
				class="bg-accent sticky top-0 z-10"
			>
				@if (($meta['selectable'] ?? true) !== false)
					<x-narsil::ui.table.table-head
						class="w-9"
					>
						<x-narsil::blocks.checkbox.checkbox-root
							aria-label="{{ trans('narsil::data-table.select_all') }}"
							x-effect="checked = ids.length > 0 && ids.every((id) => selected[id])"
							x-on:click="checked = !checked; selected = checked ? Object.fromEntries(ids.map((id) => [id, true])) : {}"
						/>
					</x-narsil::ui.table.table-head>
				@endif
				@foreach ($columns as $column)
					@if ($visible[$column['id']] ?? ($column['visibility'] ?? true))
						<x-narsil::ui.table.table-head>
							<div
								class="flex items-center justify-start gap-1"
							>
								{{ ucfirst($column['header'] ?? $column['id']) }}
								<x-narsil::blocks.data-table.data-table-head-sort
									:column="$column"
									:payload="$payload"
								/>
							</div>
						</x-narsil::ui.table.table-head>
					@endif
				@endforeach
				@if (
					($routes['edit'] ?? null) ||
						($routes['destroy'] ?? null) ||
						($routes['replicate'] ?? null) ||
						($routes['destroyMany'] ?? null) ||
						($routes['replicateMany'] ?? null))
					<x-narsil::ui.table.table-head
						class="min-w-13 w-13 max-w-13 mask-l-from-85% mask-no-repeat sticky right-0 z-20"
					>
						@if (($meta['selectable'] ?? true) !== false)
							<span
								class="sr-only"
								x-show="Object.values(selected).filter(Boolean).length === 0"
							>
								{{ trans('narsil::ui.menu') }}
							</span>
							<span
								x-cloak
								x-show="Object.values(selected).filter(Boolean).length > 0"
							>
								<x-narsil::blocks.data-table.data-table-bulk-menu
									:parameters="$parameters"
									:routes="$routes"
								/>
							</span>
						@endif
					</x-narsil::ui.table.table-head>
				@endif
			</x-narsil::ui.table.table-row>
		</x-narsil::ui.table.table-header>
		<x-narsil::ui.table.table-body>
			@forelse ($rows as $index => $row)
				<x-narsil::ui.table.table-row
					class="cursor-pointer"
					x-bind:role="editUrl ? 'link' : null"
					x-bind:tabindex="editUrl ? 0 : -1"
					x-data="{ editUrl: {{ Illuminate\Support\Js::from($editUrls[$index] ?? null) }} }"
					x-on:click="if (!editUrl || $event.target.closest('button, a, input, select, textarea')) return; Livewire.navigate(editUrl)"
					x-on:keydown.enter="if (!editUrl || $event.target.closest('button, a, input, select, textarea')) return; Livewire.navigate(editUrl)"
				>
					@if (($meta['selectable'] ?? true) !== false)
						<x-narsil::ui.table.table-cell>
							<x-narsil::blocks.checkbox.checkbox-root
								aria-label="{{ trans('narsil::data-table.row') }}"
								x-effect="checked = !!selected['{{ $rowIds[$index] }}']"
								x-on:click="checked = !checked; selected['{{ $rowIds[$index] }}'] = checked; $event.stopPropagation()"
							/>
						</x-narsil::ui.table.table-cell>
					@endif
					@foreach ($columns as $column)
						@if ($visible[$column['id']] ?? ($column['visibility'] ?? true))
							<x-narsil::ui.table.table-cell>
								{{ $values[$index][$column['id']] ?? null }}
							</x-narsil::ui.table.table-cell>
						@endif
					@endforeach
					@if (($routes['edit'] ?? null) || ($routes['destroy'] ?? null) || ($routes['replicate'] ?? null))
						<x-narsil::ui.table.table-cell
							class="min-w-13 w-13 max-w-13 mask-l-from-85% mask-no-repeat sticky right-0 z-10"
						>
							<x-narsil::blocks.data-table.data-table-row-menu
								:id="$rowIds[$index]"
								:parameters="$parameters"
								:routes="$routes"
							/>
						</x-narsil::ui.table.table-cell>
					@endif
				</x-narsil::ui.table.table-row>
			@empty
				<x-narsil::ui.table.table-row
					class="cursor-pointer"
					x-bind:role="createUrl ? 'link' : null"
					x-bind:tabindex="createUrl ? 0 : -1"
					x-data="{ createUrl: {{ Illuminate\Support\Js::from($createUrl) }} }"
					x-on:click="if (createUrl) Livewire.navigate(createUrl)"
					x-on:keydown.enter="if (createUrl) Livewire.navigate(createUrl)"
				>
					<x-narsil::ui.table.table-cell
						class="text-center"
						colspan="{{ $columns->count() + 2 }}"
					>
						{{ trans('narsil::data-table.empty') }}
					</x-narsil::ui.table.table-cell>
				</x-narsil::ui.table.table-row>
			@endforelse
		</x-narsil::ui.table.table-body>
	</x-narsil::ui.table.table-root>
</x-narsil::ui.table.table-wrapper>
