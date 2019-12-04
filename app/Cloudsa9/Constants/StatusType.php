<?php

namespace App\Cloudsa9\Constants;

/**
 * Class StatusType
 * @package App\Cloudsa9\Constants
 */
class StatusType
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const PENDING = 'pending';
    const BANNED = 'banned';

    /**
     * Status for User profile
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::PENDING,
            self::BANNED,
        ];
    }
}
