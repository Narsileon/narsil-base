<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Pagination;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class PaginationItem extends Component
{
    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.pagination.pagination-item');
    }

    #endregion
}
