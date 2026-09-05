<button
	{{ $attributes->twMerge('ml-0.5 inline-flex size-5 cursor-pointer items-center justify-center rounded-sm hover:bg-accent')->merge(['data-slot' => 'combobox-chip-remove', 'type' => 'button']) }}
	x-on:click.stop="select($el.closest('[data-slot=combobox-chip]').dataset.value)"
>
	<x-narsil::ui.icon.icon-root
		class="size-3"
		name="xmark"
	/>
</button>
