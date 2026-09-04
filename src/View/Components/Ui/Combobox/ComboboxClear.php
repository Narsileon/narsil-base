<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Combobox;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ComboboxClear extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $disabled
     *
     * @return void
     */
    public function __construct(
        mixed $disabled = false
    )
    {
        $this->disabled = $disabled;
    }

    #endregion

    #region PROPERTIES

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
        return view('narsil::components.ui.combobox.combobox-clear');
    }

    #endregion
}
