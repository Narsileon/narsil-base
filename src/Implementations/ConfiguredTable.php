<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations;

#region USE

use Illuminate\Support\Collection;
use Narsil\Base\Http\Data\TanStackTables\TableDefinition;

#endregion

final class ConfiguredTable extends Table
{
    #region CONSTRUCTOR

    /**
     * @param Table $table
     * @param TableDefinition $definition
     *
     * @return void
     */
    public function __construct(
        Table $table,
        TableDefinition $definition,
    )
    {
        parent::__construct($table->name);
        $this->definition = $definition;
        $this->table = $table;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var TableDefinition
     */
    private readonly TableDefinition $definition;

    /**
     * @var Table
     */
    private readonly Table $table;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function columnOrder(array $columns): array
    {
        return $this->table->columnOrder($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {
        return $this->definition->columns();
    }

    /**
     * {@inheritDoc}
     */
    public function columnVisibility(array $columns): array
    {
        return $this->table->columnVisibility($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function presets(): Collection
    {
        return $this->table->presets();
    }

    /**
     * {@inheritDoc}
     */
    public function routes(): array
    {
        return $this->table->routes();
    }

    #endregion
}
