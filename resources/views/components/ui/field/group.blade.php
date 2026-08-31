<div
	{{ $attributes->twMerge('group/field-group @container/field-group flex w-full flex-col gap-5')->merge([
	    'data-slot' => 'field-group',
	]) }}
>
	{{ $slot }}
</div>
