<div
	{{ $attributes->merge([
	    'data-slot' => 'context-menu-group',
	    'role' => 'group',
	]) }}
>
	{{ $slot }}
</div>
