<span
	{{ $attributes->twMerge('relative inline-flex h-4.5 w-8.5 shrink-0 rounded-full border border-transparent bg-border ring-1 ring-transparent transition-all peer-checked:bg-constructive peer-focus-visible:border-primary peer-focus-visible:ring-primary peer-disabled:cursor-not-allowed peer-disabled:opacity-50 peer-checked:[&>span]:translate-x-full')->merge([
	    'data-slot' => 'switch-track',
	]) }}
>
	{{ $slot }}
</span>
