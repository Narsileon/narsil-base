<div
	{{ $attributes->twMerge('isolate z-50 mt-1 outline-none')->merge([
	    'data-slot' => 'dropdown-menu-positioner',
	]) }}
	@if ($align === 'end') x-anchor.bottom-end="$root.querySelector('[data-slot=dropdown-menu-trigger]')" @else x-anchor.bottom-start="$root.querySelector('[data-slot=dropdown-menu-trigger]')" @endif
>
	{{ $slot }}
</div>
