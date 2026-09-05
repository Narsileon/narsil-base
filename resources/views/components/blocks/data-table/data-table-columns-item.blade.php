@php
	$state = data_get($payload, 'meta.state', []);
	$visible = data_get($state, 'column_visibility', []);
@endphp

<label
	class="flex items-center gap-2 px-2 py-1 text-sm"
>
	<input
		@checked(data_get($visible, $column['id'], $column['visibility'] ?? true))
		type="checkbox"
		x-on:change="toggleColumn('{{ $column['id'] }}')"
	>
	{{ ucfirst($column['header'] ?? $column['id']) }}
</label>
