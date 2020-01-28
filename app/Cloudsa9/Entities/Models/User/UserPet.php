<?php

namespace App\Cloudsa9\Entities\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserPet extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'pet_code',
        'qr_code',
        'gender',
        'color',
        'breed',
        'image1',
        'image2',
        'rabies_tag_id',
        'rabies_exp',
        'microship_id',
        'county_reg',
        'message',
        'status',
        'status_verified_at',
        'front_tag',
        'back_tag'
    ];

    /**
     * Get the user that owns the contact info.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
