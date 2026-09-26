<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Sidebar;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

#endregion

final class SidebarSwitcher extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $items
     * @param string $name
     *
     * @return void
     */
    public function __construct(
        mixed $items = [],
        string $name = 'cms'
    ) {
        $this->items = $items;
        $this->name = $name;
        $this->label = $this->resolveLabel();
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $items;

    /**
     * @var string
     */
    public readonly string $label;

    /**
     * @var string
     */
    public readonly string $name;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.sidebar.sidebar-switcher');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return string
     */
    private function resolveLabel(): string
    {
        $currentItem = Collection::make($this->items)
            ->firstWhere('route', request()->route()?->getName());
        $label = Arr::get($currentItem, 'label', Arr::get($this->items, '0.label', 'Home'));

        if ($this->name === 'cms')
        {
            $label = 'CMS';
        }

        if (!is_string($label))
        {
            $label = 'Home';
        }

        return $label;
    }

    #endregion
}
