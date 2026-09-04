<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\AlertDialog;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class AlertDialogRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $actions
     * @param mixed $cancel
     * @param mixed $description
     * @param mixed $open
     * @param mixed $title
     *
     * @return void
     */
    public function __construct(
        mixed $actions = [],
        mixed $cancel = [],
        mixed $description = null,
        mixed $open = false,
        mixed $title = null
    )
    {
        $this->actions = $actions;
        $this->cancel = $cancel;
        $this->description = $description;
        $this->open = $open;
        $this->title = $title;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $actions;

    /**
     * @var mixed
     */
    public readonly mixed $cancel;

    /**
     * @var mixed
     */
    public readonly mixed $description;

    /**
     * @var mixed
     */
    public readonly mixed $open;

    /**
     * @var mixed
     */
    public readonly mixed $title;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.alert-dialog.alert-dialog-root');
    }

    #endregion
}
