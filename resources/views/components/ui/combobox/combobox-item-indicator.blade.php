<span
	{{ $attributes->twMerge('pointer-events-none absolute right-2 flex size-4 items-center justify-center')->merge([
	    'data-slot' => 'combobox-item-indicator',
	]) }}
	x-show="selected(@js($value))"
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
