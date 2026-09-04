<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Avatar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class AvatarRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $size
     *
     * @return void
     */
    public function __construct(
        mixed $size = 'default'
    )
    {
        $this->size = $size;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $size;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.avatar.avatar-root');
    }

    #endregion
}
