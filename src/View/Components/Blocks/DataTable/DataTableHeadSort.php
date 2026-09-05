<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableHeadSort extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $column
     * @param mixed $payload
     *
     * @return void
     */
    public function __construct(
        array $column,
        mixed $payload
    )
    {
        $this->column = $column;
        $current = $this->resolveCurrent($column, $payload);
        $this->current = $current;
        $this->icon = $this->resolveIcon($current);
        $this->tooltip = $this->resolveTooltip($current);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $column;

    /**
     * The current sort state for the column.
     *
     * @var array<string,mixed>|null
     */
    public readonly ?array $current;

    /**
     * The logical sort icon for the current column state.
     *
     * @var string
     */
    public readonly string $icon;

    /**
     * The label for the next sort action.
     *
     * @var string
     */
    public readonly string $tooltip;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-head-sort');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param array<string,mixed> $column
     * @param mixed $payload
     *
     * @return array<string,mixed>|null
     */
    private function resolveCurrent(array $column, mixed $payload): ?array
    {
        $state = Arr::get($payload, 'meta.state', []);

        if (is_object($state) && method_exists($state, 'toArray'))
        {
            $state = $state->toArray();
        }
        else
        {
            $state = (array) $state;
        }

        $current = collect(Arr::get($state, 'sorting', []))->firstWhere('id', $column['id']);

        if (is_object($current) && method_exists($current, 'toArray'))
        {
            $current = $current->toArray();
        }

        return is_array($current) ? $current : null;
    }

    /**
     * @param array<string,mixed>|null $current
     *
     * @return string
     */
    private function resolveIcon(?array $current): string
    {
        return match (true)
        {
            $current === null => 'sort',
            (bool) Arr::get($current, 'desc', false) => 'sort-down',
            default => 'sort-up',
        };
    }

    /**
     * @param array<string,mixed>|null $current
     *
     * @return string
     */
    private function resolveTooltip(?array $current): string
    {
        return match (true)
        {
            $current === null => trans('narsil::ui.sort_ascending'),
            (bool) Arr::get($current, 'desc', false) => trans('narsil::ui.unsort'),
            default => trans('narsil::ui.sort_descending'),
        };
    }

    #endregion
}
