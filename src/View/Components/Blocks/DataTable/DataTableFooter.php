<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableFooter extends Component
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
        $this->links = $this->resolveLinks($payload);
        $this->metaLinks = $this->resolveMetaLinks($payload);
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
    public readonly mixed $links;

    /**
     * @var mixed
     */
    public readonly mixed $metaLinks;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-footer');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    private function resolveLinks(mixed $payload): mixed
    {
        return Arr::get($payload, 'links', []) ?? [];
    }

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    private function resolveMetaLinks(mixed $payload): mixed
    {
        return Arr::get($payload, 'meta.links', []) ?? [];
    }

    #endregion
}
