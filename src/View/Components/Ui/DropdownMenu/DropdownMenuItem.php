<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\DropdownMenu;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DropdownMenuItem extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $href
     * @param mixed $inset
     * @param mixed $variant
     * @param string $type
     *
     * @return void
     */
    public function __construct(
        mixed $href = null,
        mixed $inset = false,
        mixed $variant = 'default',
        string $type = 'button'
    )
    {
        $this->href = $href;
        $this->inset = $inset;
        $this->tag = $this->getTag($href);
        $this->type = $type;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $href;

    /**
     * @var mixed
     */
    public readonly mixed $inset;

    /**
     * @var string
     */
    public readonly string $tag;

    /**
     * @var string
     */
    public readonly string $type;

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
        return view('narsil::components.ui.dropdown-menu.dropdown-menu-item');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $href
     *
     * @return string
     */
    private function getTag(mixed $href): string
    {
        return $href ? 'a' : 'button';
    }

    #endregion
}
