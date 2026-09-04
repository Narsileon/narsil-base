<span
	{{ $attributes->twMerge('grid place-content-center text-current transition-none')->merge(['data-slot' => 'checkbox-indicator']) }}
	x-cloak
	x-show="checked"
>
	<x-narsil::ui.icon.icon-root
		class="size-3.5 text-current"
		name="check"
	/>
</span>
