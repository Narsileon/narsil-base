<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Combobox;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ComboboxItemIndicator extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $value
    )
    {
        $this->value = $value;
    }

    #endregion

    #region PROPERTIES

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
        return view('narsil::components.ui.combobox.combobox-item-indicator');
    }

    #endregion
}
