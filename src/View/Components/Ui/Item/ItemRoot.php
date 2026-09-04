<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Item;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ItemRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $size
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $size = 'default',
        mixed $variant = 'default'
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
        return view('narsil::components.ui.item.item-root');
    }

    #endregion
}
