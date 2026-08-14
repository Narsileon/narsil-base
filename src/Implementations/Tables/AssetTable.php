<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Tables;

#region USE

use Narsil\Base\Http\Data\TanStackTables\Columns\DateTimeColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\TextColumn;
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
            TextColumn::make(
                id: Asset::UUID,
                visibility: true,
            ),
            TextColumn::make(
                id: Asset::PATH,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Asset::CREATED_AT,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Asset::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}
