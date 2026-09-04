
<div
	{{ $attributes->twMerge(
	        'group/avatar relative flex size-8 shrink-0 select-none rounded-full after:absolute after:inset-0 after:rounded-full after:border after:border-border after:mix-blend-darken dark:after:mix-blend-lighten data-[size=lg]:size-10 data-[size=sm]:size-6',
	    )->merge([
	        'data-size' => $size,
	        'data-slot' => 'avatar-root',
	    ]) }}
	x-data="{ imageLoaded: false }"
>
	{{ $slot }}
</div>
