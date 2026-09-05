<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Response;
use Narsil\Base\Contracts\ModelDefinition;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Services\ModelDefinitionService;

#endregion

abstract class ModelRenderController extends RenderController
{
    #region PROTECTED METHODS

    /**
     * Render a model form with the available server-side renderer.
     *
     * @param mixed $form
     * @param array<string,mixed> $props
     *
     * @return JsonResponse|Response|View
     */
    protected function renderModelForm(mixed $form, array $props = []): JsonResponse|Response|View
    {
        $formProps = [
            'data' => [],
            'form' => $form,
            ...$props,
        ];

        $response = $this->isBladeForm($form)
            ? $this->renderBlade('narsil::pages.resources.form', $formProps)
            : $this->render('narsil/cms::resources/form', $formProps);

        return $response;
    }

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
     * Determine whether the form can be rendered by the current Blade form.
     *
     * @param mixed $form
     *
     * @return boolean
     */
    private function isBladeForm(mixed $form): bool
    {
        $supportedTypes = [
            'checkbox',
            'combobox',
            'email',
            'file',
            'password',
            'radio',
            'range',
            'select',
            'switch',
            'text',
            'textarea',
        ];
        $steps = data_get($form, 'steps', []);
        $compatible = is_array($steps) && !empty($steps);

        foreach ($steps as $step)
        {
            $elements = data_get($step, 'elements');

            if (!is_array($elements))
            {
                $compatible = false;

                continue;
            }

            foreach ($elements as $element)
            {
                $type = data_get($element, 'input.type');

                if (!in_array($type, $supportedTypes, true))
                {
                    $compatible = false;
                }
            }
        }

        return $compatible;
    }

    #endregion
}
