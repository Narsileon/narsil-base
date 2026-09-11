@php
	$attributes = $attributes
	    ->except('fill')
	    ->twMerge('size-5 shrink-0 text-primary')
	    ->merge([
	        'aria-hidden' => $title ? 'false' : 'true',
	        'data-slot' => 'icon-root',
	        'role' => $title ? 'img' : 'presentation',
	    ]);
	$svg = preg_replace_callback(
	    '/<svg\b([^>]*)>/i',
	    static fn(array $matches): string => '<svg ' .
	        trim($matches[1]) .
	        ' ' .
	        $attributes->toHtml() .
	        ' fill="' .
	        $fill .
	        '">',
	    $svg,
	    1,
	);
@endphp

{!! $svg !!}
