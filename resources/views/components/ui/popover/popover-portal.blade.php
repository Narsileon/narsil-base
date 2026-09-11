<template
	{{ $attributes->merge([
	    'data-slot' => 'popover-portal',
	]) }}
	x-teleport="body"
>
	{{ $slot }}
</template>
