<?php

namespace Przelewy24\Tests\Api\Responses\Transaction;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Responses\Transaction\TransactionRefundItem;
use Przelewy24\Api\Responses\Transaction\TransactionRefundResponse;

class TransactionRefundResponseTest extends TestCase
{
    public function testRefunds(): void
    {
        $response = new TransactionRefundResponse([
            'data' => [
                [
                    'orderId' => 123456789,
                    'sessionId' => '0beec7',
                    'amount' => 2000,
                    'description' => 'return',
                    'status' => true,
                    'message' => 'success',
                ],
                [
                    'orderId' => 111111111,
                    'sessionId' => '0beec7',
                    'amount' => 3550,
                    'description' => null,
                    'status' => true,
                    'message' => 'success',
                ],
            ],
            'responseCode' => 0,
        ]);

        $refunds = $response->refunds();

        $this->assertContainsOnlyInstancesOf(TransactionRefundItem::class, $refunds);

        $this->assertSame(123456789, $refunds[0]->orderId());
        $this->assertSame('0beec7', $refunds[0]->sessionId());
        $this->assertSame(2000, $refunds[0]->amount());
        $this->assertSame('return', $refunds[0]->description());
        $this->assertTrue($refunds[0]->status());
        $this->assertSame('success', $refunds[0]->message());

        $this->assertSame(111111111, $refunds[1]->orderId());
        $this->assertSame('0beec7', $refunds[1]->sessionId());
        $this->assertSame(3550, $refunds[1]->amount());
        $this->assertNull($refunds[1]->description());
        $this->assertTrue($refunds[1]->status());
        $this->assertSame('success', $refunds[1]->message());
    }
}
