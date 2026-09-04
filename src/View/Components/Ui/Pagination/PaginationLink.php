<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Pagination;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class PaginationLink extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $active
     * @param mixed $disabled
     * @param mixed $href
     * @param mixed $size
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $active = false,
        mixed $disabled = false,
        mixed $href = null,
        mixed $size = 'icon',
        mixed $variant = 'outline'
    )
    {
        $this->active = $active;
        $this->disabled = $disabled;
        $this->href = $href;
        $this->size = $size;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $active;

    /**
     * @var mixed
     */
    public readonly mixed $disabled;

    /**
     * @var mixed
     */
    public readonly mixed $href;

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
        return view('narsil::components.ui.pagination.pagination-link');
    }

    #endregion
}
