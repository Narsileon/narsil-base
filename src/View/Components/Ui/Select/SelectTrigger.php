<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Select;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SelectTrigger extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $id
     * @param mixed $required
     * @param mixed $size
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $id = null,
        mixed $required = false,
        mixed $size = 'default',
        mixed $variant = 'default'
    )
    {
        $this->id = $id;
        $this->required = $required;
        $this->size = $size;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $required;

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
        return view('narsil::components.ui.select.select-trigger');
    }

    #endregion
}
