<div
	{{ $attributes->twMerge('flex w-full items-center justify-center gap-1') }}
>
	<a
		class="bg-secondary/80 text-secondary-foreground hover:bg-secondary inline-flex h-9 shrink-0 items-center justify-center rounded-md border border-transparent px-3 py-2 text-sm font-medium transition-all"
		href="{{ route('assets.index') }}"
	>
		{{ trans('narsil::ui.browse') }}
	</a>
	<span>
		{{ trans('narsil::ui.or') }}
	</span>
	<a
		class="bg-secondary/80 text-secondary-foreground hover:bg-secondary inline-flex h-9 shrink-0 items-center justify-center rounded-md border border-transparent px-3 py-2 text-sm font-medium transition-all"
		href="{{ route('assets.create') }}"
	>
		{{ trans('narsil::ui.create') }}
	</a>
</div>
