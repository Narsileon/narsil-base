<span
	{{ $attributes->twMerge('flex size-4 items-center justify-center text-primary')->merge([
	    'data-slot' => 'radio-group-indicator',
	]) }}
>
	@if ($slot->isNotEmpty())
		{{ $slot }}
	@else
		<x-narsil::ui.icon.icon-root
			class="absolute size-2 fill-current"
			name="circle"
		/>
	@endif
</span>
