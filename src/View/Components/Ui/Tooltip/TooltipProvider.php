<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Tooltip;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class TooltipProvider extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $delay
     *
     * @return void
     */
    public function __construct(
        mixed $delay = 0
    )
    {
        $this->delay = $delay;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $delay;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.tooltip.tooltip-provider');
    }

    #endregion
}
