<div
	{{ $attributes->twMerge('flex flex-1 flex-col gap-4 p-4 text-sm outline-none')->merge(['data-slot' => 'tabs-panel']) }}
>
	{{ $slot }}
</div>
