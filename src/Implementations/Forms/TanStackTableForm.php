<?php

namespace Narsil\Base\Implementations\Forms;

#region USE

use Narsil\Base\Contracts\Forms\UserBookmarkForm as Contract;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\Users\TanStackTable;

#endregion

class TanStackTableForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('table-form');
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
                        id: TanStackTable::NAME,
                        required: true,
                        input: new TextInputData(),
                    ),
                ],
            ),
        ];
    }

    #endregion
}
