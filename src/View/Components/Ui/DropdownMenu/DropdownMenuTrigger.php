<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\DropdownMenu;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DropdownMenuTrigger extends Component
{
    #region CONSTRUCTOR

    /**
     * @param boolean $asChild
     * @param string $size
     * @param string $variant
     *
     * @return void
     */
    public function __construct(
        bool $asChild = false,
        string $size = 'default',
        string $variant = 'ghost'
    )
    {
        $this->asChild = $asChild;
        $this->size = $size;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var boolean
     */
    public readonly bool $asChild;

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
        return view('narsil::components.ui.dropdown-menu.dropdown-menu-trigger');
    }

    #endregion
}
