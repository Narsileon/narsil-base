<template
	{{ $attributes->twMerge() }}
	data-slot="tooltip-portal"
	x-teleport="body"
>
	{{ $slot }}
</template>
