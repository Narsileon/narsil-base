<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\TanStackTables;

#region USE

use InvalidArgumentException;

#endregion

final class TableDefinition
{
    #region CONSTRUCTOR

    /**
     * @param ColumnDefData[] $columns
     *
     * @return void
     */
    public function __construct(array $columns)
    {
        foreach ($columns as $column)
        {
            if (!$column instanceof ColumnDefData)
            {
                throw new InvalidArgumentException('Table columns must be instances of ColumnDefData.');
            }

            if (isset($this->columns[$column->id]))
            {
                throw new InvalidArgumentException("The table contains duplicate column [{$column->id}].");
            }

            $this->columns[$column->id] = $column;
        }
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,ColumnDefData>
     */
    private array $columns = [];

    #endregion

    #region PUBLIC METHODS

    /**
     * @param ColumnDefData $column
     *
     * @return self
     */
    public function add(ColumnDefData $column): self
    {
        if (isset($this->columns[$column->id]))
        {
            throw new InvalidArgumentException("The column [{$column->id}] already exists.");
        }

        $this->columns[$column->id] = $column;

        return $this;
    }

    /**
     * @return ColumnDefData[]
     */
    public function columns(): array
    {
        return array_values($this->columns);
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function hide(string $id): self
    {
        return $this->update($id, function (ColumnDefData $column): ColumnDefData
        {
            return $column->hidden();
        });
    }

    /**
     * @param string $id
     * @param string $header
     *
     * @return self
     */
    public function label(string $id, string $header): self
    {
        return $this->update($id, function (ColumnDefData $column) use ($header): ColumnDefData
        {
            return $column->label($header);
        });
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function remove(string $id): self
    {
        $this->assertColumn($id);
        unset($this->columns[$id]);

        return $this;
    }

    /**
     * @param ColumnDefData $column
     *
     * @return self
     */
    public function replace(ColumnDefData $column): self
    {
        $this->assertColumn($column->id);
        $this->columns[$column->id] = $column;

        return $this;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function show(string $id): self
    {
        return $this->update($id, function (ColumnDefData $column): ColumnDefData
        {
            return $column->visible();
        });
    }

    /**
     * @param string $id
     * @param callable(ColumnDefData):ColumnDefData $callback
     *
     * @return self
     */
    public function update(string $id, callable $callback): self
    {
        $this->assertColumn($id);
        $column = $callback($this->columns[$id]);

        if (!$column instanceof ColumnDefData)
        {
            throw new InvalidArgumentException('Table column updates must return ColumnDefData.');
        }

        $this->columns[$id] = $column;

        return $this;
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param string $id
     *
     * @return void
     */
    private function assertColumn(string $id): void
    {
        if (!isset($this->columns[$id]))
        {
            throw new InvalidArgumentException("The column [{$id}] does not exist.");
        }
    }

    #endregion
}
