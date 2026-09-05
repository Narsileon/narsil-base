<span
	class="truncate"
	data-empty-label="{{ trans('narsil::data-table.selection_empty') }}"
	data-selection-label="{{ trans('narsil::data-table.selection') }}"
	data-total="{{ $total }}"
	x-text="Object.values(selected).filter(Boolean).length > 0 ? $el.dataset.selectionLabel.replace(':selected', Object.values(selected).filter(Boolean).length).replace(':total', $el.dataset.total) : $el.dataset.emptyLabel"
>
	{{ trans('narsil::data-table.selection_empty') }}
</span>
