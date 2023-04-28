<?php

namespace App\Http\Common\Converter\DigitToWord;

use Illuminate\Support\Facades\App;

class DigitToWordKoreanConvertStrategy extends AbstractDigitToWordConvertStrategy
{
    protected function setLocale(): void
    {
        App::setLocale('kor');
    }

    public function convert(string $validatedDigitString): string
    {
        $result = 'Have to implement!';

        if ($validatedDigitString === '0') {
            $result = __('digitword.'.$validatedDigitString);
        }
        return $result;
    }
}
