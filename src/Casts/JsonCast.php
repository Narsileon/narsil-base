<?php

namespace Narsil\Base\Casts;

#region USE

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

#endregion

class JsonCast implements CastsAttributes
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return json_decode($value ?? '{}') ?: (object)[];
    }

    /**
     * {@inheritDoc}
     */
    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if (empty($value))
        {
            $value = null;
        }

        return $value ? json_encode($value) : null;
    }

    #endregion
}
