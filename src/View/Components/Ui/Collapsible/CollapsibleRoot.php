<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Collapsible;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class CollapsibleRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $open
     *
     * @return void
     */
    public function __construct(
        mixed $open = false
    )
    {
        $this->open = $open;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $open;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.collapsible.collapsible-root');
    }

    #endregion
}
