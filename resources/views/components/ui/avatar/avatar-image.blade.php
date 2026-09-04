<img
	{{ $attributes->twMerge('aspect-square size-full rounded-full object-cover')->merge([
	    'data-slot' => 'avatar-image',
	]) }}
	x-on:error="imageLoaded = false"
	x-on:load="imageLoaded = true"
	x-show="imageLoaded"
>
