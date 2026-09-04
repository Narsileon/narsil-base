<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Field;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FieldLabel extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $required
     *
     * @return void
     */
    public function __construct(
        mixed $required = false
    )
    {
        $this->required = $required;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $required;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.field.field-label');
    }

    #endregion
}
