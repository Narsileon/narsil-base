<div
	{{ $attributes->twMerge(
	        'flex size-full items-center justify-center rounded-full bg-muted text-sm text-muted-foreground group-data-[size=sm]/avatar:text-xs',
	    )->merge([
	        'data-slot' => 'avatar-fallback',
	    ]) }}
	x-cloak
	x-show="!imageLoaded"
>
	{{ $slot }}
</div>
