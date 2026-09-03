@props(['path', 'title' => null])

@php
	$svg = file_get_contents($path);
	$fill = $attributes->get('fill', 'currentColor');
	$attributes = $attributes
	    ->except('fill')
	    ->twMerge('size-5 shrink-0')
	    ->merge([
	        'aria-hidden' => $title ? 'false' : 'true',
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
