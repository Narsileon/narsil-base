<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\User;

#endregion

return [
    Permission::TABLE => [
        Permission::LABEL => 'Le libellé affiché aux utilisateurs.',
        Permission::NAME => 'Le nom interne de la permission.',
    ],
    Role::TABLE => [
        Role::LABEL => 'Le libellé affiché aux utilisateurs.',
        Role::NAME => 'Le nom interne du rôle.',
    ],
    User::TABLE => [
        'code' => 'Veuillez scanner le code QR suivant à l\'aide de l\'application d\'authentification sur votre téléphone et saisir ensuite votre code.',
        'recovery_codes' => 'Conservez ces codes de récupération dans un endroit sûr. Vous pouvez les utiliser pour accéder à votre compte si vous perdez votre appareil d\'authentification à deux facteurs.',
    ],
];
