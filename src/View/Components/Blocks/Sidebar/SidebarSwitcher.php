<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sidebar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SidebarSwitcher extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $items
     *
     * @return void
     */
    public function __construct(
        mixed $items = []
    )
    {
        $this->items = $items;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $items;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.sidebar.sidebar-switcher');
    }

    #endregion
}
