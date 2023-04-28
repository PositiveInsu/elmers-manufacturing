<?php

namespace App\Http\Common\Converter\DigitToString;

use Illuminate\Support\Facades\App;

class DigitToStringConvertKoreanStrategy extends AbstractDigitToStringConvertStrategy
{
    protected function setLocale(): void
    {
        App::setLocale('kor');
    }

    public function convert(string $validatedDigitString): string
    {
        return 'Have to implement!';
    }
}
