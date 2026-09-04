
<div
	class="grid gap-4"
>
	@foreach ($form['steps'] ?? [] as $step)
		@foreach ($step['elements'] ?? [] as $element)
			@php
				$input = $element['input'] ?? [];
				$type = $input['type'] ?? 'text';
				$id = $element['id'];
				$labelFor = $type === 'select' || $type === 'combobox' ? null : $id;
			@endphp
			<div
				class="grid gap-2"
			>
				<label
					@if ($labelFor) for="{{ $labelFor }}" @endif
					class="text-sm font-medium"
				>
					{{ ucfirst(trans('narsil::validation.attributes.' . $id)) }}
				</label>
				@if ($type === 'select')
					<x-narsil::ui.form.inputs.inputs-select
						:id="$id"
						:input="$input"
						:model="$id"
						:value="$values[$id] ?? ($input['defaultValue'] ?? '')"
					/>
				@else
					@switch($type)
						@case('range')
							<div
								class="flex items-center gap-3"
							>
								<input
									class="accent-primary w-full"
									id="{{ $id }}"
									max="{{ $input['max'] }}"
									min="{{ $input['min'] }}"
									step="{{ $input['step'] }}"
									type="range"
									wire:model.live="{{ $id }}"
									x-on:input="$dispatch('dynamic-form-input', { id: '{{ $id }}', value: $event.target.value })"
								>
								<output
									class="text-muted-foreground w-12 text-right text-sm"
								>
									{{ number_format($values[$id] ?? ($input['defaultValue'] ?? 0.25), 2) }}
								</output>
							</div>
						@break

						@default
							<input
								class="bg-accent/50 focus-visible:ring-ring h-9 w-full rounded-lg border px-2.5 text-sm outline-none focus-visible:ring-2"
								id="{{ $id }}"
								type="text"
								wire:model.live="{{ $id }}"
							>
					@endswitch
				@endif
				@error($id)
					<p
						class="text-destructive text-sm"
						role="alert"
					>
						{{ $message }}
					</p>
				@enderror
			</div>
		@endforeach
	@endforeach
</div>
