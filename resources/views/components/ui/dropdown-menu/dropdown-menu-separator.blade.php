<x-narsil::ui.separator.separator-root
	orientation="horizontal"
	{{ $attributes->twMerge('-mx-1.5 my-1')->merge([
	    'data-slot' => 'dropdown-menu-separator',
	]) }}
>
	{{ $slot }}
</x-narsil::ui.separator.separator-root>
