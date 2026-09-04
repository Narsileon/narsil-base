<legend
	{{ $attributes->twMerge('mb-1.5 font-medium data-[variant=label]:text-sm data-[variant=legend]:text-base')->merge([
	        'data-slot' => 'fieldset-legend',
	    ]) }}
>
	{{ $slot }}
</legend>
