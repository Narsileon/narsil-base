<div
	{{ $attributes->merge(['data-slot' => 'alert-dialog-root']) }}
	x-data="{ alertDialogOpen: @js((bool) $open) }"
	x-on:alert-dialog-close="alertDialogOpen = false"
	x-on:alert-dialog-open.window="alertDialogOpen = true"
>
	{{ $slot }}
</div>
