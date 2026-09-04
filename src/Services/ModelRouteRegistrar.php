<?php

declare(strict_types=1);

namespace Narsil\Base\Services;

#region USE

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Narsil\Base\Contracts\ModelDefinition;
use Narsil\Base\Enums\ModelOperationEnum;
use Narsil\Base\Http\Controllers\Models\ModelCreateController;
use Narsil\Base\Http\Controllers\Models\ModelDestroyController;
use Narsil\Base\Http\Controllers\Models\ModelDestroyManyController;
use Narsil\Base\Http\Controllers\Models\ModelEditController;
use Narsil\Base\Http\Controllers\Models\ModelIndexController;
use Narsil\Base\Http\Controllers\Models\ModelReplicateController;
use Narsil\Base\Http\Controllers\Models\ModelReplicateManyController;
use Narsil\Base\Http\Controllers\Models\ModelStoreController;
use Narsil\Base\Http\Controllers\Models\ModelUpdateController;
use Narsil\Base\Narsil;

#endregion

final class ModelRouteRegistrar
{
    #region CONSTRUCTOR

    /**
     * @param Narsil $narsil
     * @param ModelDefinitionService $definitionService
     *
     * @return void
     */
    public function __construct(Narsil $narsil, ModelDefinitionService $definitionService)
    {
        $this->narsil = $narsil;
        $this->definitionService = $definitionService;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var Narsil
     */
    private readonly Narsil $narsil;

    /**
     * @var ModelDefinitionService
     */
    private readonly ModelDefinitionService $definitionService;

    #endregion

    #region PUBLIC METHODS

    /**
     * Register routes for all configured model definitions.
     *
     * @param string|null $namespace
     *
     * @return void
     */
    public function register(?string $namespace = null): void
    {
        foreach ($this->narsil->modelDefinitions() as $model => $_definitionClass)
        {
            if ($namespace && !str_starts_with($model, $namespace))
            {
                continue;
            }

            $definition = $this->definitionService->resolve($model);
            $this->registerDefinition($definition);
        }
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param ModelDefinition $definition
     *
     * @return void
     */
    private function registerDefinition(ModelDefinition $definition): void
    {
        $route = Str::slug($definition->route());
        $parameter = $this->definitionService->parameter($definition);
        $operations = $definition->operations();

        Route::prefix($route)->name($route . '.')->group(function () use ($definition, $parameter, $operations)
        {
            $this->registerOperation($operations, ModelOperationEnum::INDEX, function () use ($definition)
            {
                return Route::get('/', ModelIndexController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::INDEX->value);
            });

            $this->registerOperation($operations, ModelOperationEnum::CREATE, function () use ($definition)
            {
                return Route::get('/create', ModelCreateController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::CREATE->value);
            });

            $this->registerOperation($operations, ModelOperationEnum::STORE, function () use ($definition)
            {
                return Route::post('/', ModelStoreController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::STORE->value);
            });

            $this->registerOperation($operations, ModelOperationEnum::EDIT, function () use ($definition, $parameter)
            {
                return Route::get('/{' . $parameter . '}/edit', ModelEditController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::EDIT->value);
            });

            $this->registerOperation($operations, ModelOperationEnum::UPDATE, function () use ($definition, $parameter)
            {
                return Route::patch('/{' . $parameter . '}', ModelUpdateController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::UPDATE->value);
            });

            $this->registerOperation($operations, ModelOperationEnum::DESTROY, function () use ($definition, $parameter)
            {
                return Route::delete('/{' . $parameter . '}', ModelDestroyController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::DESTROY->value);
            });

            $this->registerOperation($operations, ModelOperationEnum::DESTROY_MANY, function () use ($definition)
            {
                return Route::delete('/', ModelDestroyManyController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::DESTROY_MANY->value);
            });

            $this->registerOperation($operations, ModelOperationEnum::REPLICATE, function () use ($definition, $parameter)
            {
                return Route::post('/{' . $parameter . '}/replicate', ModelReplicateController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::REPLICATE->value);
            });

            $this->registerOperation($operations, ModelOperationEnum::REPLICATE_MANY, function () use ($definition)
            {
                return Route::post('/replicate-many', ModelReplicateManyController::class)
                    ->defaults('model', $definition->model())
                    ->name(ModelOperationEnum::REPLICATE_MANY->value);
            });
        });
    }

    /**
     * @param ModelOperationEnum[] $operations
     * @param ModelOperationEnum $operation
     * @param callable $route
     *
     * @return void
     */
    private function registerOperation(array $operations, ModelOperationEnum $operation, callable $route): void
    {
        if (in_array($operation, $operations, true))
        {
            $route();
        }
    }

    #endregion
}
