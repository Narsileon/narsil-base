
<div
	{{ $attributes->merge(['data-slot' => 'alert-dialog-root']) }}
	x-data="{ open: @js((bool) $open) }"
	x-on:alert-dialog-close="open = false"
	x-on:alert-dialog-open.window="open = true"
>
	{{ $slot }}
</div>
