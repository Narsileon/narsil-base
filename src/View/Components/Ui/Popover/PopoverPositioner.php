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
     *
     * @return void
     */
    public function __construct(
        mixed $align = 'center',
        mixed $side = 'bottom'
    )
    {
        $this->align = $align;
        $this->side = $side;
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
