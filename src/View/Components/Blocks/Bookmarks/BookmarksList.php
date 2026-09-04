<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Bookmarks;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class BookmarksList extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $breadcrumb
     * @param mixed $currentUrl
     * @param mixed $destroyUrl
     * @param mixed $storeUrl
     * @param mixed $title
     *
     * @return void
     */
    public function __construct(
        mixed $breadcrumb = [],
        mixed $currentUrl = '',
        mixed $destroyUrl = '',
        mixed $storeUrl = '',
        mixed $title = ''
    )
    {
        $this->breadcrumb = $breadcrumb;
        $this->currentUrl = $currentUrl;
        $this->destroyUrl = $destroyUrl;
        $this->storeUrl = $storeUrl;
        $this->title = $title;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $breadcrumb;

    /**
     * @var mixed
     */
    public readonly mixed $currentUrl;

    /**
     * @var mixed
     */
    public readonly mixed $destroyUrl;

    /**
     * @var mixed
     */
    public readonly mixed $storeUrl;

    /**
     * @var mixed
     */
    public readonly mixed $title;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.bookmarks.bookmarks-list');
    }

    #endregion
}
