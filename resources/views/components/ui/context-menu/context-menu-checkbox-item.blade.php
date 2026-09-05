<button
	{{ $attributes->twMerge(
	        'relative flex cursor-default items-center gap-1.5 rounded-md py-1 pr-8 pl-1.5 text-sm outline-hidden select-none focus:bg-accent focus:text-accent-foreground',
	    )->merge([
	        'aria-checked' => $checked ? 'true' : 'false',
	        'data-slot' => 'context-menu-checkbox-item',
	        'role' => 'menuitemcheckbox',
	        'type' => 'button',
	    ]) }}
	x-on:click="$dispatch('context-menu-close')"
>
	{{ $slot }}
</button>
