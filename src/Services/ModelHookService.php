<?php

declare(strict_types=1);

namespace Narsil\Base\Services;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\ModelHook;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Narsil\Base\Narsil;

#endregion

final class ModelHookService
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
     * @param Model $model
     * @param ModelHookEventEnum $event
     * @param ModelHookContext $context
     *
     * @return ModelHookContext
     */
    public function run(Model $model, ModelHookEventEnum $event, ModelHookContext $context): ModelHookContext
    {
        $hooks = $this->narsil->modelHooks()[$model::class][$event->value] ?? [];

        foreach ($this->narsil->modelDefinitions() as $registeredModel => $definitionClass)
        {
            if ($registeredModel !== $model::class)
            {
                continue;
            }

            $hooks = array_merge($hooks, app($definitionClass)->hooks()[$event->value] ?? []);
        }

        usort($hooks, function (array $first, array $second): int
        {
            return $second['priority'] <=> $first['priority'];
        });

        foreach ($hooks as $definition)
        {
            $hook = $definition['hook'];

            if (is_string($hook))
            {
                $hook = app($hook);
            }

            if ($hook instanceof ModelHook)
            {
                $hook->handle($context);
            }
            elseif (is_callable($hook))
            {
                $hook($context);
            }
        }

        return $context;
    }

    #endregion
}
