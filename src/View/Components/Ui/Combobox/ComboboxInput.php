<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Combobox;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ComboboxInput extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $placeholder
     *
     * @return void
     */
    public function __construct(
        mixed $placeholder = null
    )
    {
        $this->placeholder = $placeholder;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $placeholder;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.combobox.combobox-input');
    }

    #endregion
}
