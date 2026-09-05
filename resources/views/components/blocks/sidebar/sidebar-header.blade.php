<nav
	{{ $attributes->twMerge('grid h-13 items-center gap-2 border-b p-2')->merge([
	    'data-slot' => 'sidebar-header',
	    'aria-label' => 'Header Menu',
	]) }}
>
	{{ $slot }}
</nav>
