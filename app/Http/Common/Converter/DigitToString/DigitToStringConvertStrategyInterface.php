<?php

namespace App\Http\Common\Converter\DigitToString;

interface DigitToStringConvertStrategyInterface
{
    /**
     * It always passed argument with validated 32bit digit format in PHP
     * For example
     * -2147483647 ~ 2147483647
     *
     * Have to implement for converting number to string
     * For example
     * 0 return 'Zero'
     * -1 return 'Negative one'
     * 13 return 'Thirteen'
     * 5237 return 'Five thousand two hundred and thirty seven
     *
     * @param int|string $validatedDigit
     * @return string
     */
    public function convert(int|string $validatedDigit): string;
}
