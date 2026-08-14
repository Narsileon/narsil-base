<?php

namespace Narsil\Base\Implementations\Requests;

#region USE

use Illuminate\Foundation\Http\FormRequest;
use Narsil\Base\Contracts\Requests\UserBookmarkFormRequest as Contract;
use Narsil\Base\Models\Users\UserBookmark;
use Narsil\Base\Validation\FormRule;

#endregion

class UserBookmarkFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            UserBookmark::NAME => [
                FormRule::STRING,
                FormRule::REQUIRED,
            ],
            UserBookmark::URL => [
                FormRule::STRING,
                FormRule::SOMETIMES,
            ],
        ];
    }

    #endregion
}
