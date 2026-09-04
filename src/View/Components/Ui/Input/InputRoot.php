<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $type
     *
     * @return void
     */
    public function __construct(
        mixed $type = 'text'
    )
    {
        $this->type = $type;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $type;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.input.input-root');
    }

    #endregion
}
