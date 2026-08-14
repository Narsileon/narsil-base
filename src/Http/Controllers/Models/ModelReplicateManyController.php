<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Narsil\Base\Http\Requests\ReplicateManyRequest;
use Narsil\Base\Services\ModelHookService;
use Narsil\Base\Services\ModelDefinitionService;
use Narsil\Base\Services\ModelService;

#endregion

final class ModelReplicateManyController extends ModelController
{
    #region PUBLIC METHODS

    /**
     * @param ReplicateManyRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(ReplicateManyRequest $request): RedirectResponse
    {
        $definition = $this->getDefinition($request);
        $modelClass = $definition->model();
        $definitionService = app(ModelDefinitionService::class);
        $model = new $modelClass();

        $this->authorize(AbilityEnum::CREATE, $modelClass);

        $models = $modelClass::query()
            ->findMany($request->validated(ReplicateManyRequest::IDS));

        foreach ($models as $model)
        {
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
        }

        return back()
            ->with('success', ModelService::getSuccessMessage($model->getTable(), ModelEventEnum::REPLICATED_MANY));
    }

    #endregion
}
