<?php

namespace App\Cloudsa9\Entities\Models\User;

use Illuminate\Database\Eloquent\Model;

class OrderTag extends Model
{
    protected $table = 'order_tags';
    
    protected $fillable = [
        'user_id','pet_id','total_price','discount_code','address1','address2','city','state','zip_code','country_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
