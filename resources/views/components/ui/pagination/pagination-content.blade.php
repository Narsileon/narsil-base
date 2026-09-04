<ul
	{{ $attributes->twMerge('flex flex-row items-center')->merge(['data-slot' => 'pagination-content']) }}
>
	{{ $slot }}
</ul>
