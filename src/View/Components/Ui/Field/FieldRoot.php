<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Field;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FieldRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $orientation
     * @param mixed $width
     *
     * @return void
     */
    public function __construct(
        mixed $orientation = 'vertical',
        mixed $width = 100
    )
    {
        $this->orientation = $orientation;
        $this->width = $width;
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
    public readonly mixed $width;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.field.field-root');
    }

    #endregion
}
