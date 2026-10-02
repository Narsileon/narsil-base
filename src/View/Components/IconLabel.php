<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class IconLabel extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $icon
     *
     * @return void
     */
    public function __construct(string $icon)
    {
        $this->icon = $icon;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $icon;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('narsil::components.icon-label');
    }

    #endregion
}
