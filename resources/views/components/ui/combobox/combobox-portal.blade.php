<template
	{{ $attributes->merge([
	    'data-slot' => 'combobox-portal',
	]) }}
	x-on:combobox-change
	x-teleport="body"
>
	{{ $slot }}
</template>
