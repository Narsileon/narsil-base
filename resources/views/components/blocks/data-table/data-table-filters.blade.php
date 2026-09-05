<div
	class="flex flex-wrap items-center gap-2"
>
	<details
		class="relative w-fit"
	>
		<summary
			aria-label="{{ trans('narsil::data-table.filters') }}"
			class="border-secondary bg-secondary/80 text-secondary-foreground hover:bg-secondary inline-flex h-9 cursor-pointer list-none items-center justify-center gap-2 rounded-md border px-3 text-sm font-medium transition-all [&::-webkit-details-marker]:hidden"
		>
			<x-narsil::ui.icon.icon-root
				name="filter"
			/>
			{{ trans('narsil::data-table.filters') }}
		</summary>
		<div
			class="bg-background absolute z-20 mt-2 w-80 rounded-md border p-4 shadow-lg"
		>
			<x-narsil::blocks.data-table.data-table-filter-form
				:payload="$payload"
			/>
		</div>
	</details>
	@if ($activeFilters !== [])
		<ul
			class="flex flex-wrap items-center gap-2"
		>
			@foreach ($activeFilters as $filter)
				<li>
					<x-narsil::ui.badge.badge-root
						class="pr-0"
					>
						<span>{{ $filter['column'] }}</span>
						<span>{{ $filter['operator'] }}</span>
						<span>{{ $filter['value'] }}</span>
						<x-narsil::ui.badge.badge-close
							aria-label="{{ trans('narsil::ui.remove') }}"
							x-on:click="window.location.href = '{{ $filter['remove_url'] }}'"
						/>
					</x-narsil::ui.badge.badge-root>
				</li>
			@endforeach
		</ul>
	@endif
</div>
