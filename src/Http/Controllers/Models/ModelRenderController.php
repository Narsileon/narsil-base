<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
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

        return new $modelClass()
            ->getTable();
    }

    /**
     * Render a model form.
     *
     * @param mixed $form
     * @param array<string,mixed> $props
     *
     * @return JsonResponse|View
     */
    protected function renderModelForm(mixed $form, array $props = []): JsonResponse|View
    {
        $formProps = [
            'data' => [],
            'form' => $form,
            ...$props,
        ];

        return $this->renderBlade('narsil::pages.resources.form', $formProps);
    }

    #endregion
}
