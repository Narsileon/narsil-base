<x-narsil::ui.separator.separator-root
	{{ $attributes->twMerge('-mx-1 my-1')->merge([
	    'data-slot' => 'menubar-separator',
	]) }}
	orientation="horizontal"
>
	{{ $slot }}
</x-narsil::ui.separator.separator-root>
