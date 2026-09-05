<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableSelection extends Component
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
        $this->payload = $payload;
        $this->total = $this->resolveTotal($payload);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $payload;

    /**
     * @var int
     */
    public readonly int $total;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-selection');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $payload
     *
     * @return int
     */
    private function resolveTotal(mixed $payload): int
    {
        $total = Arr::get($payload, 'meta.total');
        $resolvedTotal = $total;

        if (!$resolvedTotal)
        {
            $resolvedTotal = count(Arr::get($payload, 'data', []));
        }

        return $resolvedTotal;
    }

    #endregion
}
