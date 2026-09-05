<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Popover;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class PopoverTrigger extends Component
{
    #region CONSTRUCTOR

    /**
     * @param boolean $asChild
     *
     * @return void
     */
    public function __construct(
        bool $asChild = false
    )
    {
        $this->asChild = $asChild;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var boolean
     */
    public readonly bool $asChild;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.popover.popover-trigger');
    }

    #endregion
}
