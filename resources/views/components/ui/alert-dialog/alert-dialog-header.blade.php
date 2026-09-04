<div
	{{ $attributes->twMerge('grid grid-rows-[auto_1fr] place-items-center gap-1.5 text-center sm:group-data-[size=default]/alert-dialog-popup:place-items-start sm:group-data-[size=default]/alert-dialog-popup:text-left') }}
	data-slot="alert-dialog-header"
>
	{{ $slot }}
</div>
