<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Enums\RichTextEditorEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Support\TranslationsBag;

#endregion

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property string $placeholder The value of the "placeholder" attribute.
 * @property array $modules The value of the "modules" attribute.
 */
class RichTextInputData extends InputData
{
       #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $placeholder The value of the "placeholder" attribute.
     * @param array $modules The value of the "modules" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $placeholder = '',
        array $modules = [],
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::PLACEHOLDER, $placeholder);
        $this->set(self::MODULES, $modules);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "modules" attribute.
     *
     * @var string
     */
    final public const MODULES = 'modules';

    /**
     * The name of the "placeholder" attribute.
     *
     * @var string
     */
    final public const PLACEHOLDER = 'placeholder';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'rich-text';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public static function getInputForm(?string $prefix = null): array
    {
        return [
            new FieldData(
                id: static::DEFAULT_VALUE,
                prefix: $prefix,
                input: new RichTextInputData(),
            ),
            new FieldData(
                id: static::PLACEHOLDER,
                prefix: $prefix,
                input: new TextInputData(),
            ),
            new FieldData(
                id: static::MODULES,
                prefix: $prefix,
                input: new CheckboxInputData(
                    options: RichTextEditorEnum::options(),
                ),
            ),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::rich-text-editor.align_center')
            ->add('narsil::rich-text-editor.align_justify')
            ->add('narsil::rich-text-editor.align_left')
            ->add('narsil::rich-text-editor.align_right')
            ->add('narsil::rich-text-editor.bold')
            ->add('narsil::rich-text-editor.bullet_list')
            ->add('narsil::rich-text-editor.heading_1')
            ->add('narsil::rich-text-editor.heading_2')
            ->add('narsil::rich-text-editor.heading_3')
            ->add('narsil::rich-text-editor.heading_4')
            ->add('narsil::rich-text-editor.heading_5')
            ->add('narsil::rich-text-editor.heading_6')
            ->add('narsil::rich-text-editor.headings')
            ->add('narsil::rich-text-editor.italic')
            ->add('narsil::rich-text-editor.ordered_list')
            ->add('narsil::rich-text-editor.redo')
            ->add('narsil::rich-text-editor.strike')
            ->add('narsil::rich-text-editor.subscript')
            ->add('narsil::rich-text-editor.superscript')
            ->add('narsil::rich-text-editor.underline')
            ->add('narsil::rich-text-editor.undo');
    }

    #endregion
}
