<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Settings;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Narsil\Base\Contracts\Requests\SettingsFormRequest;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\Setting;
use Narsil\Base\Services\ModelService;

#endregion

class SettingsUpdateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param SettingsFormRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(SettingsFormRequest $request): RedirectResponse
    {
        $this->authorize(AbilityEnum::UPDATE, new Setting());

        DB::transaction(function () use ($request): void
        {
            foreach ($request->validated() as $handle => $value)
            {
                Setting::setValue($handle, (string) $value);
            }
        });

        return back()
            ->with('success', ModelService::getSuccessMessage(Setting::TABLE, ModelEventEnum::UPDATED));
    }

    #endregion
}
