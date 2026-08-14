<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\TanStackTables\Columns;

#region USE

use Narsil\Base\Http\Data\Forms\Inputs\DatetimeInputData;
use Narsil\Base\Http\Data\TanStackTables\ColumnDefData;

#endregion

final readonly class DateTimeColumn extends ColumnDefData
{
    #region PROTECTED METHODS

    /**
     * @return string
     */
    protected static function type(): string
    {
        return DatetimeInputData::TYPE;
    }

    #endregion
}
