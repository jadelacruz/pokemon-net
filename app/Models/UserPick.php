<?php

namespace App\Models;

use App\Enums\UserPickTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPick extends AbstractModel
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'pokemon_id',
        'pick_type'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'pick_type' => UserPickTypeEnum::class
    ];
}
