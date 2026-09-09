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
     * @param string|null $fetchRoute
     * @param array<string,mixed> $fetchParams
     * @param string|null $id
     * @param integer $minSearchLength
     * @param string|null $model
     * @param boolean $multiple
     * @param string $name
     * @param array<int,mixed> $options
     * @param string|null $placeholder
     * @param boolean $renderLabel
     * @param boolean $required
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        bool $clearable = false,
        bool $disabled = false,
        bool $displayValue = true,
        ?string $fetchRoute = null,
        array $fetchParams = [],
        ?string $id = null,
        int $minSearchLength = 3,
        ?string $model = null,
        bool $multiple = false,
        string $name = '',
        array $options = [],
        ?string $placeholder = null,
        bool $renderLabel = false,
        bool $required = false,
        mixed $value = null,
    )
    {
        $this->clearable = $clearable;
        $this->disabled = $disabled;
        $this->displayValue = $displayValue;
        $this->dropdownId = $this->getDropdownId($id);
        $this->fetchUrl = $this->getFetchUrl($fetchRoute, $fetchParams);
        $this->id = $id;
        $this->initialValue = $this->normalizeValue($multiple, $value);
        $this->minSearchLength = $minSearchLength;
        $this->model = $model;
        $this->multiple = $multiple;
        $this->name = $name;
        $this->normalizedOptions = $this->normalizeOptions($options);
        $this->placeholder = $this->normalizePlaceholder($placeholder);
        $this->renderLabel = $renderLabel;
        $this->required = $required;
        $this->virtualized = $this->isVirtualized($this->normalizedOptions);
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
    public readonly ?string $fetchUrl;

    /**
     * @var string|null
     */
    public readonly ?string $id;

    /**
     * @var array<int,string>|string
     */
    public readonly array|string $initialValue;

    /**
     * @var integer
     */
    public readonly int $minSearchLength;

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
    public readonly bool $renderLabel;

    /**
     * @var boolean
     */
    public readonly bool $required;

    /**
     * @var boolean
     */
    public readonly bool $virtualized;

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
     * @param string|null $id
     *
     * @return string
     */
    private function getDropdownId(?string $id): string
    {
        if (str_contains((string) $id, '__ARRAY_INDEX__') || str_contains((string) $id, '__ROW__'))
        {
            return 'dropdown-' . $id;
        }

        return (string) Str::uuid();
    }

    /**
     * @param string|null $fetchRoute
     * @param array<string,mixed> $fetchParams
     *
     * @return string|null
     */
    private function getFetchUrl(?string $fetchRoute, array $fetchParams): ?string
    {
        $fetchUrl = null;

        if (filled($fetchRoute))
        {
            $fetchUrl = route($fetchRoute, $fetchParams);
        }

        return $fetchUrl;
    }

    /**
     * @param array<int,array<string,mixed>> $options
     *
     * @return boolean
     */
    private function isVirtualized(array $options): bool
    {
        return count($options) > 50;
    }

    /**
     * @param mixed $label
     * @param mixed $value
     *
     * @return string
     */
    private function normalizeOptionLabel(mixed $label, mixed $value): string
    {
        if (is_array($label) || is_object($label))
        {
            $translations = (array) $label;
            $label = $translations[app()->getLocale()] ?? reset($translations);
        }

        if ($label === null || $label === '')
        {
            $label = $value;
        }

        return (string) $label;
    }

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
            $searchLabel = is_array($option) ? ($option['searchLabel'] ?? $label) : ($option->searchLabel ?? $label);
            $normalizedLabel = $this->normalizeOptionLabel($label, $value);
            $normalizedSearchLabel = $this->normalizeOptionLabel($searchLabel, $value);

            $normalizedOptions[] = [
                'label' => $normalizedLabel,
                'searchLabel' => strip_tags($normalizedSearchLabel),
                'value' => (string) $value,
            ];
        }

        return $normalizedOptions;
    }

    /**
     * @param string|null $placeholder
     *
     * @return string|null
     */
    private function normalizePlaceholder(?string $placeholder): ?string
    {
        return filled($placeholder) ? $placeholder : null;
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
