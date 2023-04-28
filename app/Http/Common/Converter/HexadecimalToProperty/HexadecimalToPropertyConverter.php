<?php

namespace App\Http\Common\Converter\HexadecimalToProperty;

use App\Http\Enums\HexadecimalPropertyTargetEnum;
use RuntimeException;

/**
 * Help converting Hexadecimal string to Property Object
 * Changing the hexadecimal string to binary then checking the status
 * Returning the Property Object which store the status
 *
 * Here is the reference table; Defined bit to HexadecimalPropertyTargetEnum class
 *
 *  BITs | PROPERTY              | TYPE
 *
 *   1   | machine_one           | boolean
 *   2   | grinding_beans        | boolean
 *   3   | empty_grounds_fault   | boolean
 *   4   | water_empty_fault     | boolean
 * 5-12  | number_of_cups_today  | number
 *   15  | descale_required      | boolean
 * 14,16 | have_another_one_carl | boolean
 *
 * @author Insu Jo
 */
class HexadecimalToPropertyConverter
{
    /**
     * Only accept 2 Byte Integer(16 bits) Hexadecimal code
     * From 0 ~ FFFF
     */
    const REGEX_TWO_BYTE_HEXADECIMAL = '/^[0-9A-F]{0,4}$/';
    const BIT_COUNT = 16;
    /**
     * Developer can use this class through Not only the Laravel DI but also getInstance method
     *
     * @return HexadecimalToPropertyConverter
     */
    public static function getInstance(): HexadecimalToPropertyConverter
    {
        return new HexadecimalToPropertyConverter();
    }

    /**
     * Change the hexadecimal to property object Json string
     *
     * @param string $hexadecimal
     * @return HexadecimalConverterPropertyDTO
     */
    public function convert(string $hexadecimal): HexadecimalConverterPropertyDTO
    {
        $hexadecimalString = $this->cleanUpStyle($hexadecimal);
        $this->validate($hexadecimalString, $hexadecimal);
        $decimal = hexdec($hexadecimalString);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn($this->getValueFromDecimal($decimal, HexadecimalPropertyTargetEnum::MACHINE_ON));
        $propertyDTO->setGrindingBeans($this->getValueFromDecimal($decimal, HexadecimalPropertyTargetEnum::GRINDING_BEANS));
        $propertyDTO->setEmptyGroundsFault($this->getValueFromDecimal($decimal, HexadecimalPropertyTargetEnum::EMPTY_GROUNDS_FAULT));
        $propertyDTO->setWaterEmptyFault($this->getValueFromDecimal($decimal, HexadecimalPropertyTargetEnum::WATER_EMPTY_FAULT));
        $propertyDTO->setDescaleRequired($this->getValueFromDecimal($decimal, HexadecimalPropertyTargetEnum::DESCALE_REQUIRED));
        $propertyDTO->setNumberOfCupsToday($this->getNumberOfCupsFromDecimal($decimal));
        $propertyDTO->setHaveAnotherOneCarl($this->hasOneOfHaveAnotherOnCarlValue($decimal));

        return $propertyDTO;
    }

    private function validate(string $hexadecimalString, string $originalHexadecimal): void
    {
        if($this->isNotPassRegExValidate($hexadecimalString)){
            throw new RuntimeException( __('messages.invalid_hexadecimal', ['attribute' => $originalHexadecimal]));
        }
    }

    private function cleanUpStyle(string $hexadecimal): string
    {
        $noWhiteSpaceHexadecimalString = str_replace(' ', '', $hexadecimal);
        $upperCaseHexadecimalString = strtoupper($noWhiteSpaceHexadecimalString);
        return $this->remove0xCode($upperCaseHexadecimalString);
    }

    /**
     * Java environment use the '0x' string in order to notify the hexadecimal format
     * but PHP environment don't use the '0x', so if hexadecimal string has the '0x', it will be removed.
     *
     * @param string $hexadecimal
     * @return string
     */
    private function remove0xCode(string $hexadecimal): string
    {
        if (str_contains($hexadecimal, '0X')) {
            $hexadecimal = str_replace('0X', '', $hexadecimal);
        }

        return $hexadecimal;
    }

    private function isNotPassRegExValidate(string $hexadecimal): bool
    {
        return !preg_match_all($this::REGEX_TWO_BYTE_HEXADECIMAL, $hexadecimal);
    }

    /**
     * In PHP environment, bit code automatically cast the type to the decimal.
     * And the bit operation also calculated under the decimal format.
     * For example
     * 100(this is the decimal not bit code) & 100(this is the decimal not bit code)
     *
     * @param int $decimal
     * @param int $compare
     * @return bool
     */
    private function bitAndOperator(int $decimal, int $compare): bool
    {
        return ($decimal & $compare) === $compare;
    }

    /**
     * In order to check the target bit's value(0 or 1), this method use the bitwise And operation.
     * 1. Making the compare bit. For example, if you want to 3 bits, this method get the '100' bit code.
     * 2. Compare with decimal bit. which converted from Hexadecimal string
     *
     *
     * @param int $decimal
     * @param HexadecimalPropertyTargetEnum $hexadecimalPropertyTargetEnum
     * @return bool
     */
    private function getValueFromDecimal(int $decimal, HexadecimalPropertyTargetEnum $hexadecimalPropertyTargetEnum): bool
    {
        $compare = (1 << $hexadecimalPropertyTargetEnum->value - 1);
        return $this->bitAndOperator($decimal, $compare);
    }

    /**
     * Return the bit 5 ~ 12 bits' Decimal number.
     * 1. Delete the front bit 16 ~ 13. In order to delete the 4 bit add the 4 bit to the back.
     * 2. Get the required bit after delete the back bit (1 ~ 4 + newly added 4 bit)
     *
     * @param int $decimal
     * @return int
     */
    private function getNumberOfCupsFromDecimal(int $decimal): int
    {
        $frontDeleteCount = $this::BIT_COUNT - HexadecimalPropertyTargetEnum::NUMBER_OF_CUPS_TODAY_END->value;
        $requiredBitLength = ((HexadecimalPropertyTargetEnum::NUMBER_OF_CUPS_TODAY_START->value - 1) + $frontDeleteCount);
        $binaryCode = $this->get16DigitBinaryCode($decimal);
        return bindec(substr($binaryCode, $frontDeleteCount, $requiredBitLength));
    }

    /**
     * If one of the 14 or 15 bits has the true then return true
     *
     * @param int $decimal
     * @return bool
     */
    private function hasOneOfHaveAnotherOnCarlValue(int $decimal): bool
    {
        $conditionOne = $this->getValueFromDecimal($decimal, HexadecimalPropertyTargetEnum::HAVE_ANOTHER_ONE_CARL_CONDITION_1);
        $conditionTwo = $this->getValueFromDecimal($decimal, HexadecimalPropertyTargetEnum::HAVE_ANOTHER_ONE_CARL_CONDITION_2);

        return $conditionOne || $conditionTwo;
    }

    private function get16DigitBinaryCode(int $decimal): string
    {
        $binaryCode = decbin($decimal);
        $binaryCodeLength = strlen($binaryCode);
        $binaryRequiredLength = $this::BIT_COUNT;

        if ($binaryCodeLength < $binaryRequiredLength) {
           $difference = $binaryRequiredLength - $binaryCodeLength;

           while($difference > 0){
               $binaryCode = '0'.$binaryCode;
               $difference--;
           }
        }

        return $binaryCode;
    }
}
