<?php

namespace App\Cloudsa9\Entities\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed device
 * @property mixed lockscreen_color
 * @property mixed lockscreen
 */
class Lockscreen extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'device',
        'lockscreen_color',
        'lockscreen',
    ];

    /**
     * Get the user that owns the lockscreen.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
