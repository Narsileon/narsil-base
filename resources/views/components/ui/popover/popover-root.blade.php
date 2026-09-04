
<div
	{{ $attributes->merge(['data-slot' => 'popover-root']) }}
	x-data="{ open: @js((bool) $open) }"
	x-on:popover-close="open = false"
	x-on:popover-open.window="open = true"
>
	{{ $slot }}
</div>
