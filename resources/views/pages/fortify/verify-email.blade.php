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
						<x-narsil::ui.card.card-content>
							<p>
								{{ trans('narsil::emails.verify') }}
							</p>
							<p>
								{{ trans('narsil::emails.send') }}
							</p>
							<form
								action="{{ route('verification.send') }}"
								method="post"
							>
								@csrf
								<x-narsil::ui.button.button-root
									type="submit"
								>
									{{ trans('narsil::ui.send_again') }}
								</x-narsil::ui.button.button-root>
							</form>
						</x-narsil::ui.card.card-content>
					</x-narsil::ui.card.card-root>
				</x-narsil::ui.section.section-content>
			</x-narsil::ui.section.section-root>
		</x-narsil::ui.container.container-root>
	</main>
@endsection
