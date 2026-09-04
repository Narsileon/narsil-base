<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\ToggleGroup;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ToggleGroupRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $orientation
     * @param mixed $selected
     * @param mixed $size
     * @param mixed $spacing
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $orientation = 'horizontal',
        mixed $selected = '',
        mixed $size = null,
        mixed $spacing = 0,
        mixed $variant = null
    )
    {
        $this->orientation = $orientation;
        $this->selected = $selected;
        $this->size = $size;
        $this->spacing = $spacing;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $orientation;

    /**
     * @var mixed
     */
    public readonly mixed $selected;

    /**
     * @var mixed
     */
    public readonly mixed $size;

    /**
     * @var mixed
     */
    public readonly mixed $spacing;

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
        return view('narsil::components.ui.toggle-group.toggle-group-root');
    }

    #endregion
}
