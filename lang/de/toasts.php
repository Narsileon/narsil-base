<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\ModelEventEnum;

#endregion

return [
    'success' => [
        ModelEventEnum::CREATED->value => 'Das :model wurde erfolgreich erstellt.',
        ModelEventEnum::DELETED_MANY->value => 'Die :table wurden erfolgreich gelöscht.',
        ModelEventEnum::DELETED->value => 'Das :model wurde erfolgreich gelöscht.',
        ModelEventEnum::REPLICATED_MANY->value => 'Die :table wurden erfolgreich dupliziert.',
        ModelEventEnum::REPLICATED->value => 'Das :model wurde erfolgreich dupliziert.',
        ModelEventEnum::RESTORED->value => 'Das :model wurde erfolgreich wiederhergestellt.',
        ModelEventEnum::UPDATED->value => 'Das :model wurde erfolgreich aktualisiert.',

        'logged_in'            => 'Sie wurden erfolgreich angemeldet.',
        'logged_out_all'       => 'Sie wurden erfolgreich von allen Geräten abgemeldet.',
        'logged_out_current'   => 'Sie wurden erfolgreich von diesem Gerät abgemeldet.',
        'logged_out_others'    => 'Sie wurden erfolgreich von anderen Geräten abgemeldet.',
        'logged_out'           => 'Sie wurden erfolgreich abgemeldet.',
        'password_confirmed'   => 'Ihr Passwort wurde erfolgreich bestätigt.',
        'password_updated'     => 'Ihr Passwort wurde erfolgreich aktualisiert.',
        'profile_updated'      => 'Ihr Profil wurde erfolgreich aktualisiert.',
        'two_factor_confirmed' => 'Ihre Zwei-Faktor-Authentifizierung wurde erfolgreich bestätigt.',
        'two_factor_disabled'  => 'Ihre Zwei-Faktor-Authentifizierung wurde erfolgreich deaktiviert.',
    ],
];
