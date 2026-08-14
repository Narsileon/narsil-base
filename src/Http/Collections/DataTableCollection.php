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
use Narsil\Base\Enums\OperatorEnum;
use Narsil\Base\Http\Data\TanStackTables\DataTableData;
use Narsil\Base\Http\Data\TanStackTables\DataTablePreset;
use Narsil\Base\Models\Users\TanStackTable;
use Narsil\Base\Services\TableRegistry;
use Narsil\Base\Support\TranslationsBag;

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
    )
    {
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

        $this->tableData->applyGlobalFilter($query);
        $this->tableData->applyColumnFilters($query);
        $this->tableData->applySorting($query);

        $paginated = $query->paginate(
            perPage: $tanStackTable->{TanStackTable::PAGE_SIZE} ?? 10,
            page: request(self::PAGE, 1),
        );

        parent::__construct($paginated);

        $this->registerTranslations();
    }

    #endregion

    #region CONSTANTS

    /**
     * @var string
     */
    public const PAGE = 'page';

    /**
     * @var string
     */
    public const PRESET = 'preset';

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
            ],
        ];
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return void
     */
    protected function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::data-table.column')
            ->add('narsil::data-table.columns')
            ->add('narsil::data-table.delete_selected')
            ->add('narsil::data-table.deselect_all')
            ->add('narsil::data-table.duplicate_selected')
            ->add('narsil::data-table.empty')
            ->add('narsil::data-table.filter')
            ->add('narsil::data-table.filters')
            ->add('narsil::data-table.operator')
            ->add('narsil::data-table.pagination')
            ->add('narsil::data-table.preset')
            ->add('narsil::data-table.results')
            ->add('narsil::data-table.select_all')
            ->add('narsil::data-table.selection_empty')
            ->add('narsil::data-table.selection')
            ->add('narsil::dialogs.descriptions.delete')
            ->add('narsil::dialogs.titles.delete')
            ->add('narsil::pagination.first_page')
            ->add('narsil::pagination.last_page')
            ->add('narsil::pagination.more')
            ->add('narsil::pagination.next_page')
            ->add('narsil::pagination.previous_page')
            ->add('narsil::placeholders.choose')
            ->add('narsil::placeholders.search')
            ->add('narsil::ui.apply')
            ->add('narsil::ui.cancel')
            ->add('narsil::ui.close')
            ->add('narsil::ui.confirm')
            ->add('narsil::ui.create')
            ->add('narsil::ui.delete')
            ->add('narsil::ui.duplicate')
            ->add('narsil::ui.edit')
            ->add('narsil::ui.hide')
            ->add('narsil::ui.menu')
            ->add('narsil::ui.move')
            ->add('narsil::ui.move_down')
            ->add('narsil::ui.move_up')
            ->add('narsil::ui.reset')
            ->add('narsil::ui.settings')
            ->add('narsil::ui.show')
            ->add('narsil::ui.sort');

        foreach (OperatorEnum::values() as $value)
        {
            app(TranslationsBag::class)
                ->add('narsil::operators.' . $value);
        }
    }

    #endregion
}
