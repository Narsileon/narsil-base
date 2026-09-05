<button
	{{ $attributes->twMerge('inline-flex size-7 cursor-pointer items-center justify-center rounded-md hover:bg-accent')->merge([
	        'data-slot' => 'combobox-clear',
	        'type' => 'button',
	    ]) }}
	@disabled($disabled)
	x-on:click.stop="clear()"
>
	<x-narsil::ui.icon.icon-root
		class="size-4"
		name="xmark"
	/>
</button>
