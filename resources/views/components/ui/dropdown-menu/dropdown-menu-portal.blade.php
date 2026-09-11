<template
	{{ $attributes->merge([
	    'data-slot' => 'dropdown-menu-portal',
	]) }}
	x-teleport="body"
>
	{{ $slot }}
</template>
