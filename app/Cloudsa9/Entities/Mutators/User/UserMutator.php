<?php

namespace App\Cloudsa9\Entities\Mutators\User;

/**
 * Trait UserMutator
 * @package App\Cloudsa9\Entities\Mutators\User
 */
trait UserMutator
{
    /**
     * @param $value
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    /**
     * @param $value
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    /**
     * @param $value
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = str_replace(' ', '', $value);
    }
}
