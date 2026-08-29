<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Fortify;

#region USE

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Narsil\Base\Contracts\Forms\Fortify\LoginForm;
use Narsil\Base\Http\Controllers\RenderController;

#endregion

class LoginController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $form = $this->getForm();

        return view('narsil::pages.fortify.form', [
            'form' => $form,
            'status' => session('status'),
            'title' => $this->getTitle(),
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return trans('narsil::ui.connection');
    }

    /**
     * Get the associated form.
     *
     * @return LoginForm
     */
    protected function getForm(): LoginForm
    {
        $form = app(LoginForm::class);

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return trans('narsil::ui.connection');
    }

    #endregion
}
