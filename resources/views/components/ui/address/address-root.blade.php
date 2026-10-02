<address
	{{ $attributes->twMerge('flex flex-col not-italic')->merge([
	    'data-slot' => 'address-root',
	]) }}
>
	{{ $slot }}
</address>
