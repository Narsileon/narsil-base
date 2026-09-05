<div
	class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center"
>
	<x-narsil::blocks.data-table.data-table-selection
		:payload="$payload"
	/>
	<div
		class="flex w-full items-center justify-between gap-4 sm:w-fit sm:justify-end"
	>
		<x-narsil::blocks.data-table.data-table-page-size
			:payload="$payload"
		/>
		<div
			class="flex flex-col items-end gap-x-4 gap-y-2 sm:flex-row sm:items-center"
		>
			<x-narsil::blocks.data-table.data-table-results
				:payload="$payload"
			/>
			<x-narsil::blocks.pagination.pagination-root
				:links="data_get($payload, 'links', []) ?? []"
				:meta-links="data_get($payload, 'meta.links', []) ?? []"
			/>
		</div>
	</div>
</div>
