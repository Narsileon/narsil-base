<?php

declare(strict_types=1);

namespace Narsil\Base\Services;

#region USE

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

#endregion

class FormService
{
    #region PUBLIC METHODS

    /**
     * @param class-string<Model> $model
     * @param Closure|null $callback
     *
     * @return Collection
     */
    public static function getOptions(string $model, ?Closure $callback = null): Collection
    {
        $query = $model::query();

        if ($callback)
        {
            $callback($query);
        }

        return $query
            ->get()
            ->map(function (Model $model)
            {
                return $model->toOption();
            });
    }

    #endregion
}
