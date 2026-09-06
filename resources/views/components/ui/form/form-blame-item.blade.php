<div
	{{ $attributes->twMerge('flex min-w-0 flex-wrap items-center gap-1') }}
>
	<span
		class="text-muted-foreground"
	>
		{{ $label }}
	</span>
	<span
		class="font-medium"
	>
		{{ $date }}
	</span>
	@if ($name)
		<span
			class="text-muted-foreground"
		>
			{{ trans('narsil::blame.by') }}
		</span>
		<span
			class="break-words font-medium"
		>
			{{ $name }}
		</span>
	@endif
</div>
