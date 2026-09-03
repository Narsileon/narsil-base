<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\ModelEventEnum;

#endregion

return [
    'success' => [
        ModelEventEnum::CREATED->value => 'Le :model a été créé avec succès.',
        ModelEventEnum::DELETED_MANY->value => 'Les :table ont été supprimés avec succès.',
        ModelEventEnum::DELETED->value => 'Le :model a été supprimé avec succès.',
        ModelEventEnum::REPLICATED_MANY->value => 'Les :table ont été dupliqués avec succès.',
        ModelEventEnum::REPLICATED->value => 'Le :model a été dupliqué avec succès.',
        ModelEventEnum::RESTORED->value => 'Le :model a été restauré avec succès.',
        ModelEventEnum::UPDATED->value => 'Le :model a été mis à jour avec succès.',

        'logged_in'            => 'Vous vous êtes connecté avec succès.',
        'logged_out_all'       => 'Vous vous êtes déconnecté de tous les appareils avec succès.',
        'logged_out_current'   => 'Vous vous êtes déconnecté de cet appareil avec succès.',
        'logged_out_others'    => 'Vous vous êtes déconnecté des autres appareils avec succès.',
        'logged_out'           => 'Vous vous êtes déconnecté avec succès.',
        'password_confirmed'   => 'Votre mot de passe a été confirmé avec succès.',
        'password_updated'     => 'Votre mot de passe a été mis à jour avec succès.',
        'profile_updated'      => 'Votre profil a été mis à jour avec succès.',
        'two_factor_confirmed' => 'Votre authentification à deux facteurs a été confirmée avec succès.',
        'two_factor_disabled'  => 'Votre authentification à deux facteurs a été désactivée avec succès.',
    ],
];
