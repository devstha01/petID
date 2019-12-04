<?php

namespace App\Cloudsa9\Entities\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserPet extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'color',
        'breed',
        'image1',
        'image2',
        'message',
        'status',
        'status_verified_at'
    ];

    /**
     * Get the user that owns the contact info.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
