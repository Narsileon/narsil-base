<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Menus;

#region USE

use Narsil\Base\Contracts\Menus\Home as Contract;
use Narsil\Base\Implementations\Menu;
use Narsil\Base\Support\MenuItem;

#endregion

class Home extends Menu implements Contract
{
    #region PROTECTED METHODS

    /**
     * @return void
     */
    protected function addHomeItem(): void
    {
        $ids = array_map(
            static fn (MenuItem $menuItem): string => $menuItem->id,
            $this->menuItems
        );

        if (!in_array('home', $ids, true))
        {
            $this->add(
                new MenuItem('home')->icon('narsil')
                    ->label('Home')
                    ->route('narsil.home')
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function content(): array
    {
        $this->addHomeItem();

        return parent::content();
    }

    #endregion
}
