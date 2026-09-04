<div
	{{ $attributes->twMerge('-mx-4 -mb-4 flex flex-col-reverse gap-2 rounded-b-xl border-t bg-muted/50 p-4 sm:flex-row-reverse sm:justify-between') }}
	data-slot="alert-dialog-footer"
>
	{{ $slot }}
</div>
