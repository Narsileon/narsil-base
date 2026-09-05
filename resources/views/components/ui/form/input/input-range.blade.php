
<x-narsil::ui.slider.slider-root
	:max="$input->max ?? 100"
	:min="$input->min ?? 0"
	:name="$id"
	:step="$input->step ?? 1"
	:value="$value"
/>
