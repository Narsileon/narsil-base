<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Fieldset;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FieldsetRoot extends Component
{
    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.fieldset.fieldset-root');
    }

    #endregion
}
