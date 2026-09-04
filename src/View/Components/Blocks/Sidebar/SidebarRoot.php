<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sidebar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SidebarRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $sidebar
     * @param mixed $name
     * @param mixed $navigation
     *
     * @return void
     */
    public function __construct(
        mixed $sidebar = [],
        mixed $name = 'cms',
        mixed $navigation = []
    )
    {
        $this->sidebar = $sidebar;
        $this->name = $name;
        $this->navigation = $navigation;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $name;

    /**
     * @var mixed
     */
    public readonly mixed $navigation;

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
        return view('narsil::components.blocks.sidebar.sidebar-root');
    }

    #endregion
}
