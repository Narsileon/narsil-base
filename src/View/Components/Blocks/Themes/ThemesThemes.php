<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Themes;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ThemesThemes extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $theme
     *
     * @return void
     */
    public function __construct(
        mixed $theme = null,
    )
    {
        $this->theme = $theme;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $theme;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.themes.themes-themes');
    }

    #endregion
}
