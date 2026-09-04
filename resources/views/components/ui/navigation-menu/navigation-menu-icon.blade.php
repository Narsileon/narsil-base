<span
	{{ $attributes->twMerge('top-full z-1 flex h-1.5 items-end justify-center overflow-hidden') }}
	data-slot="navigation-menu-icon"
>
	<div
		class="bg-border relative top-[60%] h-2 w-2 rotate-45 rounded-tl-sm shadow-md"
	></div>
	{{ $slot }}
</span>
