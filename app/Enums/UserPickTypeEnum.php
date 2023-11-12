<?php

namespace App\Enums;

enum UserPickTypeEnum: string
{
    case FAVORITE = 'favorite';
    case DISLIKE  = 'dislike';
}
