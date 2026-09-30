<x-narsil::ui.separator.separator-root
	{{ $attributes->twMerge('my-2')->merge([
	    'data-slot' => 'item-separator',
	]) }}
	orientation="horizontal"
>
	{{ $slot }}
</x-narsil::ui.separator.separator-root>
