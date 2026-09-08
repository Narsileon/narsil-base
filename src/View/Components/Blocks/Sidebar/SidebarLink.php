<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sidebar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SidebarLink extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $item
     *
     * @return void
     */
    public function __construct(
        mixed $item
    )
    {
        $url = $this->getUrl($item);

        $this->active = $this->isActive($url);
        $this->item = $item;
        $this->url = $url;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var boolean
     */
    public readonly bool $active;

    /**
     * @var mixed
     */
    public readonly mixed $item;

    /**
     * @var string
     */
    public readonly string $url;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.sidebar.sidebar-link');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $item
     *
     * @return string
     */
    private function getUrl(mixed $item): string
    {
        return route($item['route'], $item['parameters'] ?? []);
    }

    /**
     * @param string $url
     *
     * @return boolean
     */
    private function isActive(string $url): bool
    {
        return str_ends_with($url, request()->getPathInfo());
    }

    #endregion
}
