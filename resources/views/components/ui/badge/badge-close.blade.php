<button
	{{ $attributes->twMerge('cursor-pointer')->merge([
	    'data-slot' => 'badge-close',
	    'type' => 'button',
	]) }}
>
	@if ($slot->isNotEmpty())
		{{ $slot }}
	@else
		<x-narsil::ui.icon.icon-root
			:name="$icon"
			class="hover:text-destructive size-3.5 text-current"
		/>
	@endif
</button>
