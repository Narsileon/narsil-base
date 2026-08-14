<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Events;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\ModelEventHook;
use Narsil\Base\Models\User;

#endregion

final class CreateUserConfigurationEvent implements ModelEventHook
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function handle(Model $model): void
    {
        if ($model instanceof User && !$model->configuration()->exists())
        {
            $model->configuration()->create();
        }
    }

    #endregion
}
