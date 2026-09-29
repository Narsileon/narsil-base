<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Collections;

#region USE

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;
use Narsil\Base\Contracts\Forms\TanStackTableForm;
use Narsil\Base\Contracts\Table;
use Narsil\Base\Http\Data\TanStackTables\DataTableData;
use Narsil\Base\Http\Data\TanStackTables\DataTablePreset;
use Narsil\Base\Models\Users\TanStackTable;
use Narsil\Base\Services\TableRegistry;

#endregion

class DataTableCollection extends ResourceCollection
{
    #region CONSTUCTORS

    /**
     * @param Builder $query
     * @param string $table
     *
     * @return void
     */
    public function __construct(
        Builder $query,
        string $table,
    ) {
        $this->table = app(TableRegistry::class)->resolve($table);

        $preset = request(self::PRESET);

        $masterTable = $this->table->presets()
            ->first(function ($item)
            {
                return $item->getRawOriginal(TanStackTable::NAME) === null;
            });

        if ($preset = request(self::PRESET))
        {
            $presetTable = $this->table->presets()
                ->first(function ($item) use ($preset)
                {
                    return $item->{TanStackTable::UUID} === $preset;
                });

            if ($presetTable)
            {
                $masterTable->update([
                    TanStackTable::PRESET_UUID => $presetTable->{TanStackTable::UUID},
                ]);
            }
        }

        $this->tableData = DataTableData::fromModel($masterTable->{TanStackTable::RELATION_PRESET} ?? $masterTable);
        $this->applyRequestState();

        $this->tableData->applyGlobalFilter($query);
        $this->tableData->applyColumnFilters($query);
        $this->tableData->applySorting($query);

        $paginated = $query->paginate(
            perPage: $this->tableData->{TanStackTable::PAGE_SIZE} ?? 10,
            page: request(self::PAGE, 1),
        );

        parent::__construct($paginated);
    }

    #endregion

    #region CONSTANTS

    /**
     * @var string
     */
    final public const PAGE = 'page';

    /**
     * @var string
     */
    final public const PRESET = 'preset';

    #endregion

    #region PROPERTIES

    /**
     * @var Table
     */
    protected readonly Table $table;

    /**
     * @var DataTableData
     */
    protected readonly DataTableData $tableData;

    /**
     * @var array<string,mixed>
     */
    protected array $options = [];

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function toArray(Request $request): JsonSerializable
    {
        return $this->collection->map(function ($item)
        {
            return $item->toArray();
        });
    }

    /**
     * @return array<string,mixed>
     */
    public function toBladeData(): array
    {
        $pagination = $this->resource->toArray();
        $meta = $this->with(request())['meta'];

        return [
            'data' => $this->collection->map(function ($item): array
            {
                return $item->toArray();
            })->values()->all(),
            'links' => [
                'first' => $pagination['first_page_url'] ?? null,
                'last' => $pagination['last_page_url'] ?? null,
                'next' => $pagination['next_page_url'] ?? null,
                'prev' => $pagination['prev_page_url'] ?? null,
            ],
            'meta' => [
                'current_page' => $pagination['current_page'] ?? null,
                'from' => $pagination['from'] ?? null,
                'last_page' => $pagination['last_page'] ?? null,
                'links' => $pagination['links'] ?? [],
                'per_page' => $pagination['per_page'] ?? null,
                'to' => $pagination['to'] ?? null,
                'total' => $pagination['total'] ?? 0,
                ...$meta,
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function with($request): array
    {
        $columns = $this->table->columns();
        $presets = $this->table->presets()
            ->map(function ($preset)
            {
                return DataTablePreset::fromModel($preset);
            });

        return [
            'meta' => [
                'columns' => $columns,
                'presets' => [
                    'data' => $presets,
                    'form' => TanStackTableForm::class,
                ],
                'routes' => $this->table->routes(),
                'state' => $this->tableData,
                ...$this->options,
            ],
        ];
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return void
     */
    protected function applyRequestState(): void
    {
        foreach (
            [
                TanStackTable::COLUMN_FILTERS => 'column_filters',
                TanStackTable::COLUMN_ORDER => 'column_order',
                TanStackTable::COLUMN_VISIBILITY => 'column_visibility',
                TanStackTable::GLOBAL_FILTER => 'global_filter',
                TanStackTable::PAGE_SIZE => 'page_size',
                TanStackTable::ROW_SELECTION => 'row_selection',
                TanStackTable::SORTING => 'sorting',
            ] as $property => $input
        ) {
            if (!request()->has($input))
            {
                continue;
            }

            $value = request($input);

            if (is_string($value) && in_array($property, [
                TanStackTable::COLUMN_FILTERS,
                TanStackTable::COLUMN_ORDER,
                TanStackTable::COLUMN_VISIBILITY,
                TanStackTable::ROW_SELECTION,
                TanStackTable::SORTING,
            ], true))
            {
                $value = json_decode($value, true) ?: [];
            }

            $this->tableData->set($property, $value);
        }
    }

    #endregion
}
