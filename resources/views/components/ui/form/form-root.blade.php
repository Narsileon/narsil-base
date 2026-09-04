
<form
	{{ $attributes->twMerge('grid')->merge(['action' => $action, 'enctype' => $enctype, 'method' => 'post']) }}
	@if ($id) id="{{ $id }}" @endif
>
	@csrf
	@if (strtoupper($method) !== 'POST')
		@method($method)
	@endif
	@if ($token)
		<input
			name="token"
			type="hidden"
			value="{{ $token }}"
		>
	@endif
	{{ $slot }}
</form>
