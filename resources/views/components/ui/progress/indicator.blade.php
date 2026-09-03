<div
	{{ $attributes->twMerge('h-full bg-primary transition-all') }}
	data-slot="progress-indicator"
	x-bind:style="`width: var(--progress-value, 0%)`"
>
	{{ $slot }}
</div>
