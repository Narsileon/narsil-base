<ul
	{{ $attributes->twMerge('flex w-full min-w-0 flex-col gap-1')->merge([
	    'data-slot' => 'sidebar-menu',
	]) }}
>
	{{ $slot }}
</ul>
