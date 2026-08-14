<?php

namespace Narsil\Base\Http\Controllers\Fortify;

#region USE

use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Support\TranslationsBag;
use Narsil\Base\Http\Controllers\RenderController;

#endregion

class VerifyEmailController extends RenderController
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        app(TranslationsBag::class)
            ->add('narsil::emails.send')
            ->add('narsil::emails.sent')
            ->add('narsil::emails.verify')
            ->add('narsil::ui.send_again');
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->render('narsil/base::fortify/verify-email', [
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
        return trans('narsil::ui.email_verify');
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return trans('narsil::ui.email_verify');
    }

    #endregion
}
