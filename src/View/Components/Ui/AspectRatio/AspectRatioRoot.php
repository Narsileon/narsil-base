<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\AspectRatio;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class AspectRatioRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $ratio
     *
     * @return void
     */
    public function __construct(
        mixed $ratio
    )
    {
        $this->ratio = $ratio;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $ratio;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.aspect-ratio.aspect-ratio-root');
    }

    #endregion
}
