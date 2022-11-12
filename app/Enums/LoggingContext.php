<?php

namespace App\Enums;

enum LoggingContext:string
{
    case APPLICATION = '[APP]';
    case AUTHENTICATION = '[AUTHENTICATION]';
}
