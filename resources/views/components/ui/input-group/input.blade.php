<x-narsil::ui.input.root
	{{ $attributes->twMerge(
	        'flex-1 rounded-none border-0 bg-transparent shadow-none ring-0 focus-visible:ring-0 disabled:bg-transparent aria-invalid:ring-0',
	    )->merge([
	        'data-slot' => 'input-group-control',
	    ]) }}
/>
