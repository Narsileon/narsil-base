<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Support\TranslationsBag;
use Narsil\Cms\Http\Data\Forms\FieldData;

#endregionx

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property string $autoComplete The value of the "auto complete" attribute.
 * @property string|null $href The value of the "href" attribute.
 * @property integer|null $maxLength The value of the "max length" attribute.
 * @property integer $minLength The value of the "min length" attribute.
 */
class PasswordInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $autoComplete The value of the "auto complete" attribute.
     * @param string|null $href The value of the "href" attribute.
     * @param integer|null $maxLength The value of the "max length" attribute.
     * @param integer $minLength The value of the "min length" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $autoComplete = 'off',
        ?string $href = null,
        ?int $maxLength = null,
        int $minLength = 8,
    )
    {
        $this->set(self::AUTO_COMPLETE, $autoComplete);
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::HREF, $href);
        $this->set(self::MAX_LENGTH, $maxLength);
        $this->set(self::MIN_LENGTH, $minLength);

        parent::__construct(static::TYPE);
    }

    #endregion

     #region CONSTANTS

    /**
     * The name of the "auto complete" attribute.
     *
     * @var string
     */
    final public const AUTO_COMPLETE = 'autoComplete';

    /**
     * The name of the "href" attribute.
     *
     * @var string
     */
    final public const HREF = 'href';

    /**
     * The name of the "max length" attribute.
     *
     * @var string
     */
    final public const MAX_LENGTH = 'maxLength';

    /**
     * The name of the "min length" attribute.
     *
     * @var string
     */
    final public const MIN_LENGTH = 'minLength';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'password';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public static function getInputForm(?string $prefix = null): array
    {
        return [
            new FieldData(
                id: static::MIN_LENGTH,
                prefix: $prefix,
                input: new NumberInputData(),
            ),
            new FieldData(
                id: static::MAX_LENGTH,
                prefix: $prefix,
                input: new NumberInputData(),
            ),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::ui.forgot_password')
            ->add('narsil::ui.hide')
            ->add('narsil::ui.show');
    }

    #endregion
}
