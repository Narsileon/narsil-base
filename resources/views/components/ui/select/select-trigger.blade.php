<button
	{{ $attributes->twMerge(
	        match ($variant) {
	            'secondary'
	                => 'flex w-full cursor-pointer items-center justify-between gap-1.5 rounded-md border border-secondary bg-secondary/80 p-2 text-sm text-secondary-foreground transition-all outline-none hover:bg-secondary focus-visible:bg-secondary',
	            'inline'
	                => 'flex w-fit cursor-pointer items-center justify-between gap-1.5 rounded-md border border-transparent px-1 text-sm transition-all outline-none hover:bg-accent hover:text-accent-foreground focus-visible:border-primary focus-visible:bg-accent/50',
	            default
	                => 'flex w-full cursor-pointer items-center justify-between gap-1.5 rounded-md border border-border bg-transparent p-2 text-sm shadow-sm transition-all outline-none hover:bg-accent hover:text-accent-foreground focus-visible:bg-accent',
	        } .
	            ' ' .
	            ($size === 'sm' ? 'h-7 rounded-[min(var(--radius-md),10px)]' : 'h-9') .
	            ' [&_svg]:size-4 [&_svg]:pointer-events-none [&_svg]:shrink-0',
	    )->merge([
	        'data-size' => $size,
	        'data-slot' => 'select-trigger',
	        'type' => 'button',
	        'id' => $id,
	    ]) }}
	@if ($required) aria-required="true" @endif
	aria-haspopup="listbox"
	x-bind:aria-expanded="selectOpen"
	x-on:click.prevent.stop="$store.narsilDropdown.toggle(dropdownId); if ($store.narsilDropdown.active === dropdownId) $nextTick(() => updateScroll())"
	x-on:keydown.arrow-down.prevent="$store.narsilDropdown.open(dropdownId); $nextTick(() => { updateScroll(); if ($refs['select-list']) $refs['select-list'].focus() })"
	x-on:keydown.enter.prevent="$store.narsilDropdown.toggle(dropdownId)"
	x-ref="select-trigger"
>
	{{ $slot }}
</button>
