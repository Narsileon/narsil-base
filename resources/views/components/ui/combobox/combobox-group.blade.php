<div
	{{ $attributes->merge([
	    'data-slot' => 'combobox-group',
	    'role' => 'group',
	]) }}
>
	{{ $slot }}
</div>
