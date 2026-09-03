<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserBookmark;
use Narsil\Base\Models\Users\UserConfiguration;

#endregion

return [
    Asset::TABLE => 'asset|assets',
    Permission::TABLE => 'permission|permissions',
    Role::TABLE => 'role|roles',
    User::TABLE => 'user|users',
    UserBookmark::TABLE => 'bookmark|bookmarks',
    UserConfiguration::TABLE => 'settings|settings',
];
