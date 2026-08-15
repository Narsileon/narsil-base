<?php

namespace Narsil\Base\Contracts;

/**
 * @property string $action
 * @property boolean $autoSave
 * @property string $defaultLanguage
 * @property string $id
 * @property string $method
 * @property array $options
 * @property array $routes
 * @property string $submitIcon
 * @property string $submitLabel
 *
 * @method $this action(string $id)
 * @method $this autoSave(boolean $autoSave)
 * @method $this defaultLanguage(string $defaultLanguage)
 * @method $this id(string $id)
 * @method $this method(string $method)
 * @method $this options(array $options)
 * @method $this routes(array $routes)
 * @method $this submitIcon(string $submitIcon)
 * @method $this submitLabel(string $submitLabel)
 */
interface Form
{
    #region PUBLIC METHODS

    /**
     * Set the language options of the form.
     *
     * @param array $locales
     *
     * @return static
     */
    public function languages(array $locales): static;

    #endregion
}
