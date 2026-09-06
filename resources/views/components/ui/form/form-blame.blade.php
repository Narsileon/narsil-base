@if ($createdAt || $updatedAt)
	<div
		class="grid gap-2"
	>
		@if ($createdAt)
			<x-narsil::ui.form.form-blame-item
				:date="$createdAt"
				:label="trans('narsil::blame.created')"
				:name="$creator"
			/>
		@endif
		@if ($updatedAt)
			<x-narsil::ui.form.form-blame-item
				:date="$updatedAt"
				:label="trans('narsil::blame.updated')"
				:name="$editor"
			/>
		@endif
	</div>
@endif
