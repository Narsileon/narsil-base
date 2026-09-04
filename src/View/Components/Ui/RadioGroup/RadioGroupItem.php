<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\RadioGroup;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class RadioGroupItem extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $name
     * @param mixed $value
     * @param mixed $checked
     * @param mixed $disabled
     * @param mixed $required
     *
     * @return void
     */
    public function __construct(
        mixed $name,
        mixed $value,
        mixed $checked = false,
        mixed $disabled = false,
        mixed $required = false
    )
    {
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->disabled = $disabled;
        $this->required = $required;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $checked;

    /**
     * @var mixed
     */
    public readonly mixed $disabled;

    /**
     * @var mixed
     */
    public readonly mixed $name;

    /**
     * @var mixed
     */
    public readonly mixed $required;

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
        return view('narsil::components.ui.radio-group.radio-group-item');
    }

    #endregion
}
