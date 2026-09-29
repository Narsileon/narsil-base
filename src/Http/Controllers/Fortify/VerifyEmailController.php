<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Fortify;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Narsil\Base\Http\Controllers\RenderController;

#endregion

class VerifyEmailController extends RenderController
{
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
