<div
	{{ $attributes->merge([
	    'data-slot' => 'collapsible-root',
	]) }}
	x-data="{ collapsibleOpen: @js((bool) $open) }"
>
	{{ $slot }}
</div>
