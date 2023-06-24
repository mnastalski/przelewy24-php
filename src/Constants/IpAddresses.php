<?php

namespace Przelewy24\Constants;

class IpAddresses
{
    public const V4 = [
        '5.252.202.254',
        '5.252.202.255',
        '91.216.191.181',
        '91.216.191.182',
        '91.216.191.183',
        '91.216.191.184',
        '91.216.191.185',
    ];

    public static function isValid(string $ip): bool
    {
        return in_array($ip, self::V4);
    }
}
