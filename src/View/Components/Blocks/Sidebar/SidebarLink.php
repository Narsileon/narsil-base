<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sidebar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SidebarLink extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $item
     *
     * @return void
     */
    public function __construct(
        mixed $item
    )
    {
        $this->item = $item;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $item;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.sidebar.sidebar-link');
    }

    #endregion
}
