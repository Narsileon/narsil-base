<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Slider;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SliderRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $name
     * @param mixed $max
     * @param mixed $min
     * @param mixed $step
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $name,
        mixed $max = 100,
        mixed $min = 0,
        mixed $step = 1,
        mixed $value = 0
    )
    {
        $this->name = $name;
        $this->max = $max;
        $this->min = $min;
        $this->step = $step;
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
    public readonly mixed $min;

    /**
     * @var mixed
     */
    public readonly mixed $name;

    /**
     * @var mixed
     */
    public readonly mixed $step;

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
        return view('narsil::components.ui.slider.slider-root');
    }

    #endregion
}
