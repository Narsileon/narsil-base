<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\Request;
use Narsil\Base\Contracts\ModelDefinition;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Services\ModelDefinitionService;

#endregion

abstract class ModelRenderController extends RenderController
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

    /**
     * @param ModelDefinition $definition
     *
     * @return string
     */
    protected function getTable(ModelDefinition $definition): string
    {
        $modelClass = $definition->model();

        return (new $modelClass())->getTable();
    }

    #endregion
}
