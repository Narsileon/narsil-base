<span>
	@if (($meta['total'] ?? 0) > 0)
		{{ trans('narsil::data-table.results', ['current_page' => $meta['current_page'] ?? null, 'last_page' => $meta['last_page'] ?? null]) }}
	@else
		{{ trans('narsil::data-table.empty') }}
	@endif
</span>
