<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ColorLabel extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $color
     * @param mixed $label
     *
     * @return void
     */
    public function __construct(
        mixed $color,
        mixed $label
    )
    {
        $this->color = $color;
        $this->label = $label;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $color;

    /**
     * @var mixed
     */
    public readonly mixed $label;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.color-label');
    }

    #endregion
}
