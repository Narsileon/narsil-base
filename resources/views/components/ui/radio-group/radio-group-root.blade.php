<div
	{{ $attributes->twMerge('grid w-full gap-2')->merge(['data-slot' => 'radio-group-root', 'role' => 'radiogroup']) }}
>
	{{ $slot }}
</div>
