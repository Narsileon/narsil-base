@props(['checked' => false])

<button
	{{ $attributes->twMerge(
	        'relative flex cursor-default items-center gap-1.5 rounded-md py-1 pr-8 pl-1.5 text-sm outline-hidden select-none [&_svg:not([class*=\'size-\'])]:size-4 [&_svg]:pointer-events-none [&_svg]:shrink-0 data-disabled:pointer-events-none data-disabled:opacity-50 focus:bg-accent focus:text-accent-foreground',
	    )->merge([
	        'data-slot' => 'dropdown-menu-checkbox-item',
	        'role' => 'menuitemcheckbox',
	        'type' => 'button',
	    ]) }}
	aria-checked="{{ $checked ? 'true' : 'false' }}"
	x-on:click="$dispatch('dropdown-menu-close')"
>
	{{ $slot }}
</button>
