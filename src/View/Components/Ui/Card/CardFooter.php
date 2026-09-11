<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Card;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class CardFooter extends Component
{
    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.card.card-footer');
    }

    #endregion
}
