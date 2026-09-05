<div
	{{ $attributes->twMerge('flex h-8 items-center gap-0.5 rounded-lg border bg-background p-0.75')->merge([
	    'data-slot' => 'menubar-root',
	]) }}
>
	{{ $slot }}
</div>
