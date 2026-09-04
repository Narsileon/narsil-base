<nav
	{{ $attributes->twMerge('group/navigation-menu relative flex max-w-max flex-1 items-center justify-center') }}
	data-slot="navigation-menu-root"
	x-data="{ menuOpen: null }"
>
	{{ $slot }}
</nav>
