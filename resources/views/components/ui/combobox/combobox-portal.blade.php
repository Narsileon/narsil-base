<template
	{{ $attributes->merge([
	    'data-slot' => 'combobox-portal',
	]) }}
	x-teleport="body"
>
	{{ $slot }}
</template>
