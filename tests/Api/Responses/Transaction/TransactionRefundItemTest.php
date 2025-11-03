<?php

declare(strict_types=1);

namespace Przelewy24\Tests\Api\Responses\Transaction;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Responses\Transaction\TransactionRefundItem;

class TransactionRefundItemTest extends TestCase
{
    public function testGetters(): void
    {
        $response = new TransactionRefundItem(
            orderId: 123456789,
            sessionId: '0beec7',
            amount: 2000,
            status: true,
            message: 'success',
            description: 'return',
        );

        $this->assertSame(123456789, $response->orderId());
        $this->assertSame('0beec7', $response->sessionId());
        $this->assertSame(2000, $response->amount());
        $this->assertTrue($response->status());
        $this->assertSame('success', $response->message());
        $this->assertSame('return', $response->description());
    }
}
