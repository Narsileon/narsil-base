<x-narsil::ui.popover.close
	{{ $attributes->twMerge(
	        'inline-flex size-9 cursor-pointer items-center justify-center rounded-md text-muted-foreground hover:bg-accent hover:text-accent-foreground',
	    )->merge([
	        'data-slot' => 'popover-close-button',
	    ]) }}
	aria-label="{{ trans('narsil::ui.close') }}"
>
	<x-narsil::ui.icon.root
		class="size-5"
		name="x"
	/>
</x-narsil::ui.popover.close>
