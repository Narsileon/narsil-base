<div
	{{ $attributes->twMerge(
	        'group/input-group relative flex h-9 w-full min-w-0 items-center overflow-hidden rounded-md border bg-accent/50 ring-1 ring-transparent transition-all outline-none has-[[data-slot][aria-invalid=true]]:border-destructive has-[[data-slot][aria-invalid=true]]:ring-destructive has-[>[data-slot=input-group-control]:focus-visible]:border-primary has-[>[data-slot=input-group-control]:focus-visible]:ring-primary has-[>[data-slot=input-group-control]:focus-visible]:ring-primary has-[>[data-align=block-end]]:[&>input]:pt-3 has-[>[data-align=block-end]]:h-auto has-[>[data-align=block-end]]:flex-col has-[>[data-align=block-start]]:[&>input]:pb-3 has-[>[data-align=block-start]]:h-auto has-[>[data-align=block-start]]:flex-col has-[>[data-align=inline-end]]:[&>input]:pr-1.5 has-[>[data-align=inline-start]]:[&>input]:pl-1.5 has-[>textarea]:h-auto',
	    )->merge([
	        'data-slot' => 'input-group-root',
	        'role' => 'group',
	    ]) }}
>
	{{ $slot }}
</div>
