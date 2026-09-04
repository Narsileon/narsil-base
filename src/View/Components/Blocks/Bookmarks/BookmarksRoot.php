<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Bookmarks;

#region USE

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

#endregion

final class BookmarksRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<int,array<string,mixed>> $breadcrumb
     *
     * @return void
     */
    public function __construct(array $breadcrumb = [])
    {
        $this->breadcrumb = $breadcrumb;
        $this->currentUrl = url()->current();
        $this->destroyUrl = route('user-bookmarks.destroy', '__bookmark__');
        $this->indexUrl = route('user-bookmarks.index');
        $this->storeUrl = route('user-bookmarks.store');
        $this->updateUrl = route('user-bookmarks.update', '__bookmark__');
        $this->title = trans('narsil::bookmarks.menu');
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $breadcrumb;

    /**
     * @var string
     */
    public readonly string $currentUrl;

    /**
     * @var string
     */
    public readonly string $destroyUrl;

    /**
     * @var string
     */
    public readonly string $indexUrl;

    /**
     * @var string
     */
    public readonly string $storeUrl;

    /**
     * @var string
     */
    public readonly string $updateUrl;

    /**
     * @var string
     */
    public readonly string $title;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.bookmarks.bookmarks-root');
    }

    #endregion
}
