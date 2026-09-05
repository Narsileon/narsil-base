<div
	{{ $attributes->twMerge('relative isolate z-[60] min-w-36 overflow-x-hidden overflow-y-auto rounded-lg bg-popover text-popover-foreground shadow-md ring-1 ring-foreground/10')->merge(['data-slot' => 'select-popup', 'role' => 'listbox']) }}
	x-cloak
	x-on:click.outside="if ($store.narsilDropdown) $store.narsilDropdown.close(dropdownId); selectOpen = false"
	x-show="selectOpen"
	x-transition.origin.top
>
	{{ $slot }}
</div>
