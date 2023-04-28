<?php

namespace App\Http\Common\Converter\DigitToString;

use App\Http\Common\CommonFunction;
use RuntimeException;

/**
 * Help converting Number to String like '10' to 'Ten'
 * It can also convert negative string like '-10'
 *
 * In the PHP 32bit system, Maximum value is 2147483647 and Minimum value is -2147483647
 * please look at https://www.php.net/manual/en/language.types.integer.php
 * If over that number then PHP consider that number is a float(double)
 * So in this class only consider 32-bit integer number
 *
 * @author Insu Jo
 */
class DigitToStringConverter
{
    /**
     * Only accept 1 Hyphen(may, or may not) and 1-10 digit number
     */
    const REGEX_DIGIT_AND_NEGATIVE = '/^(-{0,1})(\d{1,10})$/';
    private digitToStringConvertStrategyInterface $digitToStringConvertStrategy;

    public function __construct(string $language)
    {
        /**
         * Depends on the Language, the convert ways are different
         */
        $this->digitToStringConvertStrategy = DigitToStringConvertStrategyFactory::getInstance($language)->getStrategy();
    }

    /**
     * Developer can use this class through Not only the Laravel DI but also getInstance method
     *
     * @param string $language
     * @return DigitToStringConverter
     */
    public static function getInstance(string $language): DigitToStringConverter
    {
        return new DigitToStringConverter($language);
    }

    public function convert(string|int $digit): string
    {
        $this->validate($digit);
        return $this->digitToStringConvertStrategy->convert($digit);
    }

    private function validate(int|string $digit): void
    {
        if ($this->isNotValidateDigit($digit)) {
            throw new RuntimeException('Number is invalid. Number has to be -2147483647 ~ 2147483647. Given number: '.$digit);
        }
    }

    private function isNotValidateDigit(int|string $digit): bool
    {
        $isValidate = false;

        if ($this->isIntegerType($digit) && $this->is32BitInteger($digit)) {
            $isValidate = true;
        } elseif ($this->isStringType($digit) && $this->isValidateString($digit)) {
            $isValidate = true;
        }

        return !$isValidate;
    }

    private function isIntegerType(int|string $digit): bool
    {
        return CommonFunction::getInstance()->isIntegerType($digit);
    }

    private function isStringType(int|string $digit): bool
    {
        return CommonFunction::getInstance()->isStringType($digit);
    }

    private function isValidateString(string $digit): bool
    {
        $isValidate = false;
        $noWhiteSpaceDigitString = str_replace(' ', '', $digit);

        if ($this->isPassRegExValidate($noWhiteSpaceDigitString) && $this->is32BitInteger(intval($noWhiteSpaceDigitString)))
            $isValidate = true;

        return $isValidate;
    }

    private function isPassRegExValidate(string $noWhiteSpaceDigitString): bool
    {
        return preg_match_all($this::REGEX_DIGIT_AND_NEGATIVE, $noWhiteSpaceDigitString);
    }

    private function is32BitInteger(int $digit): bool
    {
        return $digit >= -2147483647 && $digit <= 2147483647;
    }

}
