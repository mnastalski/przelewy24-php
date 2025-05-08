<?php

namespace Przelewy24\Tests\Constants;

use PHPUnit\Framework\TestCase;
use Przelewy24\Constants\IpAddresses;

class IpAddressesTest extends TestCase
{
    public function testIsValid(): void
    {
        $isValid = IpAddresses::isValid('5.252.202.255');

        $this->assertTrue($isValid);
    }

    public function testIsValidWithoutValidIp(): void
    {
        $isValid = IpAddresses::isValid('127.0.0.1');

        $this->assertFalse($isValid);
    }
}
