<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Models\AiProvider;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\Setting;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserBookmark;
use Narsil\Base\Models\Users\UserConfiguration;

#endregion

return [
    AiProvider::TABLE => 'fournisseur IA|fournisseurs IA',
    Asset::TABLE => 'ressource|ressources',
    Permission::TABLE => 'permission|permissions',
    Role::TABLE => 'role|roles',
    Setting::TABLE => 'paramètre|paramètres',
    User::TABLE => 'utilisateur|utilisateurs',
    UserBookmark::TABLE => 'signet|signets',
    UserConfiguration::TABLE => 'paramètres|paramètres',
];
