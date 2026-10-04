<x-narsil::ui.separator.separator-root
	{{ $attributes->twMerge('-mx-1.5 my-1 data-[orientation=horizontal]:w-auto')->merge([
	    'data-slot' => 'dropdown-menu-separator',
	]) }}
	orientation="horizontal"
>
	{{ $slot }}
</x-narsil::ui.separator.separator-root>
