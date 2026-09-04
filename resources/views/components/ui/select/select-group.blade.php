<div
	{{ $attributes->twMerge('scroll-my-1 p-1')->merge(['data-slot' => 'select-group', 'role' => 'group']) }}
>
	{{ $slot }}
</div>
