<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sidebar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SidebarProvider extends Component
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        $this->sidebarOpen = $this->resolveSidebarOpen();
    }

    #endregion

    #region PROPERTIES

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
        return view('narsil::components.blocks.sidebar.sidebar-provider');
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
