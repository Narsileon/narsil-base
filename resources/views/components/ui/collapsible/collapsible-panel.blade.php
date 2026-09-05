<div
	{{ $attributes->merge(['data-slot' => 'collapsible-panel']) }}
	x-cloak
	x-collapse
	x-show="collapsibleOpen"
>
	{{ $slot }}
</div>
