<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Toggle;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ToggleRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $pressed
     * @param mixed $size
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $pressed = false,
        mixed $size = 'default',
        mixed $variant = 'default'
    )
    {
        $this->pressed = $pressed;
        $this->size = $size;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $pressed;

    /**
     * @var mixed
     */
    public readonly mixed $size;

    /**
     * @var mixed
     */
    public readonly mixed $variant;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.toggle.toggle-root');
    }

    #endregion
}
