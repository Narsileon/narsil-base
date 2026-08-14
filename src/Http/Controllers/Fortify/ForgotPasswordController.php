<?php

namespace Narsil\Base\Http\Controllers\Fortify;

#region USE

use Illuminate\Http\Request;
use Inertia\Response;
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
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $form = $this->getForm();

        app(TranslationsBag::class)
            ->add('narsil::ui.back');

        return $this->render('narsil/base::fortify/form', [
            'form' => $form,
            'status' => session('status'),
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
