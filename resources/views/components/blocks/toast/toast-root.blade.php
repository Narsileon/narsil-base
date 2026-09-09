<x-narsil::ui.toast.toast-portal>
	<x-narsil::ui.toast.toast-viewport>
		@foreach ($messages as $type => $message)
			@if ($message)
				<x-narsil::ui.toast.toast-root
					x-init="setTimeout(() => toastOpen = false, 5000)"
				>
					<x-narsil::ui.toast.toast-content>
						<x-narsil::ui.item.item-root>
							<x-narsil::ui.item.item-media
								variant="icon"
							>
								@switch ($type)
									@case('success')
										<x-narsil::ui.icon.icon-root
											name="fa-regular-circle-check"
										/>
									@break

									@case('warning')
										<x-narsil::ui.icon.icon-root
											name="fa-solid-warning"
										/>
									@break

									@case('error')
										<x-narsil::ui.icon.icon-root
											name="fa-regular-circle-xmark"
										/>
									@break

									@default
										<x-narsil::ui.icon.icon-root
											name="fa-solid-info"
										/>
								@endswitch
							</x-narsil::ui.item.item-media>
							<x-narsil::ui.item.item-content>
								<x-narsil::ui.toast.toast-description>
									{{ $message }}
								</x-narsil::ui.toast.toast-description>
							</x-narsil::ui.item.item-content>
							<x-narsil::ui.item.item-actions>
								<x-narsil::ui.toast.toast-close />
							</x-narsil::ui.item.item-actions>
						</x-narsil::ui.item.item-root>
					</x-narsil::ui.toast.toast-content>
				</x-narsil::ui.toast.toast-root>
			@endif
		@endforeach
	</x-narsil::ui.toast.toast-viewport>
</x-narsil::ui.toast.toast-portal>
