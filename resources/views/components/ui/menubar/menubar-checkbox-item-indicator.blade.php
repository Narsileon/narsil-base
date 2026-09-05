<span
	{{ $attributes->twMerge('pointer-events-none absolute left-1.5 flex size-4 items-center justify-center')->merge([
	        'data-slot' => 'menubar-checkbox-item-indicator',
	    ]) }}
>
	{{ $slot }}@if ($slot->isEmpty())
		<x-narsil::ui.icon.icon-root
			name="check"
		/>
	@endif
</span>
