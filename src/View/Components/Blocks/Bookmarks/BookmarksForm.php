<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Bookmarks;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class BookmarksForm extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $updateUrl
     *
     * @return void
     */
    public function __construct(
        mixed $updateUrl = ''
    )
    {
        $this->updateUrl = $updateUrl;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $updateUrl;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.bookmarks.bookmarks-form');
    }

    #endregion
}
