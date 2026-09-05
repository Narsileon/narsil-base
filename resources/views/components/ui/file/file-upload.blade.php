<div
	{{ $attributes->twMerge('flex w-full flex-col items-center justify-center gap-3 rounded-lg p-4 text-center') }}
	x-show="!fileName"
>
	<div
		class="bg-muted size-9 rounded-full p-2"
	>
		<x-narsil::ui.icon.icon-root
			:name="$icon"
		/>
	</div>
	<div
		class="flex items-center gap-1 text-sm"
	>
		<strong
			class="font-medium"
		>
			{{ trans('narsil::file.upload') }}
		</strong>
		<span>
			{{ trans('narsil::ui.or') }}
		</span>
		<strong
			class="font-medium"
		>
			{{ trans('narsil::file.dnd') }}
		</strong>
	</div>
</div>
