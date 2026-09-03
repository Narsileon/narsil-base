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
    Asset::TABLE => 'Asset|Assets',
    Permission::TABLE => 'Berechtigung|Berechtigungen',
    Role::TABLE => 'Rolle|Rollen',
    User::TABLE => 'Benutzer|Benutzer',
    UserBookmark::TABLE => 'Lesezeichen|Lesezeichen',
    UserConfiguration::TABLE => 'Einstellungen|Einstellungen',
];
