<?php

declare(strict_types=1);

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

        $this->assertSame(12345, $transaction->merchantId());
        $this->assertSame(123, $transaction->posId());
        $this->assertSame('0beec7', $transaction->sessionId());
        $this->assertSame(1500, $transaction->amount());
        $this->assertSame(1500, $transaction->originAmount());
        $this->assertSame(Currency::from('PLN'), $transaction->currency());
        $this->assertSame(123456789, $transaction->orderId());
        $this->assertSame(32, $transaction->methodId());
        $this->assertSame('p24-XXX-YYY-ZZZ', $transaction->statement());

        $this->assertTrue(
            $transaction->isSignValid('0beec7', 1500, 1500, 123456789, 32, 'p24-XXX-YYY-ZZZ')
        );
    }
}
