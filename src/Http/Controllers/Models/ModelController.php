<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\Request;
use Narsil\Base\Contracts\ModelDefinition;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Services\ModelDefinitionService;

#endregion

abstract class ModelController extends RedirectController
{
    #region PROTECTED METHODS

    /**
     * @param Request $request
     *
     * @return ModelDefinition
     */
    protected function getDefinition(Request $request): ModelDefinition
    {
        return app(ModelDefinitionService::class)
            ->resolve($request->route('model'));
    }

    #endregion
}
