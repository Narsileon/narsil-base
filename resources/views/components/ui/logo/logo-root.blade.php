<a
	aria-label="Narsil"
	{{ $attributes->twMerge('text-primary inline-flex items-center gap-2 font-semibold tracking-tight') }}
	data-slot="logo-root"
	href="{{ url('/') }}"
>
	{{ $slot }}
</a>
