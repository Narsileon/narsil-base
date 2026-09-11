<template
	{{ $attributes->merge([
	    'data-slot' => 'context-menu-portal',
	]) }}
	x-teleport="body"
>
	{{ $slot }}
</template>
