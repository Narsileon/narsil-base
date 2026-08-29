<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Fortify;

#region USE

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
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
     * @return View
     */
    public function __invoke(Request $request): View
    {
        return view('narsil::pages.fortify.verify-email', [
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
