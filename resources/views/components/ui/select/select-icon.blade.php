<span
	{{ $attributes->twMerge('pointer-events-none flex size-4 shrink-0')->merge([
	    'data-slot' => 'select-icon',
	]) }}
>
	<x-narsil::ui.icon.icon-root
		class="size-4"
		name="chevron-down"
	/>
</span>
