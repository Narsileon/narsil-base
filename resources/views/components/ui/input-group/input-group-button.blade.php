<x-narsil::ui.button.button-root
	:size="$size"
	:variant="$variant"
	{{ $attributes->twMerge('rounded-none')->merge([
	    'data-slot' => 'input-group-button',
	]) }}
>
	{{ $slot }}
</x-narsil::ui.button.button-root>
