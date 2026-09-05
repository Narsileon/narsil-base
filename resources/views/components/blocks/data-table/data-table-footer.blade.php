<div
	class="grid w-full grid-cols-2 items-center gap-x-4 gap-y-2 sm:flex sm:justify-between"
>
	<x-narsil::blocks.data-table.data-table-selection
		:payload="$payload"
	/>
	<div
		class="order-3 justify-self-start sm:order-2 sm:ml-auto"
	>
		<x-narsil::blocks.data-table.data-table-page-size
			:payload="$payload"
		/>
	</div>
	<div
		class="order-2 justify-self-end sm:order-3"
	>
		<x-narsil::blocks.data-table.data-table-results
			:payload="$payload"
		/>
	</div>
	<div
		class="order-4 justify-self-end sm:order-4"
	>
		<x-narsil::blocks.pagination.pagination-root
			:links="$links"
			:meta-links="$metaLinks"
		/>
	</div>
</div>
