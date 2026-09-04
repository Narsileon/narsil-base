
@php
	$tag = 'button';

	if ($href) {
	    $tag = 'a';
	}
@endphp

<{{ $tag }}
	{{ $attributes->twMerge("group/menu-item relative flex min-h-9 w-full cursor-pointer items-center justify-start gap-1.5 rounded-md px-3 py-2 text-left text-sm outline-hidden select-none [&_svg:not([class*='size-'])]:size-4 [&_svg]:pointer-events-none [&_svg]:shrink-0 data-disabled:pointer-events-none data-disabled:opacity-50 data-inset:pl-8 data-variant-destructive:text-destructive data-variant-destructive:focus:bg-destructive/10 data-variant-destructive:focus:text-destructive focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground" . ($inset ? ' pl-8' : '')) }}
	@if ($inset) data-inset="true" @endif
	@if ($href) href="{{ $href }}" @else type="button" @endif
	data-slot="dropdown-menu-item"
	data-variant="{{ $variant }}"
	role="menuitem"
	x-on:click="$dispatch('dropdown-menu-close')"
>
	{{ $slot }}
	</{{ $tag }}>
