<?php

namespace Przelewy24\Tests;

use PHPUnit\Framework\TestCase;
use Przelewy24\Config;

class ConfigTest extends TestCase
{
    public function testGetters(): void
    {
        $config = new Config(12345, 'foo', 'bar', true, 123);

        $this->assertEquals(12345, $config->merchantId());
        $this->assertEquals(123, $config->posId());
        $this->assertEquals('foo', $config->reportsKey());
        $this->assertEquals('bar', $config->crc());
        $this->assertTrue($config->isLiveMode());
    }

    public function testGetPosIdWhenPosIdNotSetReturnsMerchantId(): void
    {
        $config = new Config(12345, 'foo', 'bar');

        $this->assertEquals(12345, $config->merchantId());
        $this->assertEquals(12345, $config->posId());
    }
}
