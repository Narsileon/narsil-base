<nav
	{{ $attributes->merge([
	    'data-slot' => 'pagination-root',
	]) }}
	aria-label="Pagination"
	role="navigation"
>
	{{ $slot }}
</nav>
