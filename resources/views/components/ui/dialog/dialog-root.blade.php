<div
	{{ $attributes->merge(['data-slot' => 'dialog-root']) }}
	x-data="{ open: @js((bool) $open) }"
	x-on:dialog-close="open = false"
	x-on:dialog-open.window="open = true"
>
	{{ $slot }}
</div>
