<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\ContextMenu;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ContextMenuItem extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $inset
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $inset = false,
        mixed $variant = 'default'
    )
    {
        $this->inset = $inset;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

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
        return view('narsil::components.ui.context-menu.context-menu-item');
    }

    #endregion
}
