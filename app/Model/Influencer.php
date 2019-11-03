<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Influencer extends Model
{
    protected $table = 'influencers';
    protected $fillable = [
        "first_name", "last_name", "email", "birthday", "city", "street", 'zip_code',"facebook_url",'facebook_followers', "twitter_url",
        "twitter_followers", "instagram_url", "instagram_followers", "tiktok_url", "tiktok_followers", "website_url", "website_visitors",
        ];
}
