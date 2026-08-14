<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Narsil\Base\Services\ModelHookService;
use Narsil\Base\Services\ModelDefinitionService;
use Narsil\Base\Services\ModelService;

#endregion

final class ModelReplicateController extends ModelController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $definition = $this->getDefinition($request);
        $definitionService = app(ModelDefinitionService::class);
        $model = $definitionService->resolveModel(
            $definition,
            $request->route($definitionService->parameter($definition)),
        );

        $this->authorize(AbilityEnum::CREATE, $definition->model());

        app(ModelHookService::class)
            ->run($model, ModelHookEventEnum::BEFORE_REPLICATE, new ModelHookContext(
                request: $request,
                model: $model,
            ));

        $replicated = app($definition->replicateAction())
            ->run($model);

        app(ModelHookService::class)
            ->run($replicated, ModelHookEventEnum::AFTER_REPLICATE, new ModelHookContext(
                request: $request,
                model: $replicated,
                result: $replicated,
            ));

        return back()
            ->with('success', ModelService::getSuccessMessage($model->getTable(), ModelEventEnum::REPLICATED));
    }

    #endregion
}
