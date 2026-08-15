<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms;

#region USE

use Narsil\Base\Contracts\Forms\UserBookmarkForm as Contract;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\Users\UserBookmark;

#endregion

class UserBookmarkForm extends Form implements Contract
{
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
                        id: UserBookmark::NAME,
                        required: true,
                        input: new TextInputData(),
                    ),
                ],
            ),
        ];
    }

    #endregion
}
