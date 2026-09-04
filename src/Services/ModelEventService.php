<?php

declare(strict_types=1);

namespace Narsil\Base\Services;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\ModelEventHook;
use Narsil\Base\Narsil;

#endregion

final class ModelEventService
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
     * Register definition-owned Eloquent model events.
     *
     * @return void
     */
    public function register(): void
    {
        foreach ($this->narsil->modelDefinitions() as $definitionClass)
        {
            $definition = app($definitionClass);
            $model = $definition->model();

            foreach ($definition->events() as $event => $hooks)
            {
                foreach ($hooks as $hook)
                {
                    $model::registerModelEvent($event, function (Model $model) use ($hook): void
                    {
                        $this->run($hook, $model);
                    });
                }
            }
        }
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param callable|string $hook
     * @param Model $model
     *
     * @return void
     */
    private function run(callable|string $hook, Model $model): void
    {
        if (is_string($hook))
        {
            $hook = app($hook);
        }

        if ($hook instanceof ModelEventHook)
        {
            $hook->handle($model);
        }
        elseif (is_callable($hook))
        {
            $hook($model);
        }
    }

    #endregion
}
