<span
	{{ $attributes->twMerge('ml-auto text-sm text-muted-foreground tabular-nums') }}
	data-slot="progress-value"
	x-text="value"
>
	{{ $slot }}
</span>
