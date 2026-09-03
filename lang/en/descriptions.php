<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\User;

#endregion

return [
    Permission::TABLE => [
        Permission::LABEL => 'The display label shown to users.',
        Permission::NAME => 'The internal name for the permission.',
    ],
    Role::TABLE => [
        Role::LABEL => 'The display label shown to users.',
        Role::NAME => 'The internal name for the role.',
    ],
    User::TABLE => [
        'code' => 'Please scan the following QR code using your phone\'s authenticator application and enter your code.',
        'recovery_codes' => 'Store these recovery codes in a safe place. You can use them to access your account if your two-factor authentication device is lost.',
    ],
];
