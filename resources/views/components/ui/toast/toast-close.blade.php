<button
	{{ $attributes->twMerge('inline-flex size-7 shrink-0 cursor-pointer items-center justify-center rounded-md hover:bg-accent')->merge([
	        'data-slot' => 'toast-close',
	        'type' => 'button',
	    ]) }}
	aria-label="{{ trans('narsil::ui.close') }}"
	x-on:click="toastOpen = false"
>
	<x-narsil::ui.icon.icon-root
		class="size-4"
		name="xmark"
	/>
</button>
