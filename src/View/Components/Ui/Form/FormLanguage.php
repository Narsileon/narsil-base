<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormLanguage extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $languages
     * @param mixed $value
     * @param mixed $defaultLanguage
     *
     * @return void
     */
    public function __construct(
        mixed $languages = [],
        mixed $value = null,
        mixed $defaultLanguage = null
    )
    {
        $orderedLanguages = $this->getOrderedLanguages($languages, $defaultLanguage);

        $this->defaultLanguage = (string) $defaultLanguage;
        $this->languages = $orderedLanguages;
        $this->selectedLanguage = $this->getSelectedLanguage($orderedLanguages, $value);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly array $languages;

    /**
     * @var string
     */
    public readonly string $defaultLanguage;

    /**
     * @var mixed
     */
    public readonly string $selectedLanguage;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-language');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $languages
     * @param mixed $defaultLanguage
     *
     * @return array<int,array<string,string>>
     */
    private function getOrderedLanguages(mixed $languages, mixed $defaultLanguage): array
    {
        $options = [];

        foreach ($languages as $language)
        {
            $value = (string) data_get($language, 'value', '');

            if ($value === '')
            {
                continue;
            }

            $options[] = [
                'label' => (string) data_get($language, 'label', $value),
                'value' => $value,
            ];
        }

        usort($options, function (array $first, array $second) use ($defaultLanguage): int
        {
            if ($first['value'] === (string) $defaultLanguage)
            {
                return -1;
            }

            if ($second['value'] === (string) $defaultLanguage)
            {
                return 1;
            }

            return strnatcasecmp($first['label'], $second['label']);
        });

        return $options;
    }

    /**
     * @param array<int,array<string,string>> $languages
     * @param mixed $value
     *
     * @return string
     */
    private function getSelectedLanguage(array $languages, mixed $value): string
    {
        $selectedLanguage = (string) $value;

        if ($selectedLanguage !== '')
        {
            return $selectedLanguage;
        }

        return (string) ($languages[0]['value'] ?? '');
    }

    #endregion
}
