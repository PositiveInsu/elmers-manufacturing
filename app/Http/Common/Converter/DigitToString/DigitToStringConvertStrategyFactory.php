<?php

namespace App\Http\Common\Converter\DigitToString;

use App\Http\Enums\LanguageEnum;

class DigitToStringConvertStrategyFactory
{
    private DigitToStringConvertStrategyInterface $digitToStringConvertStrategy;
    private function __construct(string $language)
    {
        /**
         * If strategy is not exist by the given language, we use the English strategy by default
         */
        $this->digitToStringConvertStrategy = match(strtoupper($language)) {
            LanguageEnum::KOREAN->value => new DigitToStringConvertKoreanStrategy(),
            default => new DigitToStringConvertEnglishStrategy(),
        };
    }

    /**
     * Developer can only use this class through getInstance method
     *
     * @param string $language
     * @return DigitToStringConvertStrategyFactory
     */
    public static function getInstance(string $language): DigitToStringConvertStrategyFactory
    {
        return new DigitToStringConvertStrategyFactory($language);
    }

    public function getStrategy(): DigitToStringConvertStrategyInterface
    {
        return $this->digitToStringConvertStrategy;
    }
}
