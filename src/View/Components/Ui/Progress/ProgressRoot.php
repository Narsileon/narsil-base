<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Progress;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ProgressRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $max
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $max = 100,
        mixed $value = 0
    )
    {
        $this->max = $max;
        $this->value = $value;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $max;

    /**
     * @var mixed
     */
    public readonly mixed $value;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.progress.progress-root');
    }

    #endregion
}
