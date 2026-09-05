<div
	{{ $attributes->merge(['data-slot' => 'dialog-root']) }}
	x-data="{ dialogOpen: @js((bool) $open) }"
	x-on:dialog-close="dialogOpen = false"
	x-on:dialog-open.window="dialogOpen = true"
>
	{{ $slot }}
</div>
