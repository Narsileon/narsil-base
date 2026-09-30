<div
	{{ $attributes->twMerge('w-full justify-center py-2 text-center text-muted-foreground')->merge([
	    'data-slot' => 'combobox-empty',
	]) }}
	x-show="filtered().length === 0"
>
	{{ $slot }}
</div>
