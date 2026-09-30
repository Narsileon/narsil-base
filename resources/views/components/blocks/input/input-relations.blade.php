<livewire:narsil-input-relations
	:input-id="$id"
	:input="$input"
	:key="'relations-' . $id"
	:languages="$languages"
	{{ $attributes->twMerge() }}
	:value="$value"
/>
