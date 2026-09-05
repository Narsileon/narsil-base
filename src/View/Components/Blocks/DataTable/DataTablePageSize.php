<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTablePageSize extends Component
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
        $this->uuid = $this->resolveUuid($this->state);
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

    /**
     * @var mixed
     */
    public readonly mixed $uuid;

    #endregion

    #region PUBLIC METHODS

    /**
     * Return the available page sizes.
     *
     * @return array<int,array<string,string>>
     */
    public function options(): array
    {
        return array_map(
            static function (int $size): array
            {
                return [
                'label' => (string) $size,
                'value' => (string) $size,
                ];
            },
            [10, 25, 50, 100],
        );
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-page-size');
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

    /**
     * @param array<string,mixed> $state
     *
     * @return mixed
     */
    private function resolveUuid(array $state): mixed
    {
        return Arr::get($state, 'uuid');
    }

    #endregion
}
