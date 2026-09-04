<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\ContextMenu;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ContextMenuCheckboxItem extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $checked
     *
     * @return void
     */
    public function __construct(
        mixed $checked = false
    )
    {
        $this->checked = $checked;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $checked;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.context-menu.context-menu-checkbox-item');
    }

    #endregion
}
