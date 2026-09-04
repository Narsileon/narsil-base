<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Select;

#region USE

use Illuminate\Support\Str;
use Illuminate\View\Component;

#endregion

final class SelectRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param boolean $clearable
     * @param boolean $disabled
     * @param boolean $displayValue
     * @param string|null $id
     * @param string|null $model
     * @param boolean $multiple
     * @param string|null $name
     * @param array<int,mixed> $options
     * @param string|null $placeholder
     * @param boolean $required
     * @param string $size
     * @param string $variant
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
        ?string $name = null,
        array $options = [],
        ?string $placeholder = null,
        bool $required = false,
        string $size = 'default',
        string $variant = 'default',
        mixed $value = null,
    )
    {
        $this->clearable = $clearable;
        $this->disabled = $disabled;
        $this->displayValue = $displayValue;
        $this->dropdownId = (string) Str::uuid();
        $this->id = $id;
        $this->model = $model;
        $this->multiple = $multiple;
        $this->name = $name;
        $this->normalizedOptions = $this->normalizeOptions($options);
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->selected = $this->findSelected($this->normalizedOptions, $value);
        $this->size = $size;
        $this->value = $value;
        $this->variant = $variant;
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
     * @var string|null
     */
    public readonly ?string $model;

    /**
     * @var boolean
     */
    public readonly bool $multiple;

    /**
     * @var string|null
     */
    public readonly ?string $name;

    /**
     * @var array<int,array<string,string>>
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

    /**
     * @var array<string,string>|null
     */
    public readonly ?array $selected;

    /**
     * @var string
     */
    public readonly string $size;

    /**
     * @var mixed
     */
    public readonly mixed $value;

    /**
     * @var string
     */
    public readonly string $variant;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return string
     */
    public function render(): string
    {
        return 'narsil::components.blocks.select.select-root';
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param array<int,array<string,string>> $options
     * @param mixed $value
     *
     * @return array<string,string>|null
     */
    private function findSelected(array $options, mixed $value): ?array
    {
        foreach ($options as $option)
        {
            if ((string) $option['value'] === (string) $value)
            {
                return $option;
            }
        }

        return null;
    }

    /**
     * @param array<int,mixed> $options
     *
     * @return array<int,array<string,string>>
     */
    private function normalizeOptions(array $options): array
    {
        $normalizedOptions = [];

        foreach ($options as $option)
        {
            $value = is_array($option) ? ($option['value'] ?? '') : ($option->value ?? '');
            $label = is_array($option) ? ($option['label'] ?? $value) : ($option->label ?? $value);

            $normalizedOptions[] = [
                'label' => (string) $label,
                'value' => (string) $value,
            ];
        }

        return $normalizedOptions;
    }

    #endregion
}
