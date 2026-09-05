<div
	{{ $attributes->merge([
	    'data-slot' => 'popover-root',
	]) }}
	x-data="{ popoverOpen: @js((bool) $open) }"
	x-on:popover-close="popoverOpen = false"
	x-on:popover-open.window="popoverOpen = true"
>
	{{ $slot }}
</div>
