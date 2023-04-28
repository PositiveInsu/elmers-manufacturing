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
}
