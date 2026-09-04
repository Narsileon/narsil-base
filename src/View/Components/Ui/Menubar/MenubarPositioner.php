<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Menubar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class MenubarPositioner extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $align
     * @param mixed $alignOffset
     * @param mixed $side
     * @param mixed $sideOffset
     *
     * @return void
     */
    public function __construct(
        mixed $align = 'start',
        mixed $alignOffset = -4,
        mixed $side = 'bottom',
        mixed $sideOffset = 8
    )
    {
        $this->align = $align;
        $this->alignOffset = $alignOffset;
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
    public readonly mixed $alignOffset;

    /**
     * @var mixed
     */
    public readonly mixed $side;

    /**
     * @var mixed
     */
    public readonly mixed $sideOffset;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.menubar.menubar-positioner');
    }

    #endregion
}
