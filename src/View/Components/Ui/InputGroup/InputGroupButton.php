<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\InputGroup;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputGroupButton extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $size
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $size = 'sm',
        mixed $variant = 'ghost'
    )
    {
        $this->size = $size;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

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
        return view('narsil::components.ui.input-group.input-group-button');
    }

    #endregion
}
