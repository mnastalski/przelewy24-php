<?php

namespace Przelewy24\Tests;

use PHPUnit\Framework\TestCase;
use Przelewy24\Przelewy24;

class CardNotificationTest extends TestCase
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
        $cardNotification = $this->przelewy24->handleCardWebhook($request);
        $this->assertTrue($cardNotification->isSignatureValid());
    }

    public static function validNotifications(): array
    {
        return [
            'with card country' => [
                [
                    'amount' => 500,
                    '3ds' => true,
                    'method' => 218,
                    'refId' => '06D6DB2A-403D6126-E40953C8-23E1F84E',
                    'orderId' => 4295430584,
                    'sessionId' => '40548a82-9437-4188-9aa9-f90502caeb9c',
                    'bin' => 907000,
                    'maskedCCNumber' => 'xxxxxxxxxxxx0008',
                    'ccExp' => '122025',
                    'hash' => 'a875b8280b7c1533fc24ba9ef1396ab3',
                    'cardCountry' => '',
                    'risk' => 0,
                    'liabilityshift' => true,
                    'cardType' => 'amex',
                    'sign' => 'cb52f749095d0837dc8948f2dd5f6d61b3ed1003eacd6c0e7b80f76d80384faca8e75dec33710a05f65b5245fecf5571',
                ],
            ],
            'without card country' => [
                [
                    'amount' => 500,
                    '3ds' => true,
                    'method' => 218,
                    'refId' => '8F478B50-53CCFC64-4139526A-85FF2556',
                    'orderId' => 4295430573,
                    'sessionId' => '323b42d1-67de-4f52-baf9-8b306673a797',
                    'bin' => 901000,
                    'maskedCCNumber' => 'xxxxxxxxxxxx0001',
                    'ccExp' => '122027',
                    'hash' => '018ddaacb2a5cdd99254176dbefb2f55',
                    'cardCountry' => 'CH',
                    'risk' => 0,
                    'liabilityshift' => true,
                    'cardType' => 'visa',
                    'sign' => 'd36112997f48fe511e369a09f1167d3b7fbc67adf9c9e759dad9e4884112fb19c53f0e5b6d5edc8319b098ba54733e17',
                ],
            ],
            'error' => [
                [
                    'amount' => 500,
                    '3ds' => false,
                    'method' => 218,
                    'orderId' => 4295430593,
                    'sessionId' => '31c8ec43-2d29-4900-b268-ff142619f251',
                    'errorCode' => 'err49',
                    'errorMessage' => 'Transaction rejected',
                    'sign' => '53da12dff49cfb394d460260a86ba224b89e7296b6c21f7425ddc3dae69b20cff3e27e220d3146c1a0e2391d48c0f960',
                ],
            ],
        ];
    }
}
