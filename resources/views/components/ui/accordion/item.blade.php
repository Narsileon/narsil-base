@props(['value'])

<div
	{{ $attributes->twMerge('not-last:border-b')->merge([
	    'data-slot' => 'accordion-item',
	]) }}
	x-bind:data-state="isOpen(@js($value)) ? 'open' : 'closed'"
>
	{{ $slot }}
</div>
