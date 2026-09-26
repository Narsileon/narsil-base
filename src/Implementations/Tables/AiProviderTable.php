<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Tables;

#region USE

use Narsil\Base\Http\Data\TanStackTables\Columns\TextColumn;
use Narsil\Base\Implementations\Table;
use Narsil\Base\Models\AiProvider;

#endregion

class AiProviderTable extends Table
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(AiProvider::TABLE);
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
                id: AiProvider::PROVIDER,
                visibility: true,
            ),
            TextColumn::make(
                id: AiProvider::MODEL,
                visibility: true,
            ),
        ];
    }

    #endregion
}
