<?php

namespace Przelewy24\Constants;

class IpAddresses
{
    public const V4 = [
        '5.252.202.254',
        '5.252.202.255',
        '20.215.81.124',
    ];

    public static function isValid(string $ip): bool
    {
        return in_array($ip, self::V4);
    }
}
