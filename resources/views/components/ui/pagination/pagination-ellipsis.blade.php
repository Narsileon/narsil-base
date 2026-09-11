<span
	{{ $attributes->twMerge('flex size-9 items-center justify-center')->merge([
	    'data-slot' => 'pagination-ellipsis',
	]) }}
	aria-hidden="true"
>
	@if ($slot->isNotEmpty())
		{{ $slot }}
	@else
		<x-narsil::ui.icon.icon-root
			class="size-4"
			name="fa-solid-ellipsis"
		/>
	@endif
	<span
		class="sr-only"
	>
		{{ trans('narsil::pagination.more') }}
	</span>
</span>
