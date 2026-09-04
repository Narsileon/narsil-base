<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\DropdownMenu;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DropdownMenuItem extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $href
     * @param mixed $inset
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $href = null,
        mixed $inset = false,
        mixed $variant = 'default'
    )
    {
        $this->href = $href;
        $this->inset = $inset;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $href;

    /**
     * @var mixed
     */
    public readonly mixed $inset;

    /**
     * @var mixed
     */
    public readonly mixed $variant;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.dropdown-menu.dropdown-menu-item');
    }

    #endregion
}
