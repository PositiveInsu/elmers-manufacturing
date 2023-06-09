<?php

namespace App\Http\Common\Converter\DigitToWord;

use App\Http\Common\CommonFunction;
use App\Http\Enums\LanguageEnum;
use RuntimeException;

/**
 * Help converting Number to Word like '10' to 'Ten'
 * It can also convert negative word like '-10' to 'Negative ten'
 *
 * In the PHP 32bit system, Maximum value is 2147483647 and Minimum value is -2147483648
 * please look at https://www.php.net/manual/en/reserved.constants.php#:~:text=PHP_INT_MAX
 * If over that number then PHP consider that number is a float(double)
 * So in this class only consider 32-bit integer number
 *
 * @author Insu Jo
 */
class DigitToWordConverter
{
    /**
     * Only accept 1 Hyphen(may, or may not) and 1-10 digit number string
     */
    const REGEX_DIGIT_AND_NEGATIVE = '/^(-{0,1})(\d{1,10})$/';
    private DigitToWordConvertStrategyInterface $digitToWordConvertStrategy;

    /**
     * In the constructor, setting the converting strategy by language
     * because depends on the Language, the convert strategies are different
     *
     * Default language is English
     * You can see the support language at the LanguageEnum class
     *
     * @param string $language
     */
    public function __construct(string $language = LanguageEnum::ENGLISH->value)
    {
        $this->digitToWordConvertStrategy = DigitToWordConvertStrategyFactory::getInstance()->getStrategy($language);
    }

    /**
     * Developer can use this class through Not only the Laravel DI but also getInstance method
     *
     * Default language is English
     * You can see the support language at the LanguageEnum class
     *
     * @param string $language
     * @return DigitToWordConverter
     */
    public static function getInstance(string $language = LanguageEnum::ENGLISH->value): DigitToWordConverter
    {
        return new DigitToWordConverter($language);
    }

    /**
     * Change the number to word depends on the language
     *
     * @param string|int $digit
     * @return string
     */
    public function convert(string|int $digit): string
    {
        $digit = $this->cleanUpDigitString($digit);

        $this->validate($digit);

        return $this->digitToWordConvertStrategy->convert(strval($digit));
    }

    private function cleanUpDigitString(int|string $digit): int|string
    {
        if ($this->isStringType($digit)) {
            $digit = str_replace(' ', '', $digit);
            $digit = $digit === '-0' ? '0' : $digit;
        }

        return $digit;
    }

    private function validate(int|string $digit): void
    {
        if ($this->isNotValidateDigit($digit)) {
            throw new RuntimeException(__('messages.invalid_32bit_integer', ['attribute' => $digit]));
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

        if ($this->isPassRegExValidate($digit) && $this->is32BitInteger(intval($digit))) {
            $isValidate = true;
        }

        return $isValidate;
    }

    private function isPassRegExValidate(string $noWhiteSpaceDigitString): bool
    {
        return preg_match_all($this::REGEX_DIGIT_AND_NEGATIVE, $noWhiteSpaceDigitString);
    }

    private function is32BitInteger(int $digit): bool
    {
        return $digit >= -2147483648 && $digit <= 2147483647;
    }
}
