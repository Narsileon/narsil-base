<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Http\Data\Forms\Inputs\ArrayInputData;
use Narsil\Base\Http\Data\Forms\Inputs\AssetInputData;
use Narsil\Base\Http\Data\Forms\Inputs\CheckboxInputData;
use Narsil\Base\Http\Data\Forms\Inputs\ColorInputData;
use Narsil\Base\Http\Data\Forms\Inputs\DateInputData;
use Narsil\Base\Http\Data\Forms\Inputs\DatetimeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\EmailInputData;
use Narsil\Base\Http\Data\Forms\Inputs\FileInputData;
use Narsil\Base\Http\Data\Forms\Inputs\IconInputData;
use Narsil\Base\Http\Data\Forms\Inputs\NumberInputData;
use Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData;
use Narsil\Base\Http\Data\Forms\Inputs\RadioInputData;
use Narsil\Base\Http\Data\Forms\Inputs\RangeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\RichTextInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SelectInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SwitchInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TableInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextareaInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TimeInputData;

#endregion

return [
    ArrayInputData::TYPE    => 'Array',
    AssetInputData::TYPE    => 'Asset',
    CheckboxInputData::TYPE => 'Checkbox',
    ColorInputData::TYPE    => 'Color',
    DateInputData::TYPE     => 'Date',
    DatetimeInputData::TYPE => 'Datetime',
    EmailInputData::TYPE    => 'Email',
    FileInputData::TYPE     => 'File',
    IconInputData::TYPE     => 'Icon',
    NumberInputData::TYPE   => 'Number',
    PasswordInputData::TYPE => 'Password',
    RadioInputData::TYPE    => 'Radio',
    RangeInputData::TYPE    => 'Range',
    RichTextInputData::TYPE => 'Rich Text',
    SelectInputData::TYPE   => 'Select',
    SwitchInputData::TYPE   => 'Switch',
    TableInputData::TYPE    => 'Table',
    TextInputData::TYPE     => 'Text',
    TextareaInputData::TYPE => 'Textarea',
    TimeInputData::TYPE     => 'Time',
];
