<?php

namespace Narsil\Base\Http\Controllers\Users;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Contracts\Forms\UserForm;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\User;
use Narsil\Base\Services\ModelService;

#endregion

class UserCreateController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $this->authorize(AbilityEnum::CREATE, User::class);

        $form = $this->getForm();

        return $this->render('narsil/base::resources/form', [
            'form' => $form,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel(User::TABLE);
    }

    /**
     * Get the associated form.
     *
     * @return UserForm
     */
    protected function getForm(): UserForm
    {
        $form = app(UserForm::class)
            ->action(route('users.store'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.save'));

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(User::TABLE);
    }

    #endregion
}
