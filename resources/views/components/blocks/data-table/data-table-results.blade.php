
@php $meta = data_get($payload, 'meta', []); @endphp

<span>
	{{ data_get($meta, 'total', 0) > 0 ? trans('narsil::data-table.results', ['current_page' => data_get($meta, 'current_page'), 'last_page' => data_get($meta, 'last_page')]) : trans('narsil::data-table.empty') }}
</span>
