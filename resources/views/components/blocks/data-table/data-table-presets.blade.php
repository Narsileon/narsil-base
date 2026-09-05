<div
	class="flex grow items-center gap-2"
>
	@foreach ($presets as $preset)
		<form
			action="{{ route('narsil.tables.update', $uuid) }}"
			method="POST"
		>
			@csrf @method('PATCH')
			<input
				name="preset_uuid"
				type="hidden"
				value="{{ $preset['uuid'] ?? null }}"
			>
			<button
				class="rounded-md border px-2 py-1 text-sm"
				type="submit"
			>
				{{ $preset['name'] ?? null }}
			</button>
		</form>
	@endforeach
</div>
