@props(['messages' => []])

<x-narsil::ui.toast.portal>
	<x-narsil::ui.toast.viewport>
		@foreach ($messages as $type => $message)
			@if ($message)
				<x-narsil::ui.toast.root
					x-init="setTimeout(() => open = false, 5000)"
				>
					<x-narsil::ui.toast.content>
						<x-narsil::ui.item.root>
							<x-narsil::ui.item.media
								variant="icon"
							>
								@switch ($type)
									@case('success')
										<x-narsil::ui.icon.root
											name="circle-check"
										/>
									@break

									@case('warning')
										<x-narsil::ui.icon.root
											name="warning"
										/>
									@break

									@case('error')
										<x-narsil::ui.icon.root
											name="circle-x"
										/>
									@break

									@default
										<x-narsil::ui.icon.root
											name="info"
										/>
								@endswitch
							</x-narsil::ui.item.media>
							<x-narsil::ui.item.content>
								<x-narsil::ui.toast.description>
									{{ $message }}
								</x-narsil::ui.toast.description>
							</x-narsil::ui.item.content>
							<x-narsil::ui.item.actions>
								<x-narsil::ui.toast.close />
							</x-narsil::ui.item.actions>
						</x-narsil::ui.item.root>
					</x-narsil::ui.toast.content>
				</x-narsil::ui.toast.root>
			@endif
		@endforeach
	</x-narsil::ui.toast.viewport>
</x-narsil::ui.toast.portal>
