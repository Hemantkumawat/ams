<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum StaffDesignation: int
{
    use BaseEnumTrait;

    case Principal = 1;
    case VicePrincipal = 2;
    case HeadMaster = 3;
    case Teacher = 4;
    case Clerk = 5;
    case Peon = 6;
    case Sweeper = 7;
    case Librarian = 8;
    case Accountant = 9;
    case LabAssistant = 10;
    case SecurityGuard = 11;
    case Other = 12;
}
