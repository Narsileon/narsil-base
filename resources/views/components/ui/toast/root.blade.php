@props(['message', 'type' => 'success'])

<div
	{{ $attributes->twMerge('fixed right-4 bottom-4 z-[1000] w-[min(calc(100%-2rem),24rem)]')->merge(['role' => 'status']) }}
	x-data="{ open: true }"
	x-init="setTimeout(() => open = false, 5000)"
	x-show="open"
	x-transition:enter-end="translate-y-0 opacity-100"
	x-transition:enter-start="translate-y-2 opacity-0"
	x-transition:enter="transition duration-300 ease-out"
	x-transition:leave-end="translate-y-2 opacity-0"
	x-transition:leave-start="translate-y-0 opacity-100"
	x-transition:leave="transition duration-200 ease-in"
>
	<div
		class="bg-popover text-popover-foreground flex items-start gap-3 rounded-lg border p-4 shadow-lg"
	>
		<x-narsil::ui.icon.root
			:name="$type === 'success' ? 'check' : 'x'"
			class="mt-0.5 size-4 shrink-0"
		/>
		<p
			class="min-w-0 grow text-sm"
		>
			{{ $message }}
		</p>
		<button
			aria-label="{{ trans('narsil::ui.close') }}"
			class="hover:bg-accent inline-flex size-7 shrink-0 cursor-pointer items-center justify-center rounded-md"
			type="button"
			x-on:click="open = false"
		>
			<x-narsil::ui.icon.root
				class="size-4"
				name="x"
			/>
		</button>
	</div>
</div>
