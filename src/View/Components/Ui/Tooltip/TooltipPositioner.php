<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Tooltip;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class TooltipPositioner extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $side
     * @param integer $sideOffset
     *
     * @return void
     */
    public function __construct(
        string $side = 'top',
        int $sideOffset = 4
    )
    {
        $this->side = $side;
        $this->sideOffset = $sideOffset;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $side;

    /**
     * @var integer
     */
    public readonly int $sideOffset;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.tooltip.tooltip-positioner');
    }

    #endregion
}
