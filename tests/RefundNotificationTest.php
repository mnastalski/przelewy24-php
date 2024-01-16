<?php

namespace Przelewy24\Tests;

use PHPUnit\Framework\TestCase;
use Przelewy24\Przelewy24;

class RefundNotificationTest extends TestCase
{
    private Przelewy24 $przelewy24;

    public function setUp(): void
    {
        $this->przelewy24 = new Przelewy24(
            123,
            'some-key',
            'c4816521bf32ed54',
            false,
        );
    }

    /**
     * @test
     * @dataProvider validNotifications
     */
    public function itChecksIfSignatureValid(array $request): void
    {
        $refundNotification = $this->przelewy24->handleRefundWebhook($request);
        $this->assertTrue($refundNotification->isSignatureValid());
    }

    public static function validNotifications(): array
    {
        return [
            [
                [
                    'orderId' => 4295430336,
                    'sessionId' => '1e715675-a42b-4d0b-81bb-f7288915be76',
                    'merchantId' => 235316,
                    'requestId' => 'dae85bdc-1b8e-45bc-99be-43c6868dcc29',
                    'refundsUuid' => '97920952-1d9b-4c90-9238-2b74ae0f48bb',
                    'amount' => 500,
                    'currency' => 'PLN',
                    'timestamp' => 1697544677,
                    'status' => 0,
                    'sign' => 'dad28db2e0336e595bc313e3c7282ab2ba2f265021f45b85271232901fefd4bc1329fd47aa4eb735ac818e2b82c4dc24',
                ],
            ],
        ];
    }
}
