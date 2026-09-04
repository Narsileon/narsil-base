<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sidebar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SidebarContent extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $sidebar
     *
     * @return void
     */
    public function __construct(
        mixed $sidebar = []
    )
    {
        $this->sidebar = $sidebar;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $sidebar;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.sidebar.sidebar-content');
    }

    #endregion
}
