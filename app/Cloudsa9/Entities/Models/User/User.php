<?php

namespace App\Cloudsa9\Entities\Models\User;

use App\Cloudsa9\Entities\Accessors\User\UserAccessor;
use App\Cloudsa9\Entities\Mutators\User\UserMutator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 * @package App\Cloudsa9\Entities\Models\User
 * @property mixed id
 * @property mixed first_name
 * @property mixed last_name
 * @property mixed full_name
 * @property mixed email
 * @property mixed phone
 * @property mixed account_type
 * @property mixed trial_end_date
 */
class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable, EntrustUserTrait, Billable, UserMutator, UserAccessor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'account_type',
        'status',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'trial_ends_at',
    ];

    /**
     * User belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the contact info associated with the user.
     */
    public function contactInfo()
    {
        return $this->hasOne(ContactInfo::class);
    }

    /**
     * Get the lockscreen associated with the user.
     */
    public function lockscreen()
    {
        return $this->hasOne(Lockscreen::class);
    }

    public function pets()
    {
        return $this->hasMany(UserPet::class);
    }
}
