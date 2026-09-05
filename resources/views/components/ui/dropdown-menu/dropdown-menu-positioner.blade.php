<div
	{{ $attributes->twMerge('isolate z-50 mt-1 outline-none')->merge([
	    'data-slot' => 'dropdown-menu-positioner',
	]) }}
	@if ($align === 'end') x-anchor.bottom-end="$refs.trigger" @else x-anchor.bottom-start="$refs.trigger" @endif
>
	{{ $slot }}
</div>
