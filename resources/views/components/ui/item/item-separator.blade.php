<x-narsil::ui.separator.separator-root
	orientation="horizontal"
	{{ $attributes->twMerge('my-2')->merge([
	    'data-slot' => 'item-separator',
	]) }}
>
	{{ $slot }}
</x-narsil::ui.separator.separator-root>
