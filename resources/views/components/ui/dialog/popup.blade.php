@props(['showCloseButton' => true])

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
	x-show="open"
	x-transition
>
	{{ $slot }}
	@if ($showCloseButton)
		<x-narsil::ui.dialog.close
			aria-label="{{ trans('narsil::ui.close') }}"
			class="group/button focus-visible:border-primary focus-visible:ring-primary hover:bg-accent hover:text-accent-foreground absolute right-3 top-3 inline-flex size-7 shrink-0 cursor-pointer select-none items-center justify-center gap-1.5 whitespace-nowrap rounded-md border border-transparent p-1 font-medium outline-none ring-1 ring-transparent transition-all duration-300"
		>
			<x-narsil::ui.icon.root
				class="size-4"
				name="x"
			/>
			<span
				class="sr-only"
			>{{ trans('narsil::ui.close') }}</span>
		</x-narsil::ui.dialog.close>
	@endif
</section>
