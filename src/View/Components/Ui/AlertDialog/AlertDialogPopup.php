<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\AlertDialog;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class AlertDialogPopup extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $size
     *
     * @return void
     */
    public function __construct(
        mixed $size = 'default'
    )
    {
        $this->size = $size;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $size;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.alert-dialog.alert-dialog-popup');
    }

    #endregion
}
