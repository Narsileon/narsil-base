<div
	{{ $attributes->twMerge('text-sm text-balance text-muted-foreground md:text-pretty *:[a]:underline *:[a]:underline-offset-3 *:[a]:hover:text-foreground') }}
	data-slot="alert-dialog-description"
>
	{{ $slot }}
</div>
