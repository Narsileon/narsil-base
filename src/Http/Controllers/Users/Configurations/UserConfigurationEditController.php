<?php

namespace Narsil\Base\Http\Controllers\Users\Configurations;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Narsil\Base\Contracts\Forms\Fortify\ProfileForm;
use Narsil\Base\Contracts\Forms\Fortify\TwoFactorForm;
use Narsil\Base\Contracts\Forms\Fortify\UpdatePasswordForm;
use Narsil\Base\Contracts\Forms\UserConfigurationForm;
use Narsil\Base\Contracts\Resources\UserResource;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\Users\UserConfiguration;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Support\TranslationsBag;

#endregion

class UserConfigurationEditController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $user = Auth::user();

        $auth = $user ? app(UserResource::class, [
            'resource' => $user
        ]) : null;

        $profileForm = app(ProfileForm::class);
        $twoFactorForm = app(TwoFactorForm::class);
        $updatePasswordForm = app(UpdatePasswordForm::class);
        $userConfigurationForm = app(UserConfigurationForm::class);

        app(TranslationsBag::class)
            ->add('narsil::sessions.sign_out_current.description')
            ->add('narsil::sessions.sign_out_current.label')
            ->add('narsil::sessions.sign_out_elsewhere.description')
            ->add('narsil::sessions.sign_out_elsewhere.label')
            ->add('narsil::sessions.sign_out_everywhere.description')
            ->add('narsil::sessions.sign_out_everywhere.label')
            ->add('narsil::ui.account')
            ->add('narsil::ui.password')
            ->add('narsil::ui.personalization')
            ->add('narsil::ui.security')
            ->add('narsil::ui.sessions');

        return $this->render('narsil/base::users/settings', [
            'auth' => $auth,
            'profileForm' => $profileForm,
            'twoFactorForm' => $twoFactorForm,
            'updatePasswordForm' => $updatePasswordForm,
            'userConfigurationForm' => $userConfigurationForm,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel(UserConfiguration::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(UserConfiguration::TABLE);
    }

    #endregion
}
