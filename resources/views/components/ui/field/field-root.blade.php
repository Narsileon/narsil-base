
@php
	$widthClass = match ($width) {
	    25 => 'col-span-3',
	    33 => 'col-span-4',
	    50 => 'col-span-6',
	    67 => 'col-span-8',
	    75 => 'col-span-9',
	    default => 'col-span-full',
	};

	$orientationClass = match ($orientation) {
	    'horizontal' => 'flex-row items-center *:data-[slot=field-label]:flex-auto',
	    'responsive'
	        => 'flex-col *:w-full @md/field-group:flex-row @md/field-group:items-center @md/field-group:*:w-auto @md/field-group:*:data-[slot=field-label]:flex-auto',
	    default => 'flex-col *:w-full [&>.sr-only]:w-auto',
	};
@endphp

<div
	{{ $attributes->twMerge("group/field {$widthClass} {$orientationClass} flex w-full gap-2 data-[invalid=true]:text-destructive")->merge([
	        'data-orientation' => $orientation,
	        'data-slot' => 'field-root',
	        'role' => 'group',
	    ]) }}
>
	{{ $slot }}
</div>
