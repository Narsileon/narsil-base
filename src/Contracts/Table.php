<?php

declare(strict_types=1);

namespace Narsil\Base\Contracts;

#region USE

use Illuminate\Support\Collection;
use Narsil\Base\Http\Data\TanStackTables\ColumnDefData;
use Narsil\Base\Models\Users\TanStackTable;

#endregion

interface Table
{
    #region PUBLIC METHODS

    /**
     * @param ColumnDefData[] $columns
     *
     * @return array
     */
    public function columnOrder(array $columns): array;

    /**
     * @return ColumnDefData[]
     */
    public function columns(): array;

    /**
     * @param ColumnDefData[] $columns
     *
     * @return array
     */
    public function columnVisibility(array $columns): array;

    /**
     * @return Collection<TanStackTable>
     */
    public function presets(): Collection;

    /**
     * @return array
     */
    public function routes(): array;

    #endregion
}
