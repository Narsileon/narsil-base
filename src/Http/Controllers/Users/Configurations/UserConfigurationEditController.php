<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Users\Configurations;

#region USE

use Illuminate\Http\Request;
use Illuminate\View\View;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\Users\UserConfiguration;
use Narsil\Base\Services\ModelService;

#endregion

class UserConfigurationEditController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): View
    {
        return $this->renderBlade('narsil::pages.users.settings');
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel(UserConfiguration::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(UserConfiguration::TABLE);
    }

    #endregion
}
