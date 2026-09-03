<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Traits\Enumerable;

#endregion

enum RichTextEditorEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case ALIGN_CENTER = 'align_center';
    /**
     * @var string
     */
    case ALIGN_LEFT = 'align_left';
    /**
     * @var string
     */
    case ALIGN_RIGHT = 'align_right';
    /**
     * @var string
     */
    case BOLD = 'bold';
    /**
     * @var string
     */
    case BULLET_LIST = 'bullet_list';
    /**
     * @var string
     */
    case HEADING_1 = 'heading_1';
    /**
     * @var string
     */
    case HEADING_2 = 'heading_2';
    /**
     * @var string
     */
    case HEADING_3 = 'heading_3';
    /**
     * @var string
     */
    case HEADING_4 = 'heading_4';
    /**
     * @var string
     */
    case HEADING_5 = 'heading_5';
    /**
     * @var string
     */
    case HEADING_6 = 'heading_6';
    /**
     * @var string
     */
    case ITALIC = 'italic';
    /**
     * @var string
     */
    case JUSTIFY = 'justify';
    /**
     * @var string
     */
    case LINK = 'link';
    /**
     * @var string
     */
    case ORDERED_LIST = 'ordered_list';
    /**
     * @var string
     */
    case PARAGRAPH = 'paragraph';
    /**
     * @var string
     */
    case REDO = 'redo';
    /**
     * @var string
     */
    case STRIKE = 'strike';
    /**
     * @var string
     */
    case SUBSCRIPT = 'subscript';
    /**
     * @var string
     */
    case SUPERSCRIPT = 'superscript';
    /**
     * @var string
     */
    case UNDERLINE = 'underline';
    /**
     * @var string
     */
    case UNDO = 'undo';

    #endregion

    #region PUBLIC METHODS

    /**
     * Get the enum as options.
     *
     * @return OptionData[]
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case)
        {
            $options[] = new OptionData(
                label: trans("narsil::rich-text-editor.$case->value"),
                value: $case->value
            );
        }

        return $options;
    }

    #endregion
}
