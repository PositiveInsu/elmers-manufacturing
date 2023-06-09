<?php

namespace App\Http\Common\Converter\DigitToWord;

interface DigitToWordConvertStrategyInterface
{
    /**
     * It always passed argument with validated 32bit digit string format in PHP
     * For example
     * '-2147483648' ~ '2147483647'
     *
     * Have to implement for converting digit string to word
     * For example
     * '0' return 'Zero'
     * '-1' return 'Negative one'
     * '13' return 'Thirteen'
     * '5237' return 'Five thousand two hundred and thirty seven
     *
     * @param string $validatedDigitString
     * @return string
     */
    public function convert(string $validatedDigitString): string;
}
