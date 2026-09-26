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
     * @param bool|null $sidebarOpen
     *
     * @return void
     */
    public function __construct(
        mixed $sidebar = [],
        mixed $name = 'cms',
        mixed $navigation = [],
        ?bool $sidebarOpen = null
    ) {
        $this->sidebar = $sidebar;
        $this->name = $name;
        $this->navigation = $navigation;
        $this->sidebarOpen = $sidebarOpen ?? $this->resolveSidebarOpen();
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

    /**
     * @var bool
     */
    public readonly bool $sidebarOpen;

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

    #region PRIVATE METHODS

    /**
     * @return bool
     */
    private function resolveSidebarOpen(): bool
    {
        $sidebarState = request()->cookie('sidebar_state', 'true');
        $sidebarOpen = $sidebarState === 'true';

        return $sidebarOpen;
    }

    #endregion
}
