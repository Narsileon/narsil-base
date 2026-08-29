<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Fortify;

#region USE

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Narsil\Base\Contracts\Forms\Fortify\ResetPasswordForm;
use Narsil\Base\Http\Controllers\RenderController;

#endregion

class ResetPasswordController extends RenderController
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
        $token = $request->route('token');

        return view('narsil::pages.fortify.form', [
            'form' => $form,
            'token' => $token,
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
        return trans('narsil::ui.reset_password');
    }

    /**
     * Get the associated form.
     *
     * @return ResetPasswordForm
     */
    protected function getForm(): ResetPasswordForm
    {
        $form = app(ResetPasswordForm::class);

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return trans('narsil::ui.reset_password');
    }

    #endregion
}
