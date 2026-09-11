<div
	@class([
		'min-w-0',
		'overflow-hidden rounded-xl border bg-card text-card-foreground' =>
			!$list['grid'] && $list['path'] === '',
	])
	data-relation-path="{{ $list['path'] }}"
	wire:key="relations-list-{{ $inputId }}-{{ $list['path'] }}"
	x-data="narsilSortableRelations()"
	x-on:sortable-list-move.window="moveById($event.detail.id, $event.detail.direction)"
>
	<div
		@if (!$list['grid']) x-sort:group="relations-{{ $this->getId() }}" @endif
		@class([
			'relative isolate grid min-h-12 grid-cols-1 p-4',
			'gap-2' => !$list['grid'],
			'gap-4' => $list['grid'],
			'lg:grid-cols-2' => $list['grid'] && $list['columns'] === 2,
			'lg:grid-cols-3' => $list['grid'] && $list['columns'] === 3,
			'lg:grid-cols-4' => $list['grid'] && $list['columns'] === 4,
		])
		data-relation-path="{{ $list['path'] }}"
		x-ref="items"
		x-sort
		x-sort:config="sortOptions()"
	>
		@if ($list['path'] === '')
			<svg
				aria-hidden="true"
				class="bg-sidebar pointer-events-none absolute inset-0 -z-10 size-full"
			>
				<defs>
					<pattern
						height="16"
						id="relation-grid-{{ $this->getId() }}"
						patternUnits="userSpaceOnUse"
						width="16"
					>
						<path
							class="stroke-border"
							d="M 16 0 L 0 0 0 16"
							fill="none"
							stroke-width="0.5"
						/>
					</pattern>
				</defs>
				<rect
					fill="url(#relation-grid-{{ $this->getId() }})"
					height="100%"
					width="100%"
				/>
			</svg>
		@endif
		@foreach ($list['rows'] as $row)
			<x-narsil::ui.card.card-root
				class="min-w-0 self-start overflow-hidden"
				data-relation-item
				data-sortable-item="{{ $row['uuid'] }}"
				wire:key="relation-{{ $row['uuid'] }}"
				x-sort:item="'{{ $row['uuid'] }}'"
			>
				<x-narsil::ui.card.card-header
					class="flex min-h-9 flex-row items-center gap-2 py-0 pl-0 pr-1"
				>
					<x-narsil::ui.sortable.sortable-handle />
					@if ($row['icon'])
						<x-narsil::ui.icon.icon-root
							:name="$row['icon']"
						/>
					@endif
					<span
						class="min-w-0 grow truncate text-sm"
						title="{{ $row['label'] }} ({{ $row['value'] }})"
					>
						{{ $row['label'] }}
						@if ($list['showValue'])
							({{ $row['value'] }})
						@endif
					</span>
					@include('narsil::livewire.input-relations.width', ['width' => $row['width']])
					@if ($list['editable'])
						<x-narsil::blocks.tooltip.tooltip-root
							:tooltip="trans('narsil::ui.edit')"
						>
							<x-narsil::ui.button.button-root
								aria-label="{{ trans('narsil::ui.edit') }}"
								size="icon-sm"
								variant="ghost"
								wire:click="edit('{{ $list['path'] }}', '{{ $row['uuid'] }}')"
							>
								<x-narsil::ui.icon.icon-root
									name="fa-regular-edit"
								/>
							</x-narsil::ui.button.button-root>
						</x-narsil::blocks.tooltip.tooltip-root>
					@endif
					<x-narsil::blocks.sortable.sortable-item-menu
						:id="$row['uuid']"
					>
						<x-narsil::ui.dropdown-menu.dropdown-menu-item
							class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
							wire:click="remove('{{ $list['path'] }}', '{{ $row['uuid'] }}')"
							x-on:click="dropdownOpen = false"
						>
							<x-narsil::ui.icon.icon-root
								class="text-destructive"
								name="fa-regular-trash"
							/>
							{{ trans('narsil::ui.delete') }}
						</x-narsil::ui.dropdown-menu.dropdown-menu-item>
					</x-narsil::blocks.sortable.sortable-item-menu>
				</x-narsil::ui.card.card-header>
				@if ($row['children'])
					<div
						class="border-t"
					>
						@include('narsil::livewire.input-relations.list', ['list' => $row['children']])
					</div>
				@endif
			</x-narsil::ui.card.card-root>
		@endforeach
		@if ($list['grid'] && $list['editable'])
			<x-narsil::ui.button.button-root
				class="min-h-24 rounded-xl border-dashed"
				variant="outline"
				wire:click="edit('{{ $list['path'] }}')"
			>
				<x-narsil::ui.icon.icon-root
					name="fa-regular-plus"
				/>
				{{ trans('narsil::ui.add') }}
			</x-narsil::ui.button.button-root>
		@endif
	</div>
	@if ($list['groups'])
		<x-narsil::ui.card.card-footer
			class="flex-col gap-4 border-t"
		>
			@foreach ($list['groups'] as $groupIndex => $group)
				<div
					class="grid w-full grid-cols-1 items-center gap-4 sm:grid-cols-4"
				>
					<span
						class="text-sm"
					>{{ $group['label'] }}</span>
					<x-narsil::blocks.combobox.combobox-root
						:disabled="!$group['options']"
						:id="$this->getId() . '-' . $list['path'] . '-add-' . $groupIndex"
						:options="$group['options']"
						:value="''"
						class="{{ $group['createUrl'] ? 'sm:col-span-2' : 'sm:col-span-3' }}"
						wire:key="{{ $this->getId() }}-{{ $list['path'] }}-picker-{{ $groupIndex }}-{{ count($group['options']) }}"
						x-on:combobox-change.stop="$wire.addOption('{{ $list['path'] }}', {{ $groupIndex }}, $event.detail.value); value = ''"
					/>
					@if ($group['createUrl'])
						<x-narsil::blocks.resource-modal
							:title="$group['label']"
							:url="$group['createUrl']"
							class="justify-self-end"
							x-on:resource-created.stop="$wire.refreshOptions('{{ $list['path'] }}', {{ $groupIndex }}, $event.detail.id)"
						/>
					@endif
				</div>
			@endforeach
		</x-narsil::ui.card.card-footer>
	@endif
</div>
