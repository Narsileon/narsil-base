<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\ModelEventEnum;

#endregion

return [
    'success' => [
        ModelEventEnum::CREATED->value => 'The :model has been successfully created.',
        ModelEventEnum::DELETED_MANY->value => 'The :table have been successfully deleted.',
        ModelEventEnum::DELETED->value => 'The :model has been successfully deleted.',
        ModelEventEnum::REPLICATED_MANY->value => 'The :table have been successfully duplicated.',
        ModelEventEnum::REPLICATED->value => 'The :model has been successfully duplicated.',
        ModelEventEnum::RESTORED->value => 'The :model has been successfully restored.',
        ModelEventEnum::UPDATED->value => 'The :model has been successfully updated.',

        'logged_in'            => 'You have been successfully logged in.',
        'logged_out_all'       => 'You have been successfully logged out from all devices.',
        'logged_out_current'   => 'You have been successfully logged out from this device.',
        'logged_out_others'    => 'You have been successfully logged out from other devices.',
        'logged_out'           => 'You have been successfully logged out.',
        'password_confirmed'   => 'Your password has been successfully confirmed.',
        'password_updated'     => 'Your password has been successfully updated.',
        'profile_updated'      => 'Your profile has been successfully updated.',
        'two_factor_confirmed' => 'Your two factor authentication has been successfully confirmed.',
        'two_factor_disabled'  => 'Your two factor authentication has been successfully disabled.',
    ],
];
