<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Tabs;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class TabsList extends Component
{
    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.tabs.tabs-list');
    }

    #endregion
}
