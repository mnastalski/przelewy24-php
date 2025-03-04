<?php

namespace Przelewy24\Tests\Api\Requests\Items;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Requests\Items\Psu;

class PsuTest extends TestCase
{
    public function testToArray(): void
    {
        $cartItem = new Psu(
            ip: '127.0.0.1',
            userAgent: 'Firefox',
        );

        $this->assertSame([
            'IP' => '127.0.0.1',
            'userAgent' => 'Firefox',
        ], $cartItem->toArray());
    }
}
