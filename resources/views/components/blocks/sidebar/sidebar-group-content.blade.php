<ul
	{{ $attributes->twMerge('flex w-full flex-col gap-1')->merge([
	    'data-slot' => 'sidebar-group-content',
	]) }}
>
	{{ $slot }}
</ul>
