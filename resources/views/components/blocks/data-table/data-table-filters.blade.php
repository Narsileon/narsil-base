
<details
	class="relative w-fit"
>
	<summary
		class="cursor-pointer rounded-md border px-2 py-1 text-sm"
	>
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
