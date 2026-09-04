
<div
	{{ $attributes->merge(['data-slot' => 'collapsible-root']) }}
	x-data="{ open: @js((bool) $open) }"
>
	{{ $slot }}
</div>
