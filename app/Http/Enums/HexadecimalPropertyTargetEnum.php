<?php

namespace App\Http\Enums;

enum HexadecimalPropertyTargetEnum: int
{
    case MACHINE_ON = 1;
    case GRINDING_BEANS = 2;
    case EMPTY_GROUNDS_FAULT = 3;
    case WATER_EMPTY_FAULT = 4;
    case NUMBER_OF_CUPS_TODAY_START = 5;
    case NUMBER_OF_CUPS_TODAY_END = 12;
    case HAVE_ANOTHER_ONE_CARL_CONDITION_1 = 14;
    case DESCALE_REQUIRED = 15;
    case HAVE_ANOTHER_ONE_CARL_CONDITION_2 = 16;
}
