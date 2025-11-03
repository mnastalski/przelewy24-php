<?php

declare(strict_types=1);

namespace Przelewy24\Tests\Api\Requests\Items;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Requests\Items\RefundItem;

class RefundItemTest extends TestCase
{
    public function testToArray(): void
    {
        $cartItem = new RefundItem(
            orderId: 123456789,
            sessionId: '0beec7',
            amount: 1500,
            description: 'Description',
        );

        $this->assertSame([
            'orderId' => 123456789,
            'sessionId' => '0beec7',
            'amount' => 1500,
            'description' => 'Description',
        ], $cartItem->toArray());
    }
}
