<div
	{{ $attributes->twMerge('mb-2 inline-flex size-10 items-center justify-center rounded-md bg-muted [&>svg:not([class*=\'size-\'])]:size-6') }}
	data-slot="alert-dialog-media"
>
	{{ $slot }}
</div>
