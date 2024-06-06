<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum AttendanceStatus: int
{
    use BaseEnumTrait;

    case Absent = 0;
    case Present = 1;
    case Late = 2;
    case Excused = 3;
    case EarlyDismissal = 4;
}
