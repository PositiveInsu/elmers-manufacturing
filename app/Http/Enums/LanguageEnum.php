<?php

namespace App\Http\Enums;

enum LanguageEnum: string
{
    case ENGLISH = 'EN';
    case KOREAN = 'KOR';

    /**
     * Return Enum list eg. [English => EN, KOREAN => KOR]
     *
     * @return array
     */
    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->name] = $case->value ?? $case->name;
        }
        return $array;
    }
}
