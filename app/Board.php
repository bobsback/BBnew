<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Board
 *
 * @package App
 */
class Board extends Eloquent
{

    /**
     * @var array
     *
     */
    protected $fillable = [
        'boardname', 'boardblurb', 'pincode', 'admin'
    ];

    protected $hidden = ['pincode', 'admin', 'id'];

    /**
     * Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Moderators relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function moderators()
    {
        return $this->belongsToMany('App\Moderator');
    }

    /**
     * Bans relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bans()
    {
        return $this->hasMany('App\BoardBan');
    }
}
