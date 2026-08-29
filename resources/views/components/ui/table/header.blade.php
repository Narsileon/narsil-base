<thead
	{{ $attributes->twMerge('[&_tr]:border-b')->merge([
	    'data-slot' => 'table-header',
	]) }}
>
	{{ $slot }}
</thead>
