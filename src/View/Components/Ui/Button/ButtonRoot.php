<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Button;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ButtonRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $size
     * @param mixed $type
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $size = 'default',
        mixed $type = 'button',
        mixed $variant = 'primary'
    )
    {
        $this->size = $size;
        $this->type = $type;
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
    public readonly mixed $type;

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
        return view('narsil::components.ui.button.button-root');
    }

    #endregion
}
