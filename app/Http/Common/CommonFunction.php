<?php

namespace App\Http\Common;

class CommonFunction
{
    /**
     * Developer can use this class through Not only the Laravel DI but also getInstance method
     *
     * @return CommonFunction
     */
    public static function getInstance(): CommonFunction
    {
        return new CommonFunction();
    }

    public function isStringType(mixed $data): bool
    {
        return gettype($data) === 'string';
    }

    public function isIntegerType(mixed $data): bool
    {
        return gettype($data) === 'integer';
    }

    public function changeFirstCharToUpperCase(string $value): string
    {
        $changedWord = '';

        if (strlen($value) > 0) {
            $firstCharacter = strtoupper(substr($value, 0, 1));
            $anotherCharacter = strtolower(substr($value, 1));
            $changedWord = $firstCharacter.$anotherCharacter;
        }

        return $changedWord;
    }
}
