<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Popover;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class PopoverPositioner extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $align
     * @param mixed $side
     * @param integer $sideOffset
     *
     * @return void
     */
    public function __construct(
        mixed $align = 'center',
        mixed $side = 'bottom',
        int $sideOffset = 4
    )
    {
        $this->align = $align;
        $this->side = $side;
        $this->sideOffset = $sideOffset;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $align;

    /**
     * @var mixed
     */
    public readonly mixed $side;

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
        return view('narsil::components.ui.popover.popover-positioner');
    }

    #endregion
}
