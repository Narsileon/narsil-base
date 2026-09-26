<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Events;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\ModelEventHook;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Models\Setting;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserConfiguration;

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
            $model->configuration()->create([
                UserConfiguration::COLOR => Setting::getValue(Setting::DEFAULT_COLOR, ColorEnum::GRAY->value),
                UserConfiguration::RADIUS => (float) Setting::getValue(Setting::DEFAULT_RADIUS, 0.25),
            ]);
        }
    }

    #endregion
}
