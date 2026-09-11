<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sortable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SortableItemMenu extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $id
     *
     * @return void
     */
    public function __construct(
        mixed $id
    )
    {
        $this->id = $id;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $id;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.sortable.sortable-item-menu');
    }

    #endregion
}
