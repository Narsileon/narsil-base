<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\User;

#endregion

return [
    Permission::TABLE => [
        Permission::LABEL => 'Die den Benutzern angezeigte Bezeichnung.',
        Permission::NAME => 'Der interne Name für die Berechtigung.',
    ],
    Role::TABLE => [
        Role::LABEL => 'Die den Benutzern angezeigte Bezeichnung.',
        Role::NAME => 'Der interne Name für die Rolle.',
    ],
    User::TABLE => [
        'code' => 'Bitte scannen Sie den folgenden QR-Code mit der Authentifizierungs-App auf Ihrem Smartphone und geben Sie anschließend den Code ein.',
        'recovery_codes' => 'Bewahren Sie diese Wiederherstellungscodes an einem sicheren Ort auf. Sie können sie verwenden, um auf Ihr Konto zuzugreifen, falls Sie den Zugriff auf Ihr Zwei-Faktor-Authentifizierungsgerät verlieren.',
    ],
];
