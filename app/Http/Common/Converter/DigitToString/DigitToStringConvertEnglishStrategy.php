<?php

namespace App\Http\Common\Converter\DigitToString;

use Illuminate\Support\Facades\App;

class DigitToStringConvertEnglishStrategy extends AbstractDigitToStringConvertStrategy
{
    protected function setLocale(): void
    {
        App::setLocale('en');
    }

    public function convert(string $validatedDigitString): string
    {
        $negativeString = $this->getNegativeString($validatedDigitString);
        $numberString = $this->getNumberString($validatedDigitString);

        return $negativeString.$numberString;
    }

    private function getNegativeString(string $validatedDigitString): string
    {
        $negativeString = '';

        if (str_contains($validatedDigitString, '-')) {
            $negativeString = 'negative';
        }

        return $negativeString;
    }

    private function getNumberString(string $validatedDigitString): string
    {
        $digitStringWithoutNegative = str_replace('-', '', $validatedDigitString);
        $digitStringArray = str_split($digitStringWithoutNegative);
        return '';
    }
}
