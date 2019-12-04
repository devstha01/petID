<?php

namespace App\Cloudsa9\Constants;

/**
 * Class LockScreenColor
 * @package App\Cloudsa9\Constants
 */
class LockScreenColor
{
    const BLACK = 'black';
    const WHITE = 'white';
    const IMAGE = 'image';

    /**
     * @return array
     */
    public static function all(): array
    {
        return [
            self::BLACK,
            self::WHITE,
            self::IMAGE
        ];
    }
}
