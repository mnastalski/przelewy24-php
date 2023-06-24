<?php

namespace Przelewy24\Tests;

use PHPUnit\Framework\TestCase;
use Przelewy24\Config;
use Przelewy24\Enums\Currency;
use Przelewy24\TransactionStatusNotification;

class TransactionStatusNotificationTest extends TestCase
{
    public function testGetters(): void
    {
        $config = new Config(12345, 'foo', 'bar', false, 123);

        $transaction = new TransactionStatusNotification($config, [
            'merchantId' => 12345,
            'posId' => 123,
            'sessionId' => '0beec7',
            'amount' => 1500,
            'originAmount' => 1500,
            'currency' => 'PLN',
            'orderId' => 123456789,
            'methodId' => 32,
            'statement' => 'p24-XXX-YYY-ZZZ',
            'sign' => '703e946290d92230297c35d3bc8f554d4a458a4c97c9917665929c5ef5e682f7a868ac36e5dff20184c6a5302ef66c77',
        ]);

        $this->assertEquals(12345, $transaction->merchantId());
        $this->assertEquals(123, $transaction->posId());
        $this->assertEquals('0beec7', $transaction->sessionId());
        $this->assertEquals(1500, $transaction->amount());
        $this->assertEquals(1500, $transaction->originAmount());
        $this->assertEquals(Currency::from('PLN'), $transaction->currency());
        $this->assertEquals(123456789, $transaction->orderId());
        $this->assertEquals(32, $transaction->methodId());
        $this->assertEquals('p24-XXX-YYY-ZZZ', $transaction->statement());

        $this->assertTrue(
            $transaction->isSignValid('0beec7', 1500, 1500, '123456789', 32, 'p24-XXX-YYY-ZZZ')
        );
    }
}
