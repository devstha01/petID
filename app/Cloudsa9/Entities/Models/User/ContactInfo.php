<?php

namespace App\Cloudsa9\Entities\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed reward
 * @property mixed message
 */
class ContactInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone1',
        'phone2',
        'phone3',
        'phone4',
//        'address1',
//        'address2',
//        'city',
//        'state',
//        'zip',
        'reward',
        'message',
    ];

    /**
     * Get the user that owns the contact info.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
