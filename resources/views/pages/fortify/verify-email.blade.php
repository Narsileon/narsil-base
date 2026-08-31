@extends('narsil::layouts.auth')

@section('body')
	<main
		class="relative flex min-h-[calc(100vh-3.25rem)] items-center justify-center overflow-hidden"
	>
		<x-narsil::ui.container.root
			class="h-[inherit] min-h-[inherit] justify-center"
			variant="sm"
		>
			<x-narsil::ui.section.root
				class="animate-in fade-in-0 slide-in-from-bottom-10 py-4"
			>
				<x-narsil::ui.section.header>
					<x-narsil::ui.heading.root
						level="h1"
						variant="h4"
					>
						{{ $title }}
					</x-narsil::ui.heading.root>
				</x-narsil::ui.section.header>
				<x-narsil::ui.section.content>
					<x-narsil::ui.card.root
						class="max-w-md"
					>
						<x-narsil::ui.card.content>
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
								<x-narsil::ui.button.root
									type="submit"
								>
									{{ trans('narsil::ui.send_again') }}
								</x-narsil::ui.button.root>
							</form>
						</x-narsil::ui.card.content>
					</x-narsil::ui.card.root>
				</x-narsil::ui.section.content>
			</x-narsil::ui.section.root>
		</x-narsil::ui.container.root>
	</main>
@endsection
