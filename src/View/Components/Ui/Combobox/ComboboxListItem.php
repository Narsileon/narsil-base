<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Combobox;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ComboboxListItem extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $label
     * @param mixed $value
     * @param mixed $displayValue
     * @param mixed $icon
     *
     * @return void
     */
    public function __construct(
        mixed $label,
        mixed $value,
        mixed $displayValue = true,
        mixed $icon = null
    )
    {
        $this->label = $label;
        $this->value = $value;
        $this->displayValue = $displayValue;
        $this->icon = $icon;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $displayValue;

    /**
     * @var mixed
     */
    public readonly mixed $icon;

    /**
     * @var mixed
     */
    public readonly mixed $label;

    /**
     * @var mixed
     */
    public readonly mixed $value;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.combobox.combobox-list-item');
    }

    #endregion
}
