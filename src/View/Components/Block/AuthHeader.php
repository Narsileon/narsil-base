<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Block;

#region USE

use Illuminate\View\Component as BladeComponent;
use Illuminate\View\View;
use Narsil\Base\Contracts\Menus\GuestMenu;

#endregion

final class AuthHeader extends BladeComponent
{
    #region PROPERTIES

    /**
     * The guest user menu items.
     *
     * @var array<int,array<string,mixed>>
     */
    public array $menu;

    #endregion

    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        $this->menu = app(GuestMenu::class)->jsonSerialize();
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.block.auth-header');
    }

    #endregion
}
