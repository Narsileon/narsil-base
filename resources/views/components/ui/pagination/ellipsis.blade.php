<span
	{{ $attributes->twMerge('flex size-9 items-center justify-center')->merge(['data-slot' => 'pagination-ellipsis']) }}
	aria-hidden="true"
>
	<x-narsil::ui.icon.root
		class="size-4"
		name="fa-solid-ellipsis"
	/>
	<span
		class="sr-only"
	>
		{{ trans('narsil::pagination.more') }}
	</span>
</span>
