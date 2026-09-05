<form
	{{ $attributes->twMerge('grid')->merge([
	    'action' => $action,
	    'enctype' => $enctype,
	    'method' => 'post',
		]) }}
		@if ($id) id="{{ $id }}" @endif
		x-data="{ formDirty: false }"
		x-on:change="formDirty = true"
		x-on:click="if ($event.target.closest('[data-slot=checkbox-root]')) formDirty = true"
		x-on:input="formDirty = true"
	>
	@csrf
	@if (strtoupper($method) !== 'POST')
			@method($method)
		@endif
		<input
			name="_dirty"
			type="hidden"
			x-bind:value="formDirty ? '1' : '0'"
		>
	@if ($token)
		<input
			name="token"
			type="hidden"
			value="{{ $token }}"
		>
	@endif
	{{ $slot }}
</form>
