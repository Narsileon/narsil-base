@props(['value'])
<span
	{{ $attributes->twMerge('pointer-events-none absolute right-2 flex size-4 items-center justify-center')->merge(['data-slot' => 'select-item-indicator']) }}
	x-show="String(value) === @js((string) $value)"
>
	<x-narsil::ui.icon.root
		class="size-4"
		name="check"
	/>
</span>
