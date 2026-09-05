<div
	{{ $attributes->merge([
	    'data-slot' => 'menubar-radio-group',
	    'role' => 'group',
	]) }}
>
	{{ $slot }}
</div>
