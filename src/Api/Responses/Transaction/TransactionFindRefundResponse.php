<?php

namespace Przelewy24\Api\Responses\Transaction;

use Przelewy24\Api\Responses\AbstractResponse;
use Przelewy24\Enums\Currency;

class TransactionFindRefundResponse extends AbstractResponse
{
    public function orderId(): int
    {
        return $this->parameters['data']['orderId'];
    }

    public function sessionId(): string
    {
        return $this->parameters['data']['sessionId'];
    }

    public function amount(): int
    {
        return $this->parameters['data']['amount'];
    }

    public function currency(): Currency
    {
        return Currency::from($this->parameters['data']['currency']);
    }

    public function refunds(): array
    {
        return array_map(fn (array $data): TransactionFindRefundItem => new TransactionFindRefundItem(
            batchId: $data['batchId'],
            requestId: $data['requestId'],
            date: $data['date'],
            login: $data['login'],
            description: $data['description'],
            status: $data['status'],
            amount: $data['amount'],
        ), $this->parameters['data']['refunds']);
    }
}
