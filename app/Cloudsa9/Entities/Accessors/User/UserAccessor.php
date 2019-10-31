<?php

namespace App\Cloudsa9\Entities\Accessors\User;

use Carbon\Carbon;

/**
 * Trait UserAccessor
 * @package App\Cloudsa9\Entities\User\Accessors
 */
trait UserAccessor
{
    /**
     * Get full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get trial end date
     *
     * @return bool|mixed
     */
    public function getTrialEndDateAttribute()
    {
        if (currentUser()->onTrial('main')) {
            $date = currentUser()->subscription('main')->trial_ends_at;

            return Carbon::parse($date)->format('m/d/Y');
        }

        return false;
    }
}
