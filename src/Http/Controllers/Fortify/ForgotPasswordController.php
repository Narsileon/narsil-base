<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Fortify;

#region USE

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Narsil\Base\Contracts\Forms\Fortify\ForgotPasswordForm;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Support\TranslationsBag;

#endregion

class ForgotPasswordController extends RenderController
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

        app(TranslationsBag::class)
            ->add('narsil::ui.back');

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
        return trans('narsil::ui.reset_password');
    }

    /**
     * Get the associated form.
     *
     * @return ForgotPasswordForm
     */
    protected function getForm(): ForgotPasswordForm
    {
        $form = app(ForgotPasswordForm::class);

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
