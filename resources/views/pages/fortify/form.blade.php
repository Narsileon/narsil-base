@extends('narsil::layouts.auth')

@section('body')
	<main
		class="relative flex min-h-[calc(100vh-3.25rem)] items-center justify-center overflow-hidden"
	>
		<x-narsil::ui.container.container-root
			class="h-[inherit] min-h-[inherit] justify-center"
			variant="sm"
		>
			<x-narsil::ui.section.section-root
				class="animate-in fade-in-0 slide-in-from-bottom-10 py-4"
			>
				<x-narsil::ui.section.section-header>
					<x-narsil::ui.heading.heading-root
						level="h1"
						variant="h4"
					>
						{{ $title }}
					</x-narsil::ui.heading.heading-root>
				</x-narsil::ui.section.section-header>
				<x-narsil::ui.section.section-content>
					<x-narsil::ui.card.card-root
						class="max-w-md"
					>
						<x-narsil::ui.card.card-content
							class="p-6"
						>
							<x-narsil::ui.form.form-provider
								:default-language="$form->defaultLanguage ?? 'en'"
								:languages="$form->languages ?? []"
							>
								<x-narsil::ui.form.form-root
									:action="$form->action"
									:enctype="$form->id === 'profile-form' ? 'multipart/form-data' : 'application/x-www-form-urlencoded'"
									:id="$form->id"
									:method="$form->method"
									:token="$token ?? null"
									class="grid-cols-12 gap-6"
								>
									<x-narsil::ui.form.form-tabs
										:steps="$form->steps ?? []"
									/>
									<x-narsil::ui.button.button-root
										class="col-span-full w-full"
										type="submit"
									>
										{{ $form->submitLabel }}
									</x-narsil::ui.button.button-root>
								</x-narsil::ui.form.form-root>
							</x-narsil::ui.form.form-provider>
						</x-narsil::ui.card.card-content>
						@if ($form->id === 'forgot-password-form')
							<x-narsil::ui.card.card-footer
								class="border-t px-6"
							>
								<a
									class="group/button bg-secondary/80 text-secondary-foreground hover:bg-secondary focus-visible:border-primary focus-visible:ring-primary inline-flex h-9 w-full shrink-0 cursor-pointer select-none items-center justify-center gap-2 whitespace-nowrap rounded-md border border-transparent bg-clip-padding px-3 py-2 font-medium outline-none ring-1 ring-transparent transition-all duration-300"
									href="{{ route('login') }}"
								>
									{{ trans('narsil::ui.back') }}
								</a>
							</x-narsil::ui.card.card-footer>
						@endif
					</x-narsil::ui.card.card-root>
				</x-narsil::ui.section.section-content>
			</x-narsil::ui.section.section-root>
		</x-narsil::ui.container.container-root>
	</main>
@endsection
