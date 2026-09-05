<li
	{{ $attributes->twMerge('relative flex w-full min-w-0 flex-col')->merge([
	    'data-slot' => 'sidebar-group',
	]) }}
>
	{{ $slot }}
</li>
