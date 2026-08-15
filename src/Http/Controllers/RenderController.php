<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers;

#region USE

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\PropsResolver;
use Inertia\Response;
use Narsil\Base\Support\TranslationsBag;

#endregion

abstract class RenderController
{
    use AuthorizesRequests;

    #region CONSTANTS

    /**
     * The "modal" parameter.
     *
     * @var string
     */
    protected const MODAL = '_modal';

    #region • PROPS

    /**
     * The name of the "component" prop.
     *
     * @var string
     */
    protected const COMPONENT = 'component';

    /**
     * The name of the "description" prop.
     *
     * @var string
     */
    protected const DESCRIPTION = 'description';

    /**
     * The name of the "props" prop.
     *
     * @var string
     */
    protected const PROPS = 'props';

    /**
     * The name of the "title" prop.
     *
     * @var string
     */
    protected const TITLE = 'title';

    /**
     * The name of the "translations" prop.
     *
     * @var string
     */
    protected const TRANSLATIONS = 'translations';

    #endregion

    #endregion

    #region PROTECTED METHODS

    /**
     * Get the description of the page.
     *
     * @return string
     */
    abstract protected function getDescription(): string;

    /**
     * Get the title of the page.
     *
     * @return string
     */
    abstract protected function getTitle(): string;

    /**
     * @param string $component
     * @param array $props
     *
     * @return JsonResponse|Response
     */
    protected function render(string $component, array $props = []): JsonResponse|Response
    {
        if (request()->boolean(self::MODAL))
        {
            $resolver = new PropsResolver(request(), $component);

            $props = $resolver->resolve([], $props)[0];

            $translations = app(TranslationsBag::class)
                ->add('narsil::ui.cancel')
                ->add('narsil::ui.close')
                ->get();

            return response()->json([
                self::COMPONENT => $component,
                self::PROPS => array_merge([
                    self::DESCRIPTION => $this->getDescription(),
                    self::MODAL => true,
                    self::TITLE => $this->getTitle(),
                    self::TRANSLATIONS => $translations,
                ], $props),
            ]);
        }
        else
        {
            $translations = app(TranslationsBag::class)
                ->get();

            return Inertia::render($component, [
                self::DESCRIPTION => $this->getDescription(),
                self::TITLE => $this->getTitle(),
                self::TRANSLATIONS => $translations,
                ...$props
            ]);
        }
    }

    #endregion
}
