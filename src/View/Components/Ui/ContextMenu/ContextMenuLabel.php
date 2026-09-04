<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\ContextMenu;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ContextMenuLabel extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $inset
     *
     * @return void
     */
    public function __construct(
        mixed $inset = false
    )
    {
        $this->inset = $inset;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $inset;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.context-menu.context-menu-label');
    }

    #endregion
}
