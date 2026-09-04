<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Dialog;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DialogPopup extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $showCloseButton
     *
     * @return void
     */
    public function __construct(
        mixed $showCloseButton = true
    )
    {
        $this->showCloseButton = $showCloseButton;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $showCloseButton;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.dialog.dialog-popup');
    }

    #endregion
}
