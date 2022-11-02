<?php

namespace App\Enums;

enum Role:int
{
    case FOUNDER = 1;
    case CO_FOUNDER = 2;
    case MODERATOR = 3;
    case MEMBER = 4;
}
