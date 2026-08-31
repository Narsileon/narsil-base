<fieldset
	{{ $attributes->twMerge('flex flex-col gap-4 has-[>[data-slot=checkbox-group]]:gap-3 has-[>[data-slot=radio-group]]:gap-3')->merge([
	        'data-slot' => 'fieldset-root',
	    ]) }}
>
	{{ $slot }}
</fieldset>
