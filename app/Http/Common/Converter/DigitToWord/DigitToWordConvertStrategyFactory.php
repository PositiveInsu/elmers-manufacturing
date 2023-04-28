<?php

namespace App\Http\Common\Converter\DigitToWord;

use App\Http\Enums\LanguageEnum;

class DigitToWordConvertStrategyFactory
{
    public static function getInstance(): DigitToWordConvertStrategyFactory
    {
        return new DigitToWordConvertStrategyFactory();
    }

    /**
     * If strategy is not exist by the given language, we use the English strategy by default
     *
     * @param string $language
     * @return DigitToWordConvertStrategyInterface
     */
    public function getStrategy(string $language): DigitToWordConvertStrategyInterface
    {
        return match(strtoupper($language)) {
            LanguageEnum::KOREAN->value => new DigitToWordKoreanConvertStrategy(),
            default => new DigitToWordEnglishConvertStrategy(),
        };
    }
}
