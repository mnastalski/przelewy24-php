<?php

namespace Przelewy24\Tests\Api\Responses\Transaction;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Responses\Transaction\TransactionFindRefundItem;
use Przelewy24\Enums\TransactionFindRefundStatus;

class TransactionFindRefundItemTest extends TestCase
{
    public function testGetters(): void
    {
        $response = new TransactionFindRefundItem(
            batchId: 999999999,
            requestId: 'ae0b12',
            date: '2024-07-17 08:25:43',
            login: 'login',
            description: 'return',
            status: 1,
            amount: 1500,
        );

        $this->assertSame(999999999, $response->batchId());
        $this->assertSame('ae0b12', $response->requestId());
        $this->assertSame('2024-07-17 08:25:43', $response->date());
        $this->assertSame('login', $response->login());
        $this->assertSame('return', $response->description());
        $this->assertSame(TransactionFindRefundStatus::COMPLETED, $response->status());
        $this->assertSame(1500, $response->amount());
    }
}
