<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableResults extends Component
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
        $this->meta = $this->resolveMeta($payload);
        $this->from = $this->resolveFrom($this->meta);
        $this->to = $this->resolveTo($this->meta);
        $this->total = $this->resolveTotal($this->meta);
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
    public readonly array $meta;

    /**
     * @var integer
     */
    public readonly int $from;

    /**
     * @var integer
     */
    public readonly int $to;

    /**
     * @var integer
     */
    public readonly int $total;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-results');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    private function resolveFrom(array $meta): int
    {
        $from = Arr::get($meta, 'from', 1);

        return is_numeric($from) ? (int) $from : 1;
    }

    /**
     * @param array<string,mixed> $meta
     *
     * @return int
     */
    private function resolveTo(array $meta): int
    {
        $to = Arr::get($meta, 'to', Arr::get($meta, 'total', 0));

        return is_numeric($to) ? (int) $to : 0;
    }

    /**
     * @param array<string,mixed> $meta
     *
     * @return int
     */
    private function resolveTotal(array $meta): int
    {
        $total = Arr::get($meta, 'total', 0);

        return is_numeric($total) ? (int) $total : 0;
    }

    /**
     * @param mixed $payload
     *
     * @return array<string,mixed>
     */
    private function resolveMeta(mixed $payload): array
    {
        $meta = Arr::get($payload, 'meta', []);

        return is_array($meta) ? $meta : (array) $meta;
    }

    #endregion
}
