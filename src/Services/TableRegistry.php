<?php

declare(strict_types=1);

namespace Narsil\Base\Services;

#region USE

use InvalidArgumentException;
use Narsil\Base\Http\Data\TanStackTables\TableDefinition;
use Narsil\Base\Implementations\ConfiguredTable;
use Narsil\Base\Implementations\Table;
use Narsil\Base\Narsil;

#endregion

final class TableRegistry
{
    #region CONSTRUCTOR

    /**
     * @param ModelDefinitionService $modelDefinitionService
     * @param Narsil $narsil
     *
     * @return void
     */
    public function __construct(
        ModelDefinitionService $modelDefinitionService,
        Narsil $narsil,
    )
    {
        $this->modelDefinitionService = $modelDefinitionService;
        $this->narsil = $narsil;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var ModelDefinitionService
     */
    /**
     * @var array<string,array<int,callable(TableDefinition):void>>
     */
    private array $extensions = [];

    /**
     * @var ModelDefinitionService
     */
    private ModelDefinitionService $modelDefinitionService;

    /**
     * @var Narsil
     */
    private Narsil $narsil;

    #endregion

    #region PUBLIC METHODS

    /**
     * @param string $table
     * @param callable(TableDefinition):void $callback
     *
     * @return self
     */
    public function extend(string $table, callable $callback): self
    {
        $this->extensions[$table][] = $callback;

        return $this;
    }

    /**
     * @param string $model
     * @param callable(TableDefinition):void $callback
     *
     * @return self
     */
    public function extendModel(string $model, callable $callback): self
    {
        $definition = $this->modelDefinitionService->resolve($model);
        $modelClass = $definition->model();
        $prototype = new $modelClass();

        return $this->extend($prototype->getTable(), $callback);
    }

    /**
     * @param string $table
     * @param string $concrete
     *
     * @return self
     */
    public function replace(string $table, string $concrete): self
    {
        $this->assertTableClass($concrete);
        $this->narsil->table($table, $concrete);

        return $this;
    }

    /**
     * @param string $model
     * @param string $concrete
     *
     * @return self
     */
    public function replaceModel(string $model, string $concrete): self
    {
        return $this->replace($this->resolveModelTable($model), $concrete);
    }

    /**
     * @param string $table
     *
     * @return Table
     */
    public function resolve(string $table): Table
    {
        $tableClass = $this->modelDefinitionService->resolveTable($table);

        if (!$tableClass)
        {
            $tableClass = $this->modelDefinitionService->resolveTable('entities');
        }

        if (!$tableClass)
        {
            throw new InvalidArgumentException("No table implementation is registered for [$table].");
        }

        $this->assertTableClass($tableClass);
        $tableInstance = app()->make($tableClass, [
            'table' => $table,
        ]);
        $definition = new TableDefinition($tableInstance->columns());

        foreach ($this->extensions[$table] ?? [] as $callback)
        {
            $callback($definition);
        }

        return new ConfiguredTable($tableInstance, $definition);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param string $concrete
     *
     * @return void
     */
    private function assertTableClass(string $concrete): void
    {
        if (!is_a($concrete, Table::class, true))
        {
            throw new InvalidArgumentException("The table implementation [$concrete] must extend " . Table::class . '.');
        }
    }

    /**
     * @param string $model
     *
     * @return string
     */
    private function resolveModelTable(string $model): string
    {
        $definition = $this->modelDefinitionService->resolve($model);
        $modelClass = $definition->model();
        $prototype = new $modelClass();

        return $prototype->getTable();
    }

    #endregion
}
