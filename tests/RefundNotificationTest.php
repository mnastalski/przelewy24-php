<?php

namespace Przelewy24\Tests;

use PHPUnit\Framework\TestCase;
use Przelewy24\Config;
use Przelewy24\Enums\Currency;
use Przelewy24\RefundNotification;

class RefundNotificationTest extends TestCase
{
    public function testGetters(): void
    {
        $config = new Config(12345, 'foo', 'bar', false, 123);

        $transaction = new RefundNotification($config, [
            'orderId' => 123456789,
            'sessionId' => '0beec7',
            'merchantId' => 12345,
            'requestId' => 'ac0efa',
            'refundsUuid' => 'dda251',
            'amount' => 1500,
            'currency' => 'PLN',
            'timestamp' => 1706389444,
            'status' => 0,
            'sign' => '689010bfd5819bcf683ee0556c0412808b760063a6a66ed4d305d9d85b0bb16ab38bc8fcd0808c85f977f5a041344688',
        ]);

        $this->assertEquals(123456789, $transaction->orderId());
        $this->assertEquals('0beec7', $transaction->sessionId());
        $this->assertEquals(12345, $transaction->merchantId());
        $this->assertEquals('ac0efa', $transaction->requestId());
        $this->assertEquals('dda251', $transaction->refundsUuid());
        $this->assertEquals(1500, $transaction->amount());
        $this->assertEquals(Currency::PLN, $transaction->currency());
        $this->assertEquals(1706389444, $transaction->timestamp());
        $this->assertEquals(0, $transaction->status());

        $isSignValid = $transaction->isSignValid(
            orderId: 123456789,
            sessionId: '0beec7',
            refundsId: 'dda251',
            amount: 1500,
            status: 0,
        );

        $this->assertTrue($isSignValid);
    }
}
