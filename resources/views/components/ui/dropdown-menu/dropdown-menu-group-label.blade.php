<div
	{{ $attributes->twMerge('px-1.5 py-1 text-xs font-medium text-muted-foreground' . ($inset ? ' pl-8' : ''))->merge([
	        'data-slot' => 'dropdown-menu-group-label',
	    ]) }}
	@if ($inset) data-inset="true" @endif
>
	{{ $slot }}
</div>
