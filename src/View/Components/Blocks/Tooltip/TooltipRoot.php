<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Tooltip;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class TooltipRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $tooltip
     * @param mixed $delay
     * @param mixed $side
     * @param mixed $sideOffset
     *
     * @return void
     */
    public function __construct(
        mixed $tooltip,
        mixed $delay = 300,
        mixed $side = 'top',
        mixed $sideOffset = 4
    )
    {
        $this->tooltip = $tooltip;
        $this->delay = $delay;
        $this->side = $side;
        $this->sideOffset = $sideOffset;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $delay;

    /**
     * @var mixed
     */
    public readonly mixed $side;

    /**
     * @var mixed
     */
    public readonly mixed $sideOffset;

    /**
     * @var mixed
     */
    public readonly mixed $tooltip;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.tooltip.tooltip-root');
    }

    #endregion
}
