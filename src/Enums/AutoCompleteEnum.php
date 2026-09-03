<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum AutoCompleteEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case ADDITIONAL_NAME = 'additional-name';
    /**
     * @var string
     */
    case ADDRESS_LEVEL1 = 'address-level1';
    /**
     * @var string
     */
    case ADDRESS_LEVEL2 = 'address-level2';
    /**
     * @var string
     */
    case ADDRESS_LEVEL3 = 'address-level3';
    /**
     * @var string
     */
    case ADDRESS_LEVEL4 = 'address-level4';
    /**
     * @var string
     */
    case ADDRESS_LINE1 = 'address-line1';
    /**
     * @var string
     */
    case ADDRESS_LINE2 = 'address-line2';
    /**
     * @var string
     */
    case ADDRESS_LINE3 = 'address-line3';
    /**
     * @var string
     */
    case BDAY = 'bday';
    /**
     * @var string
     */
    case BDAY_DAY = 'bday-day';
    /**
     * @var string
     */
    case BDAY_MONTH = 'bday-month';
    /**
     * @var string
     */
    case BDAY_YEAR = 'bday-year';
    /**
     * @var string
     */
    case CC_ADDITIONAL_NAME = 'cc-additional-name';
    /**
     * @var string
     */
    case CC_CSC = 'cc-csc';
    /**
     * @var string
     */
    case CC_EXP = 'cc-exp';
    /**
     * @var string
     */
    case CC_EXP_MONTH = 'cc-exp-month';
    /**
     * @var string
     */
    case CC_EXP_YEAR = 'cc-exp-year';
    /**
     * @var string
     */
    case CC_FAMILY_NAME = 'cc-family-name';
    /**
     * @var string
     */
    case CC_GIVEN_NAME = 'cc-given-name';
    /**
     * @var string
     */
    case CC_NAME = 'cc-name';
    /**
     * @var string
     */
    case CC_NUMBER = 'cc-number';
    /**
     * @var string
     */
    case CC_TYPE = 'cc-type';
    /**
     * @var string
     */
    case COUNTRY = 'country';
    /**
     * @var string
     */
    case COUNTRY_NAME = 'country-name';
    /**
     * @var string
     */
    case CURRENT_PASSWORD = 'current-password';
    /**
     * @var string
     */
    case EMAIL = 'email';
    /**
     * @var string
     */
    case FAMILY_NAME = 'family-name';
    /**
     * @var string
     */
    case FAX = 'fax';
    /**
     * @var string
     */
    case GIVEN_NAME = 'given-name';
    /**
     * @var string
     */
    case HOME = 'home';
    /**
     * @var string
     */
    case HONORIFIC_PREFIX = 'honorific-prefix';
    /**
     * @var string
     */
    case HONORIFIC_SUFFIX = 'honorific-suffix';
    /**
     * @var string
     */
    case IMPP = 'impp';
    /**
     * @var string
     */
    case MOBILE = 'mobile';
    /**
     * @var string
     */
    case NAME = 'name';
    /**
     * @var string
     */
    case NEW_PASSWORD = 'new-password';
    /**
     * @var string
     */
    case NICKNAME = 'nickname';
    /**
     * @var string
     */
    case OFF = 'off';
    /**
     * @var string
     */
    case ON = 'on';
    /**
     * @var string
     */
    case ONE_TIME_CODE = 'one-time-code';
    /**
     * @var string
     */
    case ORGANIZATION = 'organization';
    /**
     * @var string
     */
    case ORGANIZATION_TITLE = 'organization-title';
    /**
     * @var string
     */
    case PAGE = 'page';
    /**
     * @var string
     */
    case PHOTO = 'photo';
    /**
     * @var string
     */
    case POSTAL_CODE = 'postal-code';
    /**
     * @var string
     */
    case SEX = 'sex';
    /**
     * @var string
     */
    case STREET_ADDRESS = 'street-address';
    /**
     * @var string
     */
    case TEL = 'tel';
    /**
     * @var string
     */
    case TEL_AREA_CODE = 'tel-area-code';
    /**
     * @var string
     */
    case TEL_COUNTRY_CODE = 'tel-country-code';
    /**
     * @var string
     */
    case TEL_EXTENSION = 'tel-extension';
    /**
     * @var string
     */
    case TEL_LOCAL = 'tel-local';
    /**
     * @var string
     */
    case TEL_LOCAL_PREFIX = 'tel-local-prefix';
    /**
     * @var string
     */
    case TEL_LOCAL_SUFFIX = 'tel-local-suffix';
    /**
     * @var string
     */
    case TEL_NATIONAL = 'tel-national';
    /**
     * @var string
     */
    case TRANSACTION_AMOUNT = 'transaction-amount';
    /**
     * @var string
     */
    case TRANSACTION_CURRENCY = 'transaction-currency';
    /**
     * @var string
     */
    case URL = 'url';
    /**
     * @var string
     */
    case USERNAME = 'username';
    /**
     * @var string
     */
    case WORK = 'work';

    #endregion
}
