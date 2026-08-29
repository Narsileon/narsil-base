@props(['form', 'color' => 'gray', 'language' => 'en', 'radius' => 0.25])

<div
	class="grid gap-4"
>
	@foreach ($form['steps'] ?? [] as $step)
		@foreach ($step['elements'] ?? [] as $element)
			@php
				$input = $element['input'] ?? [];
				$type = $input['type'] ?? 'text';
				$id = $element['id'];
				$label = trans('narsil::validation.attributes.' . $id);
				$optionLabels = collect($input['options'] ?? [])
				    ->mapWithKeys(
				        fn(array $option): array => [
				            $option['value'] => trim(strip_tags($option['label'])),
				        ],
				    )
				    ->all();
			@endphp
			<div
				class="grid gap-2"
			>
				<label
					class="text-sm font-medium"
					for="{{ $id }}"
				>
					{{ \Illuminate\Support\Str::ucfirst($label) }}
				</label>
				@switch($type)
					@case('select')
						<div
							@if ($id === 'color') x-init="if (document.documentElement.dataset.color) value = document.documentElement.dataset.color" @endif
							class="relative"
							id="{{ $id }}"
							x-data="{ value: $wire.entangle('{{ $id }}').live, labels: @js($optionLabels), open: false, search: '' }"
						>
							<button
								class="border-border bg-accent/50 hover:bg-accent focus-visible:border-primary focus-visible:ring-primary flex h-9 w-full cursor-pointer items-center justify-between gap-2 rounded-md border px-3 py-2 text-left text-sm font-normal outline-none ring-1 ring-transparent transition-all"
								type="button"
								x-cloak
								x-on:click="open = true; search = ''; $nextTick(() => $refs.searchInput.focus())"
								x-show="!open"
							>
								<span
									class="flex min-w-0 grow items-center gap-2 truncate"
								>
									@if ($id === 'color')
										<span
											class="block size-3 shrink-0 rounded-full"
											x-bind:class="`bg-${value}-500`"
										></span>
									@endif
									<span
										class="truncate"
										x-text="labels[value] || value"
									></span>
								</span>
								<x-narsil::ui.icon.root
									class="size-4"
									name="chevron-down"
								/>
							</button>
							<div
								class="relative"
								x-cloak
								x-show="open"
							>
								<input
									class="border-border bg-accent/50 placeholder:text-muted-foreground hover:bg-accent focus-visible:border-primary focus-visible:ring-primary h-9 w-full rounded-md border px-3 py-2 pr-10 text-sm font-normal outline-none ring-1 ring-transparent transition-all"
									placeholder="{{ trans('narsil::placeholders.search') }}"
									type="text"
									x-model="search"
									x-on:keydown.escape="open = false; search = ''"
									x-ref="searchInput"
								>
								<span
									class="pointer-events-none absolute inset-y-0 right-3 flex items-center"
								>
									<x-narsil::ui.icon.root
										class="size-4"
										name="chevron-down"
									/>
								</span>
							</div>
							<div
								class="bg-popover text-popover-foreground absolute inset-x-0 top-full z-10 mt-1 max-h-56 overflow-auto rounded-md border p-1 shadow-md"
								x-cloak
								x-on:click.outside="open = false"
								x-show="open"
								x-transition.origin.top
							>
								@foreach ($input['options'] ?? [] as $option)
									<button
										class="hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground flex w-full items-center gap-2 rounded-md px-2 py-1.5 text-left text-sm font-normal outline-none"
										type="button"
										x-on:click="value = @js($option['value']); @if ($id === 'color') applyColor(@js($option['value'])); @elseif ($id === 'language') $wire.updateLanguage(@js($option['value'])); @endif open = false"
										x-show="!search || labels[{{ Js::from($option['value']) }}].toLowerCase().includes(search.toLowerCase())"
									>
										@if ($id === 'color')
											<span
												class="bg-{{ $option['value'] }}-500 block size-3 shrink-0 rounded-full"
											></span>
										@endif
										<span
											class="grow"
										>{{ trim(strip_tags($option['label'])) }}</span>
									</button>
								@endforeach
								<p
									class="text-muted-foreground px-2 py-3 text-center text-sm"
									x-cloak
									x-show="search && !Object.values(labels).some((label) => label.toLowerCase().includes(search.toLowerCase()))"
								>
									{{ trans('narsil::pagination.pages_empty') }}
								</p>
							</div>
						</div>
					@break

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
								x-on:input="applyRadius($event.target.value)"
							>
							<output
								class="text-muted-foreground w-12 text-right text-sm"
							>{{ number_format($radius, 2) }}</output>
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
				@error($id)
					<p
						class="text-destructive text-sm"
						role="alert"
					>{{ $message }}</p>
				@enderror
			</div>
		@endforeach
	@endforeach
</div>
