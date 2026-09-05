@php
	$classes = [
	    'flex w-fit items-stretch [&>[data-slot=select-trigger]:not([class*=\'w-\'])]:w-fit [&>input]:flex-1 *:focus-visible:relative *:focus-visible:z-10 has-[>[data-slot=button-group]]:gap-2',
	];

	$classes[] = match ($orientation) {
	    'vertical'
	        => 'flex-col [&>[data-slot]:not(:has(~[data-slot]))]:rounded-b-md! [&>[data-slot]~[data-slot]]:border-t-0 [&>[data-slot]~[data-slot]]:rounded-t-none *:data-slot:rounded-b-none',
	    default
	        => '*:data-slot:rounded-r-none [&>[data-slot]:not(:has(~[data-slot]))]:rounded-r-md! [&>[data-slot]~[data-slot]]:border-l-0 [&>[data-slot]~[data-slot]]:rounded-l-none',
	};
@endphp

<div
	{{ $attributes->twMerge(implode(' ', $classes))->merge([
	    'data-orientation' => $orientation,
	    'data-slot' => 'button-group',
	    'role' => 'group',
	]) }}
>
	{{ $slot }}
</div>
