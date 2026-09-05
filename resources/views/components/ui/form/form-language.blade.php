<div
	{{ $attributes->twMerge('grid gap-1 border-b p-2')->merge([
	    'data-slot' => 'form-language',
	]) }}
>
	<div
		class="flex items-center justify-start gap-2 pl-2.5"
	>
		<x-narsil::ui.icon.icon-root
			class="size-4"
			name="globe"
		/>
		<x-narsil::ui.heading.heading-root
			level="h3"
			variant="discreet"
		>
			{{ trans('narsil::ui.translations') }}
		</x-narsil::ui.heading.heading-root>
	</div>
	<x-narsil::ui.toggle-group.toggle-group-root
		:selected="$selectedLanguage"
		orientation="vertical"
		spacing="1"
		x-effect="selected = formLanguage"
		x-on:form-language-change="formLanguage = $event.detail.value"
	>
		@foreach ($languages as $language)
			<x-narsil::ui.toggle-group.toggle-group-item
				:value="$language['value']"
				change-event="form-language-change"
				class="flex w-full items-center justify-between pr-2"
			>
				<span
					class="before:bg-constructive relative pl-5 font-normal before:absolute before:left-0 before:top-1/2 before:size-1.5 before:-translate-y-1/2 before:rounded-full"
					x-bind:class="formLanguage === {{ Illuminate\Support\Js::from($language['value']) }} ?
					    'before:animate-pulse before:bg-constructive' : 'before:bg-foreground'"
				>
					{{ $language['label'] }}
				</span>
				@if ($language['value'] === (string) $defaultLanguage)
					<x-narsil::ui.badge.badge-root
						class="bg-background"
						variant="outline"
					>
						{{ trans('narsil::ui.default') }}
					</x-narsil::ui.badge.badge-root>
				@endif
			</x-narsil::ui.toggle-group.toggle-group-item>
		@endforeach
	</x-narsil::ui.toggle-group.toggle-group-root>
</div>
