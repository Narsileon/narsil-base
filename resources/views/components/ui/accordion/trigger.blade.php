@props(['value'])

<button
	{{ $attributes->twMerge(
	        'group/accordion-trigger relative flex flex-1 cursor-pointer items-start justify-between rounded-lg border border-transparent py-2.5 text-left text-sm font-medium transition-all outline-none disabled:pointer-events-none disabled:opacity-50 focus-visible:underline hover:underline',
	    )->merge([
	        'data-slot' => 'accordion-trigger',
	        'type' => 'button',
	    ]) }}
	aria-expanded="false"
	x-bind:aria-expanded="isOpen(@js($value))"
	x-on:click="toggle(@js($value))"
>
	{{ $slot }}
</button>
