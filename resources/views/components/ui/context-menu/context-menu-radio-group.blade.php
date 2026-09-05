<div
	{{ $attributes->merge([
	    'data-slot' => 'context-menu-radio-group',
	    'role' => 'group',
	]) }}
>
	{{ $slot }}
</div>
