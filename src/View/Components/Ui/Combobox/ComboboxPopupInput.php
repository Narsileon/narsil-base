<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Combobox;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ComboboxPopupInput extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $clearable
     * @param mixed $disabled
     *
     * @return void
     */
    public function __construct(
        mixed $clearable = false,
        mixed $disabled = false
    )
    {
        $this->clearable = $clearable;
        $this->disabled = $disabled;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $clearable;

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
        return view('narsil::components.ui.combobox.combobox-popup-input');
    }

    #endregion
}
