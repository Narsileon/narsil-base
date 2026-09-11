<template
	{{ $attributes->merge([
	    'data-slot' => 'alert-dialog-portal',
	]) }}
	x-teleport="body"
>
	{{ $slot }}
</template>
