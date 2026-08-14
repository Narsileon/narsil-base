<?php

namespace Narsil\Base\Implementations\Tables;

#region USE

use Narsil\Base\Http\Data\Forms\Inputs\DatetimeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\TanStackTables\ColumnDefData;
use Narsil\Base\Implementations\Table;
use Narsil\Base\Models\Storages\Asset;

#endregion

class AssetTable extends Table
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(Asset::TABLE);
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {
        return [
            new ColumnDefData(
                id: Asset::UUID,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Asset::PATH,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Asset::CREATED_AT,
                type: DatetimeInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Asset::UPDATED_AT,
                type: DatetimeInputData::TYPE,
                visibility: true,
            ),
        ];
    }

    #endregion
}
