<?php

namespace App\Cloudsa9\Constants;

/**
 * Class AccountType
 * @package App\Cloudsa9\Constants
 */
class AccountType
{
    const FREE = 'free';
    const PAID = 'paid';

    /**
     * @return array
     */
    public static function all(): array
    {
        return [
            self::FREE,
            self::PAID
        ];
    }
}
