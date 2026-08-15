<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Fortify;

#region USE

use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Contracts\Forms\Fortify\RegisterForm;
use Narsil\Base\Http\Controllers\RenderController;

#endregion

class RegisterController extends RenderController
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

        return $this->render('narsil/base::fortify/form', [
            'form' => $form,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return trans('narsil::ui.registration');
    }

    /**
     * Get the associated form.
     *
     * @return RegisterForm
     */
    protected function getForm(): RegisterForm
    {
        $form = app(RegisterForm::class);

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return trans('narsil::ui.registration');
    }

    #endregion
}
