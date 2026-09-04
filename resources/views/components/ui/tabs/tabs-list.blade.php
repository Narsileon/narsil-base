<div
	{{ $attributes->twMerge('group/tabs-list inline-flex justify-start gap-2 text-muted-foreground data-[orientation=horizontal]:h-13 data-[orientation=horizontal]:flex-row data-[orientation=horizontal]:items-center data-[orientation=horizontal]:overflow-x-auto data-[orientation=horizontal]:overflow-y-hidden data-[orientation=horizontal]:w-full data-[orientation=vertical]:h-fit data-[orientation=vertical]:items-start data-[orientation=vertical]:sticky data-[orientation=vertical]:top-0 md:group-data-[orientation=vertical]/tabs:flex-col md:group-data-[orientation=vertical]/tabs:min-w-40 md:group-data-[orientation=vertical]/tabs:overflow-x-hidden md:group-data-[orientation=vertical]/tabs:overflow-y-auto max-md:flex-row max-md:items-center max-md:w-full max-md:min-w-0 max-md:overflow-x-auto max-md:overflow-y-hidden')->merge(['data-slot' => 'tabs-list']) }}
>
	{{ $slot }}
</div>
