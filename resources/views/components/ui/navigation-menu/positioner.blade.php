<div
	{{ $attributes->twMerge('isolate z-50 h-(--positioner-height) w-(--positioner-width) max-w-(--available-width) transition-[top,left,right,bottom] duration-300') }}
	data-slot="navigation-menu-positioner"
>
	{{ $slot }}
</div>
