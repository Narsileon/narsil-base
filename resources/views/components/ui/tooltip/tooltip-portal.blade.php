<template
	{{ $attributes->merge([
	    'data-slot' => 'tooltip-portal',
	]) }}
	x-teleport="body"
>
	{{ $slot }}
</template>
