<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

#endregion

final class DataTableColumns extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $payload
     *
     * @return void
     */
    public function __construct(
        mixed $payload
    )
    {
        $meta = $this->resolveMeta($payload);
        $state = $this->resolveState($meta);

        $this->columns = $this->resolveColumns($meta, $state);
        $this->payload = $payload;
        $this->state = $state;
        $this->uuid = $this->resolveUuid($state);
        $this->visible = $this->resolveVisible($state);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $payload;

    /**
     * @var Collection<int,array<string,mixed>>
     */
    public readonly Collection $columns;

    /**
     * @var mixed
     */
    public readonly mixed $state;

    /**
     * @var mixed
     */
    public readonly mixed $uuid;

    /**
     * @var mixed
     */
    public readonly mixed $visible;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-columns');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $state
     *
     * @return array<string,mixed>
     */
    private function normalizeState(mixed $state): array
    {
        $normalizedState = [];

        if (is_object($state) && method_exists($state, 'toArray'))
        {
            $normalizedState = $state->toArray();
        }
        else
        {
            $normalizedState = (array) $state;
        }

        return $normalizedState;
    }

    /**
     * @param array<string,mixed> $meta
     * @param array<string,mixed> $state
     *
     * @return Collection<int,array<string,mixed>>
     */
    private function resolveColumns(array $meta, array $state): Collection
    {
        $columns = collect(Arr::get($meta, 'columns', []))->map(
            function ($column): array
            {
                if (is_object($column) && method_exists($column, 'toArray'))
                {
                    return $column->toArray();
                }

                return (array) $column;
            },
        );
        $order = Arr::get($state, 'column_order', []);

        return collect($order)
            ->map(function ($id) use ($columns)
            {
                return $columns->firstWhere('id', $id);
            })
            ->filter()
            ->merge($columns->reject(function (array $column) use ($order): bool
            {
                return in_array($column['id'], $order, true);
            }));
    }

    /**
     * @param mixed $payload
     *
     * @return array<string,mixed>
     */
    private function resolveMeta(mixed $payload): array
    {
        $meta = Arr::get($payload, 'meta', []);
        $resolvedMeta = [];

        if (is_array($meta))
        {
            $resolvedMeta = $meta;
        }
        else
        {
            $resolvedMeta = (array) $meta;
        }

        return $resolvedMeta;
    }

    /**
     * @param array<string,mixed> $meta
     *
     * @return array<string,mixed>
     */
    private function resolveState(array $meta): array
    {
        return $this->normalizeState(Arr::get($meta, 'state', []));
    }

    /**
     * @param array<string,mixed> $state
     *
     * @return mixed
     */
    private function resolveUuid(array $state): mixed
    {
        return Arr::get($state, 'uuid');
    }

    /**
     * @param array<string,mixed> $state
     *
     * @return mixed
     */
    private function resolveVisible(array $state): mixed
    {
        return Arr::get($state, 'column_visibility', []);
    }

    #endregion
}
