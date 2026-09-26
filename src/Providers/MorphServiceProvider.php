<?php

declare(strict_types=1);

namespace Narsil\Base\Providers;

#region USE

use Exception;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Narsil\Base\Narsil;

#endregion

class MorphServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function boot(): void
    {
        try
        {
            $this->bootMorphMap();
        }
        catch (Exception $exception)
        {
            Log::error($exception);
        }
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return void
     */
    protected function bootMorphMap(): void
    {
        $morphs = app(Narsil::class)->morphs();

        $map = [];

        foreach ($morphs as $class => $table)
        {
            $map[$table] = $class;
        }

        foreach (app(Narsil::class)->modelDefinitions() as $model => $definitionClass)
        {
            $morph = app($definitionClass)->morph();

            if ($morph)
            {
                $map[$morph] = $model;
            }
        }

        Relation::enforceMorphMap($map);
    }

    #endregion
}
