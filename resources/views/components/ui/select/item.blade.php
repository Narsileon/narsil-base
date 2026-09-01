@props(['label', 'value'])

<button
	{{ $attributes->twMerge('relative flex min-h-9 w-full cursor-pointer items-center gap-1.5 rounded-md py-1 pr-8 pl-1.5 text-left text-sm outline-hidden select-none hover:bg-accent hover:text-accent-foreground')->merge(['data-slot' => 'select-item', 'role' => 'option', 'type' => 'button']) }}
	x-bind:aria-selected="String(value) === @js((string) $value)"
	x-on:click="select(@js($value))"
>
	<x-narsil::ui.select.item-text>{!! $label !!}</x-narsil::ui.select.item-text>
	<x-narsil::ui.select.item-indicator
		:value="$value"
	/>
</button>
