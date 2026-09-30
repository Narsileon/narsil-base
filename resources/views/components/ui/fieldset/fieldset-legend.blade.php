<legend
	{{ $attributes->twMerge('mb-1.5 font-medium data-[variant=label]: data-[variant=legend]:text-base')->merge([
	        'data-slot' => 'fieldset-legend',
	    ]) }}
>
	{{ $slot }}
</legend>
