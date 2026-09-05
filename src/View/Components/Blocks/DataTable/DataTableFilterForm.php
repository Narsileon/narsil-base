<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableFilterForm extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $payload
     * @param array<string,mixed>|null $filter
     *
     * @return void
     */
    public function __construct(
        mixed $payload,
        ?array $filter = null,
    )
    {
        $this->filter = $filter;
        $this->hasFilter = $filter !== null;
        $this->payload = $payload;
        $this->uuid = $this->resolveUuid($payload);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>|null
     */
    public readonly ?array $filter;

    /**
     * @var boolean
     */
    public readonly bool $hasFilter;

    /**
     * @var mixed
     */
    public readonly mixed $payload;

    /**
     * @var string|null
     */
    public readonly ?string $uuid;

    #endregion

    #region PUBLIC METHODS

    /**
     * Return the available column filter options.
     *
     * @return array<int,array<string,string>>
     */
    public function columnOptions(): array
    {
        return collect(Arr::get($this->payload, 'meta.columns', []))
            ->map(function ($column): array
            {
                $column = $this->normalizeColumn($column);
                $header = Arr::get($column, 'header');

                if ($header === null)
                {
                    $header = Arr::get($column, 'id');
                }

                return [
                    'label' => ucfirst((string) $header),
                    'value' => (string) Arr::get($column, 'id'),
                ];
            })
            ->values()
            ->all();
    }

    /**
     * Return the selected column filter column.
     *
     * @return string|null
     */
    public function columnValue(): ?string
    {
        $value = Arr::get($this->filter, 'column_id');

        return $value === null
            ? ($this->columnOptions()[0]['value'] ?? null)
            : (string) $value;
    }

    /**
     * Return the available filter operator options.
     *
     * @return array<int,array<string,string>>
     */
    public function operatorOptions(): array
    {
        return collect(['contains', 'equals', 'starts_with', 'ends_with'])
            ->map(function (string $operator): array
            {
                return [
                    'label' => trans('narsil::operators.' . $operator),
                    'value' => $operator,
                ];
            })
            ->all();
    }

    /**
     * Return the selected column filter operator.
     *
     * @return string|null
     */
    public function operatorValue(): ?string
    {
        $value = Arr::get($this->filter, 'operator_value');

        return $value === null
            ? ($this->operatorOptions()[0]['value'] ?? null)
            : (string) $value;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-filter-form');
    }

    /**
     * Return the selected column filter value.
     *
     * @return string
     */
    public function value(): string
    {
        return (string) Arr::get($this->filter, 'value', '');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $column
     *
     * @return array<string,mixed>
     */
    private function normalizeColumn(mixed $column): array
    {
        if (is_object($column) && method_exists($column, 'toArray'))
        {
            return $column->toArray();
        }

        return (array) $column;
    }

    /**
     * @param mixed $payload
     *
     * @return string|null
     */
    private function resolveUuid(mixed $payload): ?string
    {
        $uuid = Arr::get($payload, 'meta.state.uuid');

        return $uuid === null ? null : (string) $uuid;
    }

    #endregion
}
