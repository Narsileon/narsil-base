<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\DropdownMenu;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DropdownMenuPositioner extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $align
     *
     * @return void
     */
    public function __construct(
        mixed $align = 'start'
    )
    {
        $this->align = $align;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $align;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.dropdown-menu.dropdown-menu-positioner');
    }

    #endregion
}
