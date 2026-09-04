<div
	{{ $attributes->merge(['data-slot' => 'collapsible-panel']) }}
	x-cloak
	x-collapse
	x-show="open"
>
	{{ $slot }}
</div>
