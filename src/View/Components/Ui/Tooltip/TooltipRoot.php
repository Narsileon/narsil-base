<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Tooltip;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class TooltipRoot extends Component
{
    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.tooltip.tooltip-root');
    }

    #endregion
}
