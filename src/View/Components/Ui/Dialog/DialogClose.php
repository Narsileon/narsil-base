<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Dialog;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DialogClose extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $size
     * @param string $variant
     *
     * @return void
     */
    public function __construct(
        string $size = 'default',
        string $variant = 'ghost'
    )
    {
        $this->size = $size;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $size;

    /**
     * @var string
     */
    public readonly string $variant;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.dialog.dialog-close');
    }

    #endregion
}
