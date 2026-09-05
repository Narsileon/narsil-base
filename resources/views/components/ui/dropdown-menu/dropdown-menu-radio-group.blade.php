<div
	{{ $attributes->merge([
	    'data-slot' => 'dropdown-menu-radio-group',
	    'role' => 'group',
	]) }}
>
	{{ $slot }}
</div>
