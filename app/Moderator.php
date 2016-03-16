<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Moderator
 *
 * @package App
 */
class Moderator extends Eloquent
{

    /**
     * @var array
     *
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Boards relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function boards()
    {
        return $this->belongsToMany('App\Board');
    }

    /**
     * Find by user id or create.
     *
     * @param $userId
     *
     * @return static
     */
    public static function findByUserIdOrCreate($userId)
    {
        if (!($moderator = static::where('user_id', '=', $userId)->first())) {
            $moderator = new static;
            $moderator->user_id = $userId;
            $moderator->save();
        }

        return $moderator;
    }
}
