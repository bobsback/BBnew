<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class BoardBan
 *
 * @package App
 */
class BoardBan extends Eloquent
{

    /**
     * @var array
     *
     */
    protected $fillable = [
        'board_id', 'ip_address'
    ];

    /**
     * Board relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function board()
    {
        return $this->belongsTo('App\Board');
    }
}
