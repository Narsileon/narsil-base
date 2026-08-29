<p
	{{ $attributes->twMerge('line-clamp-2 text-left text-sm leading-normal font-normal text-muted-foreground [&>a]:underline [&>a]:underline-offset-4 [&>a:hover]:text-primary group-data-[size=xs]/item:text-xs')->merge(['data-slot' => 'item-description']) }}
>
	{{ $slot }}
</p>
