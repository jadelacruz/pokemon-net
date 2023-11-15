<?php

namespace App\Enums;

enum UserPickTypeEnum: string
{
    case FAVORITE = 'favorite';
    case LIKE     = 'like';
    case DISLIKE  = 'dislike';
}
