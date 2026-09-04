<span
	{{ $attributes->twMerge('flex size-5 items-center justify-center [&>svg]:size-4') }}
	aria-hidden="true"
	data-slot="breadcrumb-ellipsis"
	role="presentation"
>
	{{ $slot }}
	<span
		class="sr-only"
	>
		{{ trans('narsil::pagination.more') }}
	</span>
</span>
