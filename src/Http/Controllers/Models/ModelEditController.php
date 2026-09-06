<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Response;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Services\ModelDefinitionService;
use Narsil\Base\Services\ModelService;

#endregion

final class ModelEditController extends ModelRenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response|View
     */
    public function __invoke(Request $request): JsonResponse|Response|View
    {
        $definition = $this->getDefinition($request);
        $definitionService = app(ModelDefinitionService::class);
        $model = $definitionService->resolveModel(
            $definition,
            $request->route($definitionService->parameter($definition)),
        );

        $this->authorize(AbilityEnum::UPDATE, $model);
        $model->loadMissing($definition->editWith());

        if (method_exists($model, 'loadMissingCreatorAndEditor'))
        {
            $model->loadMissingCreatorAndEditor();
        }

        $request->route()->setParameter($definitionService->parameter($definition), $model);

        $data = method_exists($model, 'toArrayWithTranslations')
                ? $model->toArrayWithTranslations()
                : $model->toArray();
        $form = $this->getForm($definition->form(), $model, $definition->route());

        return $this->renderModelForm($form, [
            'data' => $data,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel($this->getTable($this->getDefinition(request())));
    }

    /**
     * @param string|null $formClass
     * @param mixed $model
     * @param string $route
     *
     * @return mixed
     */
    protected function getForm(?string $formClass, mixed $model, string $route): mixed
    {
        return app($formClass, [
            'model' => $model,
        ])
            ->action(route($route . '.update', $model))
            ->id($model->getKey())
            ->method(RequestMethodEnum::PATCH->value)
            ->submitLabel(trans('narsil::ui.update'));
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel($this->getTable($this->getDefinition(request())));
    }

    #endregion
}
