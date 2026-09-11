<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sidebar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SidebarGroupLabel extends Component
{
    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.sidebar.sidebar-group-label');
    }

    #endregion
}
