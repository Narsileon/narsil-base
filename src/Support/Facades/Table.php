<?php

declare(strict_types=1);

namespace Narsil\Base\Support\Facades;

#region USE

use Illuminate\Support\Facades\Facade;
use Narsil\Base\Services\TableRegistry;

#endregion

final class Table extends Facade
{
    #region PROTECTED METHODS

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return TableRegistry::class;
    }

    #endregion
}
