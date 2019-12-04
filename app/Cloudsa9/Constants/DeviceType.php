<?php

namespace App\Cloudsa9\Constants;

/**
 * Class DeviceType
 * @package App\Cloudsa9\Constants
 */
class DeviceType
{
    const PHONE = 'phone';
    const TABLET = 'tablet';

    /**
     * @return array
     */
    public static function all(): array
    {
        return [
            self::PHONE,
            self::TABLET
        ];
    }
}
