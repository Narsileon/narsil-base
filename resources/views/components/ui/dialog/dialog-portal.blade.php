<template
	{{ $attributes->merge([
	    'data-slot' => 'dialog-portal',
	]) }}
	x-teleport="body"
>
	{{ $slot }}
</template>
