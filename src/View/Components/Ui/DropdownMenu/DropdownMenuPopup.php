<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\DropdownMenu;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DropdownMenuPopup extends Component
{
    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.dropdown-menu.dropdown-menu-popup');
    }

    #endregion
}
