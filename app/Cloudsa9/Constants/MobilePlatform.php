<?php

namespace App\Cloudsa9\Constants;

/**
 * Class MobilePlatform
 * @package App\Cloudsa9\Constants
 */
class MobilePlatform
{
    const ANDROID = 'Android';
    const IPHONE = 'iPhone';

    /**
     * @return array
     */
    public static function all(): array
    {
        return [
            self::ANDROID,
            self::IPHONE
        ];
    }
}
