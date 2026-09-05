<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Narsil\Base\Contracts\Menus\Home;

#endregion

final class HomeController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @return JsonResponse|View
     */
    public function __invoke(): JsonResponse|View
    {
        return $this->renderBlade('narsil::pages.home.index', [
            'items' => $this->getItems(),
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

    #region PRIVATE METHODS

    /**
     * Get the home page items without the current home link.
     *
     * @return array
     */
    private function getItems(): array
    {
        return array_values(array_filter(
            app(Home::class)->jsonSerialize(),
            static function (mixed $item): bool
            {
                return data_get($item, 'route') !== 'narsil.home';
            },
        ));
    }

    #endregion
}
