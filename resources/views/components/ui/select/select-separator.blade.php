<x-narsil::ui.separator.separator-root
	{{ $attributes->twMerge('pointer-events-none -mx-1.5 my-1')->merge([
	    'data-slot' => 'select-separator',
	]) }}
	orientation="horizontal"
>
	{{ $slot }}
</x-narsil::ui.separator.separator-root>
