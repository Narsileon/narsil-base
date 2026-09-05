<div
	{{ $attributes->twMerge('fixed inset-0 z-50 bg-black/50')->merge(['data-slot' => 'alert-dialog-backdrop']) }}
	x-cloak
	x-show="alertDialogOpen"
	x-transition.opacity
></div>
