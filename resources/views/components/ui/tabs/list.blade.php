<div
	{{ $attributes->twMerge('group/tabs-list inline-flex justify-start gap-2 text-muted-foreground data-[orientation=horizontal]:h-13 data-[orientation=horizontal]:flex-row data-[orientation=horizontal]:items-center data-[orientation=horizontal]:overflow-x-auto data-[orientation=horizontal]:overflow-y-hidden data-[orientation=horizontal]:w-full data-[orientation=vertical]:h-fit data-[orientation=vertical]:flex-col data-[orientation=vertical]:items-start data-[orientation=vertical]:min-w-40 data-[orientation=vertical]:overflow-x-hidden data-[orientation=vertical]:overflow-y-auto data-[orientation=vertical]:sticky data-[orientation=vertical]:top-0')->merge(['data-slot' => 'tabs-list']) }}
>
	{{ $slot }}
</div>
