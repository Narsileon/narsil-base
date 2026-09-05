<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Pagination;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class PaginationRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $links
     * @param array<int,array<string,mixed>> $metaLinks
     *
     * @return void
     */
    public function __construct(
        array $links = [],
        array $metaLinks = []
    )
    {
        $this->links = $links;
        $this->metaLinks = $metaLinks;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $links;

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $metaLinks;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.pagination.pagination-root');
    }

    #endregion
}
