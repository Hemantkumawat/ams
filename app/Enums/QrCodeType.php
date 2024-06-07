<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum QrCodeType: int
{
    use BaseEnumTrait;

    case STUDENT_ATTENDANCE = 1;
    case STAFF_ATTENDANCE = 2;
    case STUDENT_REGISTRATION = 3;
    case STAFF_REGISTRATION = 4;
    case STUDENT_LOGIN = 5;
    case STAFF_LOGIN = 6;
    case STUDENT_LOGOUT = 7;
    case STAFF_LOGOUT = 8;
    case STUDENT_PROFILE = 9;
}
