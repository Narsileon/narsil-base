<button
	class="flex items-center gap-2 font-medium"
	type="button"
	x-on:click="sort('{{ $column['id'] }}')"
>
	{{ ucfirst($column['header'] ?? $column['id']) }}
	@if ($current)
		<x-narsil::ui.icon.icon-root
			:class="$current['desc'] ? 'mt-1 size-2.5' : 'mb-1 size-2.5'"
			:name="$current['desc'] ? 'chevron-down' : 'chevron-up'"
		/>
	@else
		<span
			aria-hidden="true"
			class="inline-flex flex-col items-center justify-center"
		>
			<x-narsil::ui.icon.icon-root
				class="-mb-0.5 size-2.5"
				name="chevron-up"
			/>
			<x-narsil::ui.icon.icon-root
				class="-mt-0.5 size-2.5"
				name="chevron-down"
			/>
		</span>
	@endif
</button>
