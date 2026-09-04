
@php
	$variantClasses = match ($variant) {
	    'sm' => 'w-full px-4 md:px-8 lg:max-w-5xl',
	    'lg' => 'w-full px-4 md:px-8',
	    default => 'w-full px-4 md:px-8 lg:max-w-7xl',
	};
@endphp

<div
	{{ $attributes->twMerge("mx-auto flex flex-col items-center gap-4 {$variantClasses}")->merge(['data-slot' => 'container']) }}
>
	{{ $slot }}
</div>
