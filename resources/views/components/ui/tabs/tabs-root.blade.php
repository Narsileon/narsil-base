
<div
	{{ $attributes->twMerge('group/tabs flex data-[orientation=horizontal]:flex-col')->merge(['data-orientation' => $orientation, 'data-slot' => 'tabs-root']) }}
>
	{{ $slot }}
</div>
