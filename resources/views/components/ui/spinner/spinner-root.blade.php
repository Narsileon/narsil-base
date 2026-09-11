<x-narsil::ui.icon.icon-root
	{{ $attributes->twMerge('animate-spin')->merge([
	    'aria-label' => 'Loading',
	    'data-slot' => 'spinner-root',
	    'name' => 'loader-circle',
	    'role' => 'status',
	]) }}
/>
