<?php

namespace App\Http\Common\Converter\DigitToString;

abstract class AbstractDigitToStringConvertStrategy implements DigitToStringConvertStrategyInterface
{
    public function __construct()
    {
        $this->setLocale();
    }

    /**
     * Have to set the locale for strategy depends on the language in the method
     * For example
     * App::setLocale('en');
     *
     * The argument has to be same as the lang folder name
     * For example
     * app/lang/en
     *
     * @return void
     */
    abstract protected function setLocale(): void;
    abstract public function convert(string $validatedDigitString): string;
}
