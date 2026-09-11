<x-narsil::ui.separator.separator-root
	:orientation="$orientation"
	{{ $attributes->merge([
	    'data-slot' => 'tabs-separator',
	]) }}
>
	{{ $slot }}
</x-narsil::ui.separator.separator-root>
