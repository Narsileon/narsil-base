<?php

declare(strict_types=1);

namespace Narsil\Base\Services;

#region USE

use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Narsil\Base\Contracts\ModelDefinition;
use Narsil\Base\Narsil;

#endregion

final class ModelDefinitionService
{
    #region CONSTRUCTOR

    /**
     * @param Narsil $narsil
     *
     * @return void
     */
    public function __construct(Narsil $narsil)
    {
        $this->narsil = $narsil;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var Narsil
     */
    private readonly Narsil $narsil;

    #endregion

    #region PUBLIC METHODS

    /**
     * @param ModelDefinition $definition
     *
     * @return string
     */
    public function parameter(ModelDefinition $definition): string
    {
        return Str::camel(Str::afterLast($definition->model(), '\\'));
    }

    /**
     * @param string $model
     *
     * @return ModelDefinition
     */
    public function resolve(string $model): ModelDefinition
    {
        $definition = $this->narsil->modelDefinitions()[$model] ?? null;

        if (!$definition)
        {
            throw new InvalidArgumentException("No model definition is registered for [$model].");
        }

        $instance = app($definition);

        if (!$instance instanceof ModelDefinition || $instance->model() !== $model)
        {
            throw new InvalidArgumentException("The model definition [$definition] is invalid for [$model].");
        }

        return $instance;
    }

    /**
     * @param ModelDefinition $definition
     * @param mixed $value
     *
     * @return Model
     */
    public function resolveModel(ModelDefinition $definition, mixed $value): Model
    {
        $model = $definition->model();
        $prototype = new $model();
        $instance = $prototype->resolveRouteBindingQuery($prototype->newQuery(), $value)
            ->first();

        if (!$instance)
        {
            abort(404);
        }

        return $instance;
    }

    /**
     * @param string $route
     *
     * @return ModelDefinition
     */
    public function resolveRoute(string $route): ModelDefinition
    {
        $model = null;

        foreach ($this->narsil->modelDefinitions() as $registeredModel => $definition)
        {
            $instance = app($definition);

            if ($instance instanceof ModelDefinition && $instance->route() === $route)
            {
                $model = $registeredModel;
            }
        }

        if (!$model)
        {
            throw new InvalidArgumentException("No model definition is registered for route [$route].");
        }

        return $this->resolve($model);
    }

    /**
     * @param string $table
     *
     * @return string|null
     */
    public function resolveTable(string $table): ?string
    {
        $tableClass = $this->narsil->tables()[$table] ?? null;

        if ($tableClass)
        {
            return $tableClass;
        }

        foreach ($this->narsil->modelDefinitions() as $definition)
        {
            $instance = app($definition);
            $model = $instance->model();
            $prototype = new $model();

            if ($prototype->getTable() === $table)
            {
                $tableClass = $instance->table();
            }
        }

        return $tableClass;
    }

    #endregion
}
