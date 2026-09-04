<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $action
     * @param mixed $enctype
     * @param mixed $id
     * @param mixed $method
     * @param mixed $token
     *
     * @return void
     */
    public function __construct(
        mixed $action,
        mixed $enctype = 'application/x-www-form-urlencoded',
        mixed $id = null,
        mixed $method = 'POST',
        mixed $token = null
    )
    {
        $this->action = $action;
        $this->enctype = $enctype;
        $this->id = $id;
        $this->method = $method;
        $this->token = $token;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $action;

    /**
     * @var mixed
     */
    public readonly mixed $enctype;

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $method;

    /**
     * @var mixed
     */
    public readonly mixed $token;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-root');
    }

    #endregion
}
