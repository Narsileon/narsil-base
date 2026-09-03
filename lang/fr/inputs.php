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
    ArrayInputData::TYPE    => 'Tableau',
    AssetInputData::TYPE    => 'Ressource',
    CheckboxInputData::TYPE => 'Case à cocher',
    ColorInputData::TYPE    => 'Couleur',
    DateInputData::TYPE     => 'Date',
    DatetimeInputData::TYPE => 'Date et heure',
    EmailInputData::TYPE    => 'E-mail',
    FileInputData::TYPE     => 'Fichier',
    IconInputData::TYPE     => 'Icône',
    NumberInputData::TYPE   => 'Nombre',
    PasswordInputData::TYPE => 'Mot de passe',
    RadioInputData::TYPE    => 'Bouton radio',
    RangeInputData::TYPE    => 'Plage',
    RichTextInputData::TYPE => 'Texte enrichi',
    SelectInputData::TYPE   => 'Liste déroulante',
    SwitchInputData::TYPE   => 'Interrupteur',
    TableInputData::TYPE    => 'Tableau',
    TextInputData::TYPE     => 'Texte',
    TextareaInputData::TYPE => 'Zone de texte',
    TimeInputData::TYPE     => 'Heure',
];
