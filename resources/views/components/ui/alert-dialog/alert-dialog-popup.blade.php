<section
	{{ $attributes->twMerge('group/alert-dialog-popup fixed top-1/2 left-1/2 z-50 grid w-full max-w-xs -translate-x-1/2 -translate-y-1/2 gap-4 rounded-xl bg-background p-4 text-foreground shadow-lg ring-1 ring-foreground/10 outline-none sm:max-w-sm' . ($size === 'sm' ? ' sm:max-w-xs' : '')) }}
	aria-modal="true"
	data-size="{{ $size }}"
	data-slot="alert-dialog-popup"
	role="alertdialog"
	x-cloak
	x-on:keydown.escape.window="$dispatch('alert-dialog-close')"
	x-show="alertDialogOpen"
	x-transition
>
	{{ $slot }}
</section>
