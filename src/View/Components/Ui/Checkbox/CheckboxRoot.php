<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Checkbox;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class CheckboxRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $checked
     * @param mixed $disabled
     *
     * @return void
     */
    public function __construct(
        mixed $checked = false,
        mixed $disabled = false
    )
    {
        $this->checked = $checked;
        $this->disabled = $disabled;
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

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.checkbox.checkbox-root');
    }

    #endregion
}
