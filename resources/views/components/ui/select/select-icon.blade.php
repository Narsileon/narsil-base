<span
	{{ $attributes->twMerge('pointer-events-none flex size-4 shrink-0')->merge([
	    'data-slot' => 'select-icon',
	]) }}
>
	@if ($slot->isNotEmpty())
		{{ $slot }}
	@else
		<x-narsil::ui.icon.icon-root
			class="text-primary size-4"
			name="fa-regular-chevron-down"
		/>
	@endif
</span>
