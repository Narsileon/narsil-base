<section
	{{ $attributes->twMerge(
	        'fixed top-1/2 left-1/2 z-50 grid max-h-[calc(100%-2rem)] w-[calc(100%-2rem)] max-w-lg -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-xl border bg-card text-card-foreground shadow-lg',
	    )->merge([
	        'data-slot' => 'dialog-popup',
	        'role' => 'dialog',
	    ]) }}
	aria-modal="true"
	x-cloak
	x-on:keydown.escape.window="$dispatch('dialog-close')"
	x-show="dialogOpen"
	x-transition
>
	{{ $slot }}
	@if ($showCloseButton)
		<x-narsil::ui.dialog.dialog-close
			aria-label="{{ trans('narsil::ui.close') }}"
			class="absolute right-3 top-3"
			size="icon-sm"
			variant="ghost"
		>
			<x-narsil::ui.icon.icon-root
				class="!size-4"
				name="xmark"
			/>
			<span
				class="sr-only"
			>
				{{ trans('narsil::ui.close') }}
			</span>
		</x-narsil::ui.dialog.dialog-close>
	@endif
</section>
