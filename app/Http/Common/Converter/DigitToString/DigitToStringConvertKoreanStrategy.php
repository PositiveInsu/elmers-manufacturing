<?php

namespace App\Http\Common\Converter\DigitToString;

class DigitToStringConvertKoreanStrategy implements DigitToStringConvertStrategyInterface
{
    public function convert(int|string $validatedDigit): string
    {
        return 'Have to implement!';
    }
}
