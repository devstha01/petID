<?php

namespace App\Cloudsa9\Entities\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'user_logs';
    protected $fillable = [
//        "first_name", "last_name", "email",
        "user_id",
        "logs"
    ];

    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
