<?php

namespace Przelewy24\Tests\Api\Responses\Transaction;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Responses\Transaction\RegisterTransactionResponse;

class RegisterTransactionResponseTest extends TestCase
{
    public function testToken(): void
    {
        $response = new RegisterTransactionResponse([
            'data' => [
                'token' => 'foo',
            ],
            'responseCode' => 0,
        ]);

        $this->assertSame('foo', $response->token());
    }

    public function testSetGatewayUrl(): void
    {
        $response = new RegisterTransactionResponse([
            'data' => [
                'token' => 'foo',
            ],
            'responseCode' => 0,
        ]);

        $response->setGatewayBaseUri('https://example.test/');

        $this->assertSame('https://example.test/trnRequest/foo', $response->gatewayUrl());
    }
}
