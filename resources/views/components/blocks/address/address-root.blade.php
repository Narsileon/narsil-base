<x-narsil::ui.address.address-root
	{{ $attributes }}
>
	<x-narsil::ui.address.address-line-first>
		{{ $street }}
	</x-narsil::ui.address.address-line-first>
	<x-narsil::ui.address.address-line-second>
		{{ $postalCode }} {{ $city }} - {{ $country }}
	</x-narsil::ui.address.address-line-second>
	{{ $slot }}
</x-narsil::ui.address.address-root>
