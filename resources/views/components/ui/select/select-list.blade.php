<div
	{{ $attributes->twMerge('flex max-h-72 flex-col gap-0.5 overflow-y-auto p-1.5 outline-none')->merge([
	    'data-slot' => 'select-list',
	    'tabindex' => '0',
	]) }}
	x-on:keydown.escape.prevent="if ($store.narsilDropdown) $store.narsilDropdown.close(dropdownId); selectOpen = false"
	x-on:scroll="updateScroll()"
	x-ref="select-list"
>
	{{ $slot }}
</div>
