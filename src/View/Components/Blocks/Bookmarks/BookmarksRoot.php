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
        $this->currentUrl = $this->resolveCurrentUrl();
        $this->destroyUrl = $this->resolveDestroyUrl();
        $this->indexUrl = $this->resolveIndexUrl();
        $this->storeUrl = $this->resolveStoreUrl();
        $this->title = $this->resolveTitle();
        $this->updateUrl = $this->resolveUpdateUrl();
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

    #region PRIVATE METHODS

    /**
     * @return string
     */
    private function resolveCurrentUrl(): string
    {
        return url()->current();
    }

    /**
     * @return string
     */
    private function resolveDestroyUrl(): string
    {
        return route('user-bookmarks.destroy', '__bookmark__');
    }

    /**
     * @return string
     */
    private function resolveIndexUrl(): string
    {
        return route('user-bookmarks.index');
    }

    /**
     * @return string
     */
    private function resolveStoreUrl(): string
    {
        return route('user-bookmarks.store');
    }

    /**
     * @return string
     */
    private function resolveTitle(): string
    {
        return trans('narsil::bookmarks.menu');
    }

    /**
     * @return string
     */
    private function resolveUpdateUrl(): string
    {
        return route('user-bookmarks.update', '__bookmark__');
    }

    #endregion
}
