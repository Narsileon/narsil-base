<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Tabs;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class TabsRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $orientation
     *
     * @return void
     */
    public function __construct(
        mixed $orientation = 'horizontal'
    )
    {
        $this->orientation = $orientation;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $orientation;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.tabs.tabs-root');
    }

    #endregion
}
