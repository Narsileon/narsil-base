<?php

namespace Narsil\Base\Casts;

#region USE

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

#endregion

class DiffForHumansCast implements CastsAttributes
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value ? Carbon::parse($value)->diffForHumans() : null;
    }

    /**
     * {@inheritDoc}
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value;
    }

    #endregion
}
