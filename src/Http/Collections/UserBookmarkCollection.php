<?php

namespace Narsil\Base\Http\Collections;

#region USE

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;
use Narsil\Base\Contracts\Forms\UserBookmarkForm;
use Narsil\Base\Models\Users\UserBookmark;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Support\TranslationsBag;

#endregion

class UserBookmarkCollection extends ResourceCollection
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function toArray(Request $request): JsonSerializable
    {
        return $this->collection->map(function ($item)
        {
            return [
                UserBookmark::NAME => $item->{UserBookmark::NAME},
                UserBookmark::URL => $item->{UserBookmark::URL},
                UserBookmark::UUID => $item->{UserBookmark::UUID},
            ];
        });
    }

    /**
     * {@inheritDoc}
     */
    public function with($request): array
    {
        return [
            'meta' => $this->getMeta(),
        ];
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return array<string,mixed>
     */
    protected function getMeta(): array
    {
        $translations = app(TranslationsBag::class)
            ->add('narsil::bookmarks.empty')
            ->add('narsil::bookmarks.menu')
            ->add('narsil::ui.add')
            ->add('narsil::ui.cancel')
            ->add('narsil::ui.delete')
            ->add('narsil::ui.edit')
            ->get();

        return [
            'title' => ModelService::getTableLabel(UserBookmark::TABLE),
            'description' => ModelService::getTableLabel(UserBookmark::TABLE),
            'form' => app(UserBookmarkForm::class),
            'translations' => $translations,
        ];
    }

    #endregion
}
