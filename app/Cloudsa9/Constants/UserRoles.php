<?php

namespace App\Cloudsa9\Constants;

/**
 * Class UserRoles
 * @package App\Cloudsa9\Constants
 */
class UserRoles
{
    const ADMIN = 'admin';
    const CLIENT = 'client';

    /**
     * @return array
     */
    public static function all(): array
    {
        return [
            self::ADMIN,
            self::CLIENT
        ];
    }
}
