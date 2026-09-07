<template
	{{ $attributes->merge([
	    'data-slot' => 'select-portal',
	]) }}
	x-teleport="body"
>
	{{ $slot }}
</template>
