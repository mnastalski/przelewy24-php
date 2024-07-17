<?php

namespace Przelewy24\Tests\Api\Responses\Transaction;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Responses\Transaction\TransactionFindRefundItem;
use Przelewy24\Api\Responses\Transaction\TransactionFindRefundResponse;
use Przelewy24\Enums\Currency;
use Przelewy24\Enums\TransactionFindRefundStatus;

class TransactionFindRefundResponseTest extends TestCase
{
    public function testGetters(): void
    {
        $response = new TransactionFindRefundResponse([
            'data' => [
                'orderId' => 123456789,
                'sessionId' => '0beec7',
                'amount' => 1500,
                'currency' => 'PLN',
                'refunds' => [
                    [
                        'batchId' => 999999999,
                        'requestId' => 'ae0b12',
                        'date' => '2024-07-17 08:25:43',
                        'login' => 'login',
                        'description' => 'return',
                        'status' => 1,
                        'amount' => 1500,
                    ],
                ],
            ],
            'responseCode' => 0,
        ]);

        $this->assertSame(123456789, $response->orderId());
        $this->assertSame('0beec7', $response->sessionId());
        $this->assertSame(1500, $response->amount());
        $this->assertSame(Currency::PLN, $response->currency());

        $refunds = $response->refunds();

        $this->assertIsArray($refunds);
        $this->assertCount(1, $refunds);
        $this->assertInstanceOf(TransactionFindRefundItem::class, $refunds[0]);
        $this->assertSame(999999999, $refunds[0]->batchId());
        $this->assertSame('ae0b12', $refunds[0]->requestId());
        $this->assertSame('2024-07-17 08:25:43', $refunds[0]->date());
        $this->assertSame('login', $refunds[0]->login());
        $this->assertSame('return', $refunds[0]->description());
        $this->assertSame(TransactionFindRefundStatus::COMPLETED, $refunds[0]->status());
        $this->assertSame(1500, $refunds[0]->amount());
    }
}
