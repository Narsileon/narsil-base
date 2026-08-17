<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers;

#region USE

use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Contracts\Menus\Home;

#endregion

final class HomeController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->render('narsil/base::home/index', [
            'items' => app(Home::class),
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return 'Narsil';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return 'Narsil';
    }

    #endregion
}
