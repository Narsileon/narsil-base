<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations;

#region USE

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Narsil\Base\Contracts\Table as Contract;
use Narsil\Base\Models\Users\TanStackTable;
use Narsil\Base\Services\RouteService;

#endregion

abstract class Table implements Contract
{
    #region CONSTRUCTOR

    /**
     * @param string $table
     *
     * @return void
     */
    public function __construct(string $table)
    {
        $this->name = $table;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string The name of the table.
     */
    public readonly string $name;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    abstract public function columns(): array;

    /**
     * {@inheritDoc}
     */
    public function columnOrder(array $columns): array
    {
        $columnOrder = [];

        foreach ($columns as $column)
        {
            $columnOrder[] = $column->id;
        }

        return $columnOrder;
    }

    /**
     * {@inheritDoc}
     */
    public function columnVisibility(array $columns): array
    {
        $columnVisibility = [];

        foreach ($columns as $column)
        {
            $columnVisibility[$column->id] = $column->visibility;
        }

        return $columnVisibility;
    }

    /**
     * @return Collection<TanStackTable>
     */
    public function presets(): Collection
    {
        return once(function ()
        {
            $presets = TanStackTable::query()
                ->with([
                    TanStackTable::RELATION_PRESET,
                ])
                ->where(TanStackTable::TABLE_NAME, $this->name)
                ->where(TanStackTable::USER_ID,  Auth::id())
                ->orderBy(TanStackTable::CREATED_AT)
                ->get();

            if ($presets->count() === 0)
            {
                $presets->push(TanStackTable::factory(
                    [
                        TanStackTable::USER_ID => Auth::id(),
                        TanStackTable::TABLE_NAME => $this->name,
                    ]
                )->create());
            }

            return $presets;
        });
    }

    /**
     * {@inheritDoc}
     */
    public function routes(): array
    {
        return RouteService::getNames($this->name);
    }

    #endregion
}
