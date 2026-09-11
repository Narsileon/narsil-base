<button
	{{ $attributes->twMerge('flex w-full cursor-pointer items-center justify-center bg-popover py-1')->merge([
	    'data-slot' => 'select-scroll-up-arrow',
	    'type' => 'button',
	]) }}
	x-on:click="$refs['select-list']?.scrollBy({ top: -120, behavior: 'smooth' })"
	x-show="canScrollUp"
>
	@if ($slot->isNotEmpty())
		{{ $slot }}
	@else
		<x-narsil::ui.icon.icon-root
			class="size-4"
			name="fa-regular-chevron-up"
		/>
	@endif
</button>
