<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Combobox;

#region USE

use Illuminate\Support\Str;
use Illuminate\View\Component;

#endregion

final class ComboboxRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param boolean $clearable
     * @param boolean $disabled
     * @param boolean $displayValue
     * @param string|null $id
     * @param string|null $model
     * @param boolean $multiple
     * @param string $name
     * @param array<int,mixed> $options
     * @param string|null $placeholder
     * @param boolean $required
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        bool $clearable = false,
        bool $disabled = false,
        bool $displayValue = true,
        ?string $id = null,
        ?string $model = null,
        bool $multiple = false,
        string $name = '',
        array $options = [],
        ?string $placeholder = null,
        bool $required = false,
        mixed $value = null,
    )
    {
        $this->clearable = $clearable;
        $this->disabled = $disabled;
        $this->displayValue = $displayValue;
        $this->dropdownId = (string) Str::uuid();
        $this->id = $id;
        $this->initialValue = $this->normalizeValue($multiple, $value);
        $this->model = $model;
        $this->multiple = $multiple;
        $this->name = $name;
        $this->normalizedOptions = $this->normalizeOptions($options);
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var boolean
     */
    public readonly bool $clearable;

    /**
     * @var boolean
     */
    public readonly bool $disabled;

    /**
     * @var boolean
     */
    public readonly bool $displayValue;

    /**
     * @var string
     */
    public readonly string $dropdownId;

    /**
     * @var string|null
     */
    public readonly ?string $id;

    /**
     * @var array<int,string>|string
     */
    public readonly array|string $initialValue;

    /**
     * @var string|null
     */
    public readonly ?string $model;

    /**
     * @var boolean
     */
    public readonly bool $multiple;

    /**
     * @var string
     */
    public readonly string $name;

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $normalizedOptions;

    /**
     * @var string|null
     */
    public readonly ?string $placeholder;

    /**
     * @var boolean
     */
    public readonly bool $required;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return string
     */
    public function render(): string
    {
        return 'narsil::components.blocks.combobox.combobox-root';
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param array<int,mixed> $options
     *
     * @return array<int,array<string,mixed>>
     */
    private function normalizeOptions(array $options): array
    {
        $normalizedOptions = [];

        foreach ($options as $option)
        {
            $value = is_array($option) ? ($option['value'] ?? '') : ($option->value ?? '');
            $label = is_array($option) ? ($option['label'] ?? $value) : ($option->label ?? $value);
            $icon = is_array($option) ? ($option['icon'] ?? null) : ($option->icon ?? null);

            $normalizedOptions[] = [
                'icon' => $icon,
                'label' => strip_tags((string) $label),
                'value' => (string) $value,
            ];
        }

        return $normalizedOptions;
    }

    /**
     * @param boolean $multiple
     * @param mixed $value
     *
     * @return array<int,string>|string
     */
    private function normalizeValue(bool $multiple, mixed $value): array|string
    {
        if (!$multiple)
        {
            return (string) ($value ?? '');
        }

        if (is_array($value))
        {
            return array_map('strval', $value);
        }

        if ($value)
        {
            return [(string) $value];
        }

        return [];
    }

    #endregion
}
