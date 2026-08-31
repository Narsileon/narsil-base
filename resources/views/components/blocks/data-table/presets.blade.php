@props(['payload'])

@php
	$presets = data_get(data_get($payload, 'meta', []), 'presets.data', []);
	$state = data_get(data_get($payload, 'meta', []), 'state', []);
@endphp

<div
	class="flex grow items-center gap-2"
>
	@foreach ($presets as $preset)
		<form
			action="{{ route('narsil.tables.update', data_get($state, 'uuid')) }}"
			method="POST"
		>
			@csrf @method('PATCH')
			<input
				name="preset_uuid"
				type="hidden"
				value="{{ data_get($preset, 'uuid') }}"
			>
			<button
				class="rounded-md border px-2 py-1 text-sm"
				type="submit"
			>
				{{ data_get($preset, 'name') }}
			</button>
		</form>
	@endforeach
</div>
