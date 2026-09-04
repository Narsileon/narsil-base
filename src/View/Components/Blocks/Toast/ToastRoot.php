<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Toast;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ToastRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $messages
     *
     * @return void
     */
    public function __construct(array $messages = [])
    {
        $this->messages = $messages;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $messages;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.toast.toast-root');
    }

    #endregion
}
