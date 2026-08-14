<?php

declare(strict_types=1);

namespace Narsil\Base\Contracts;

#region USE

use Illuminate\Database\Eloquent\Model;

#endregion

interface ModelEventHook
{
    /**
     * @param Model $model
     *
     * @return void
     */
    public function handle(Model $model): void;
}
