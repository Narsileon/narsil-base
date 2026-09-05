<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\Forms\AssetForm as Contract;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\FileInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Services\RouteService;

#endregion

class AssetForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     *
     * @param string $disk
     */
    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this
            ->enctype('multipart/form-data')
            ->routes(RouteService::getNames(Asset::TABLE));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        return [
            new FormStepData(
                elements: [
                    new FieldData(
                        id: 'file',
                        required: true,
                        input: new FileInputData(),
                    ),
                    new FieldData(
                        id: Asset::ALT,
                        input: new TextInputData(),
                    ),
                ],
            ),
        ];
    }

    #endregion
}
