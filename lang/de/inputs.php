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
    CheckboxInputData::TYPE => 'Kontrollkästchen',
    ColorInputData::TYPE    => 'Farbe',
    DateInputData::TYPE     => 'Datum',
    DatetimeInputData::TYPE => 'Datum & Uhrzeit',
    EmailInputData::TYPE    => 'E-Mail',
    FileInputData::TYPE     => 'Datei',
    IconInputData::TYPE     => 'Icon',
    NumberInputData::TYPE   => 'Zahl',
    PasswordInputData::TYPE => 'Passwort',
    RadioInputData::TYPE    => 'Optionsfeld',
    RangeInputData::TYPE    => 'Bereich',
    RichTextInputData::TYPE => 'Rich-Text',
    SelectInputData::TYPE   => 'Auswahlliste',
    SwitchInputData::TYPE   => 'Schalter',
    TableInputData::TYPE    => 'Tabelle',
    TextInputData::TYPE     => 'Text',
    TextareaInputData::TYPE => 'Textbereich',
    TimeInputData::TYPE     => 'Uhrzeit',
];
