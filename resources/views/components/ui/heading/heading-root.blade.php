@php
	$classes = match ($variant) {
	    'h1' => 'text-4xl',
	    'h2' => 'text-3xl',
	    'h3' => 'text-2xl',
	    'h4' => 'text-xl',
	    'h5' => 'text-lg',
	    'discreet' => 'flex h-8 items-center text-xs font-medium text-muted-foreground',
	    default => 'text-base',
	};
	$attributes = $attributes->twMerge("font-medium tracking-tight text-foreground {$classes}")->merge([
	    'data-slot' => 'heading-root',
	]);
@endphp

@switch ($level)
	@case('h1')
		<h1 {{ $attributes }}>
			{{ $slot }}
		</h1>
		@break
	@case('h2')
		<h2 {{ $attributes }}>
			{{ $slot }}
		</h2>
		@break
	@case('h3')
		<h3 {{ $attributes }}>
			{{ $slot }}
		</h3>
		@break
	@case('h4')
		<h4 {{ $attributes }}>
			{{ $slot }}
		</h4>
		@break
	@case('h5')
		<h5 {{ $attributes }}>
			{{ $slot }}
		</h5>
		@break
	@default
		<h6 {{ $attributes }}>
			{{ $slot }}
		</h6>
@endswitch
