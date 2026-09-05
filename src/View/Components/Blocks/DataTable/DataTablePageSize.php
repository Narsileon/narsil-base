<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
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
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $payload;

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
}
