<?php

namespace App\Enums;

enum Role:int
{
    case FOUNDER = 1;
    case MODERATOR = 2;
    case CONTRIBUTOR = 3;
    case MEMBER = 4;
}
