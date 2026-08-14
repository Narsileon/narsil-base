<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\TanStackTables\Columns;

#region USE

use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\TanStackTables\ColumnDefData;

#endregion

final readonly class TextColumn extends ColumnDefData
{
    #region PROTECTED METHODS

    /**
     * @return string
     */
    protected static function type(): string
    {
        return TextInputData::TYPE;
    }

    #endregion
}
