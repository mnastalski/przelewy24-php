<?php

declare(strict_types=1);

namespace Przelewy24\Tests\Api\Responses\Transaction;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Responses\Transaction\FindTransactionResponse;
use Przelewy24\Enums\Currency;

class FindTransactionResponseTest extends TestCase
{
    public function testGetters(): void
    {
        $response = new FindTransactionResponse([
            'data' => [
                'orderId' => 123456789,
                'sessionId' => '0beec7',
                'status' => 1,
                'amount' => 1500,
                'currency' => 'PLN',
                'date' => '202212020025',
                'dateOfTransaction' => '202212020020',
                'clientEmail' => '',
                'accountMD5' => '',
                'paymentMethod' => 555,
                'description' => 'Transaction',
                'clientName' => '',
                'clientAddress' => '',
                'clientCity' => '',
                'clientPostcode' => '',
                'batchId' => 0,
                'fee' => '56',
                'statement' => 'P24-XXX-YYY-ZZZ',
            ],
            'responseCode' => 0,
        ]);

        $this->assertSame(123456789, $response->orderId());
        $this->assertSame('0beec7', $response->sessionId());
        $this->assertSame(1, $response->status());
        $this->assertSame(1500, $response->amount());
        $this->assertSame(Currency::PLN, $response->currency());
        $this->assertSame('202212020025', $response->date());
        $this->assertSame('202212020020', $response->dateOfTransaction());
        $this->assertSame('', $response->clientEmail());
        $this->assertSame('', $response->accountMD5());
        $this->assertSame(555, $response->paymentMethod());
        $this->assertSame('Transaction', $response->description());
        $this->assertSame('', $response->clientName());
        $this->assertSame('', $response->clientAddress());
        $this->assertSame('', $response->clientCity());
        $this->assertSame('', $response->clientPostcode());
        $this->assertSame(0, $response->batchId());
        $this->assertSame('56', $response->fee());
        $this->assertSame('P24-XXX-YYY-ZZZ', $response->statement());
    }
}
