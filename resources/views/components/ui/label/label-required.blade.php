<span
	{{ $attributes->twMerge('text-destructive')->merge([
	    'aria-label' => trans('narsil::ui.required'),
	    'data-slot' => 'label-required',
	]) }}
>
	@if ($slot->isEmpty())
		*
	@else
		{{ $slot }}
	@endif
</span>
