<div
	{{ $attributes->twMerge('max-h-64 overflow-y-auto scroll-py-1 p-1')->merge([
	    'data-slot' => 'combobox-list',
	    'role' => 'listbox',
	]) }}
	x-on:scroll="virtualized && updateVirtualWindow()"
	x-ref="combobox-list"
>
	{{ $slot }}
</div>
