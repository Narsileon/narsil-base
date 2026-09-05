<span
	{{ $attributes->twMerge('pointer-events-none absolute right-2 flex size-4 items-center justify-center')->merge([
	    'data-slot' => 'combobox-item-indicator',
	]) }}
	x-show="selected(@js($value))"
><x-narsil::ui.icon.icon-root
		class="size-4"
		name="check"
	/></span>
