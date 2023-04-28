<?php

namespace App\Http\Common\Converter\DigitToString;

class DigitToStringConvertEnglishStrategy implements DigitToStringConvertStrategyInterface
{
    public function convert(int|string $validatedDigit): string
    {
        return 'zero';
    }
}
