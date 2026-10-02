<a
	{{ $attributes->twMerge('text-primary inline-flex items-center gap-2 font-semibold tracking-tight') }}
	aria-label="Narsil"
	data-slot="logo-root"
	href="{{ url('/') }}"
>
	{{ $slot }}
</a>
