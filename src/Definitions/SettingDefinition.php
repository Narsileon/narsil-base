<?php

declare(strict_types=1);

namespace Narsil\Base\Definitions;

#region USE

use Narsil\Base\Models\Setting;
use Narsil\Base\Services\DatabaseService;

#endregion

final class SettingDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return Setting::class;
    }

    /**
     * {@inheritDoc}
     */
    public function operations(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return DatabaseService::getUnqualifiedTableName(Setting::TABLE);
    }

    #endregion
}
