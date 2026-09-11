<span
	{{ $attributes->twMerge('pointer-events-none absolute right-2 flex size-4 items-center justify-center')->merge([
	    'data-slot' => 'select-item-indicator',
	]) }}
	x-show="String(value) === @js((string) $value)"
>
	@if ($slot->isNotEmpty())
		{{ $slot }}
	@else
		<x-narsil::ui.icon.icon-root
			class="size-4"
			name="fa-regular-check"
		/>
	@endif
</span>
