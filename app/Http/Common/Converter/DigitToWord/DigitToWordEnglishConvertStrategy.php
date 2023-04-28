<?php

namespace App\Http\Common\Converter\DigitToWord;

use App\Http\Common\CommonFunction;
use Illuminate\Support\Facades\App;

class DigitToWordEnglishConvertStrategy extends AbstractDigitToWordConvertStrategy
{
    private string $delimiter = ' ';
    /**
     * @var int[]
     */
    private array $numberUnits = [10, 100, 1000, 1000000, 1000000000];

    protected function setLocale(): void
    {
        App::setLocale('en');
    }

    public function convert(string $validatedDigitString): string
    {
        $negativeWord = $this->getNegativeWord($validatedDigitString);

        $onlyNumberString = $this->getRemovedNavigateString($validatedDigitString);

        $numberWord = $this->getNumberWord($onlyNumberString);

        $resultWord = $this->getCombinedWord($negativeWord, $numberWord);

        return $this->cleanUpStyleAfterConvert($resultWord);
    }

    private function getNegativeWord(string $validatedDigitString): string
    {
        $negativeString = '';

        if (str_contains($validatedDigitString, '-')) {
            $negativeString = 'negative';
        }

        return $negativeString;
    }

    private function getNumberWord(string $validatedDigitString): string
    {
        $digit = intval($validatedDigitString);
        $numberUnitArrayLength = count($this->numberUnits) - 1;
        return $this->changeNumberToWord($digit, $numberUnitArrayLength);
    }

    private function getRemovedNavigateString(string $validatedDigitString): string
    {
        if (str_contains($validatedDigitString, '-')) {
            $validatedDigitString = str_replace('-', '', $validatedDigitString);
        }

        return $validatedDigitString;
    }

    private function getCombinedWord(string $former, string $next): string
    {
        if ($this->hasBothFormerAndNextValue($former, $next) ) {
            $combinedString = $former.$this->delimiter.$next;
        } elseif ($this->hasOnlyFormerValue($former)) {
            $combinedString = $former;
        } else {
            $combinedString = $next;
        }

       return $combinedString;
    }

    /**
     * Recursive function for combining Number Word
     *
     * @param int $digit
     * @param int $index
     * @return string
     */
    private function changeNumberToWord(int $digit, int $index): string
    {
        $numberUnit = $this->numberUnits[$index];

        $quotient = intval($digit / $numberUnit); // quotient can be float like 1.1, but we only need the integer value
        $remainder = $digit % $numberUnit;

        if ($numberUnit === 10) {
            $resultString = $this->getTensPlaceString($digit, $quotient, $remainder);
        } else {
            $quotientString = $this->getQuotientString($quotient, $numberUnit);
            $remainderString = $this->changeNumberToWord($remainder, $index-1);
            $resultString = $this->getCombinedWord($quotientString, $remainderString);
        }


        return $resultString;
    }

    private function getQuotientString(int $quotient, int $numberUnit): string
    {
        $quotientString = '';

        if ($quotient > 0) {
            /**
             * Quotient can be over 20.
             */
            $quotientString = $this->changeNumberToWord($quotient, 1);
            /**
             * This method will return one of these; 'hundred', 'thousand', 'million', 'billion'
             */
            $numberUnitString = $this->getStringFromLabel($numberUnit);
            $quotientString = $this->getCombinedWord($quotientString, $numberUnitString);
        }

        return $quotientString;
    }

    private function getStringFromLabel(int $number): string
    {
        return __('digitword.'.$number);
    }

    private function getTensPlaceString(int $digit, int $quotient, int $remainder): string
    {
        if ($digit < 20) {
            /**
             * When under 20, the tens place digit is special.
             * For example
             * 'eleven', 'twelve' ...
             */
            $resultString = $this->getStringFromLabel($digit);
        } else {
            /**
             * When over 20, the tens place quotient digit is also special
             * For example
             * 'twenty', 'thirty', 'forty' ...
             */
            $quotientString = $this->getStringFromLabel($quotient.'0');
            $remainderString = $this->getStringFromLabel($remainder);
            $resultString = $this->getCombinedWord($quotientString, $remainderString);
        }

        return $resultString;
    }

    private function addAndWordToLastHundredPart(string $resultNumberWord): string
    {
        $index = strrpos($resultNumberWord, 'hundred', -1);

        if ($this->hasHundredWord($index)) {
            $resultNumberWord = substr_replace($resultNumberWord, 'hundred and', $index, 7);
        }

        return $resultNumberWord;
    }

    private function hasHundredWord(false|int $index): bool
    {
        $hasHundredWord = false;

        if (CommonFunction::getInstance()->isIntegerType($index)) {
            $hasHundredWord = true;
        }

        return $hasHundredWord;
    }

    private function cleanUpStyleAfterConvert(string $resultWord): string
    {
        $resultWord = $this->addAndWordToLastHundredPart($resultWord);
        return CommonFunction::getInstance()->changeFirstCharToUpperCase($resultWord);
    }

    private function hasBothFormerAndNextValue(string $former, string $next): bool
    {
        return strlen($former) >= 1 && strlen($next) >= 1;
    }

    private function hasOnlyFormerValue(string $former): bool
    {
        return strlen($former) >= 1;
    }
}
