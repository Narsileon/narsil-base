<div
	:style="`left: ${x}px; top: ${y}px`"
	{{ $attributes->twMerge('fixed isolate z-50 outline-none')->merge([
	    'data-slot' => 'context-menu-positioner',
	]) }}
>
	{{ $slot }}
</div>
