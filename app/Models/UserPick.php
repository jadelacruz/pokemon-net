<?php

namespace App\Models;

use App\Enums\UserPickTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPick extends AbstractModel
{
    use HasFactory, SoftDeletes, SoftDeletes;

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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * @param User $user
     * @param int $pokemonId
     * @param UserPickTypeEnum $pickType
     * @return UserPick
     */
    public static function createRecord(
        User $user,
        int $pokemonId,
        UserPickTypeEnum $pickType
    ): UserPick
    {
        return self::create([
            'user_id'    => $user->id,
            'pokemon_id' => $pokemonId,
            'pick_type'  => $pickType
        ]);
    }
}
