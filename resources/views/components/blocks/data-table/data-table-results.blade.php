	<span>
	@if ($total > 0)
		{{ trans('narsil::data-table.results', ['from' => $from, 'to' => $to, 'total' => $total]) }}
	@else
		{{ trans('narsil::data-table.empty') }}
	@endif
</span>
