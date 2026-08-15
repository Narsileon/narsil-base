<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Policies\Roles;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Contracts\Forms\RoleForm;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Services\ModelService;

#endregion

class RoleCreateController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $this->authorize(AbilityEnum::CREATE, Role::class);

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
        return ModelService::getModelLabel(Role::TABLE);
    }

    /**
     * Get the associated form.
     *
     * @return RoleForm
     */
    protected function getForm(): RoleForm
    {
        $form = app(RoleForm::class)
            ->action(route('roles.store'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.save'));

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(Role::TABLE);
    }

    #endregion
}
