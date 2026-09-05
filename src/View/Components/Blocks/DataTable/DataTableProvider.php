<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableProvider extends Component
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
        $this->idsJson = $this->resolveIdsJson($payload);
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
    public readonly mixed $idsJson;

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
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-provider');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    private function resolveIdsJson(mixed $payload): mixed
    {
        $ids = [];

        foreach (Arr::get($payload, 'data', []) as $row)
        {
            $ids[] = (string) Arr::get($row, 'id', Arr::get($row, 'uuid'));
        }

        return json_encode($ids);
    }

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
