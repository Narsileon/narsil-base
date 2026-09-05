<label
	class="flex items-center gap-2 px-2 py-1 text-sm"
>
	<input
		@checked($visible[$column['id']] ?? ($column['visibility'] ?? true))
		type="checkbox"
		x-on:change="toggleColumn('{{ $column['id'] }}', $event.target.checked)"
	>
	{{ ucfirst($column['header'] ?? $column['id']) }}
</label>
