@props(['value'])

<div
	{{ $attributes->twMerge('text-sm')->merge([
	    'data-slot' => 'accordion-panel',
	]) }}
	aria-hidden="true"
	x-bind:aria-hidden="!isOpen(@js($value))"
	x-bind:data-state="isOpen(@js($value)) ? 'open' : 'closed'"
	x-bind:inert="!isOpen(@js($value))"
	x-cloak
	x-collapse
	x-show="isOpen(@js($value))"
>
	<div
		class="min-h-0"
	>
		<div
			class="[&_a]:underline-offset-3 [&_a]:hover:text-foreground pb-2.5 pt-0 [&_a]:underline [&_p:not(:last-child)]:mb-4"
		>
			{{ $slot }}
		</div>
	</div>
</div>
