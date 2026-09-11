<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Toast;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ToastViewport extends Component
{
    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.toast.toast-viewport');
    }

    #endregion
}
