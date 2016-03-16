<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
     * Moderator relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function moderator()
    {
        return $this->hasOne('App\Moderator');
    }

    /**
     * Return the user attributes.

     * @return array
     */
    public function getAuthor()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'url' => $this->url,
            'avatar' => 'gravatar',
            'admin' => $this->role === 'admin'
        ];
    }

    /**
     * Is moderator.
     *
     * @param $boardId
     *
     * @return bool
     */
    public function isModerator($boardId)
    {
        if (!$this->moderator || !$this->moderator->boards()->find($boardId)) {
            return false;
        }

        return true;
    }




}
