<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableInput extends Component
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
        $this->state = $this->resolveState($payload);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $payload;

    /**
     * @var mixed
     */
    public readonly mixed $state;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-input');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $payload
     *
     * @return array<string,mixed>
     */
    private function resolveState(mixed $payload): array
    {
        $state = Arr::get($payload, 'meta.state', []);
        $resolvedState = [];

        if (is_object($state) && method_exists($state, 'toArray'))
        {
            $resolvedState = $state->toArray();
        }
        else
        {
            $resolvedState = (array) $state;
        }

        return $resolvedState;
    }

    #endregion
}
