<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Checkboxes;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class CheckboxesRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $disabled
     * @param mixed $id
     * @param mixed $name
     * @param mixed $options
     * @param mixed $values
     *
     * @return void
     */
    public function __construct(
        mixed $disabled = false,
        mixed $id = null,
        mixed $name = null,
        mixed $options = [],
        mixed $values = [],
    )
    {
        $this->disabled = $disabled;
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
        $this->optionValues = $this->getOptionValues($options);
        $this->selectedValues = $this->getSelectedValues($values);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $disabled;

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $name;

    /**
     * @var string[]
     */
    public readonly array $optionValues;

    /**
     * @var mixed
     */
    public readonly mixed $options;

    /**
     * @var string[]
     */
    public readonly array $selectedValues;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.checkboxes.checkboxes-root');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $options
     *
     * @return string[]
     */
    private function getOptionValues(mixed $options): array
    {
        $values = [];

        foreach ((array) $options as $option)
        {
            $optionValue = data_get($option, 'value');
            $optionValues = is_array($optionValue) ? $optionValue : [$optionValue];

            foreach ($optionValues as $value)
            {
                $value = (string) $value;

                if (!in_array($value, $values, true))
                {
                    $values[] = $value;
                }
            }
        }

        return $values;
    }

    /**
     * @param mixed $values
     *
     * @return string[]
     */
    private function getSelectedValues(mixed $values): array
    {
        $selectedValues = [];

        if (!is_iterable($values))
        {
            $values = [];
        }

        foreach ($values as $value)
        {
            $value = data_get(
                $value,
                'id',
                data_get($value, 'uuid', $value),
            );
            $value = (string) $value;

            if (!in_array($value, $selectedValues, true))
            {
                $selectedValues[] = $value;
            }
        }

        return $selectedValues;
    }

    #endregion
}
