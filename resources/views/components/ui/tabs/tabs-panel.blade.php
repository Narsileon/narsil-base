<div
	{{ $attributes->twMerge('flex flex-1 flex-col gap-4 p-4 outline-none')->merge([
	    'data-slot' => 'tabs-panel',
	]) }}
>
	{{ $slot }}
</div>
