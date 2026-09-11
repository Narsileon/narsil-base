<span
	{{ $attributes->twMerge("pointer-events-none absolute left-1.5 flex size-4 items-center justify-center [&_svg:not([class*='size-'])]:size-4")->merge([
	        'data-slot' => 'menubar-radio-item-indicator',
	    ]) }}
>
	@if ($slot->isNotEmpty())
		{{ $slot }}
	@else
		<x-narsil::ui.icon.icon-root
			name="fa-regular-check"
		/>
	@endif
</span>
