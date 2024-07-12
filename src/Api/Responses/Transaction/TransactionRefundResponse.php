<?php

namespace Przelewy24\Api\Responses\Transaction;

use Przelewy24\Api\Responses\AbstractResponse;

class TransactionRefundResponse extends AbstractResponse
{
    public function refunds(): array
    {
        return array_map(fn (array $data): TransactionRefundItem => new TransactionRefundItem(
            orderId: $data['orderId'],
            sessionId: $data['sessionId'],
            amount: $data['amount'],
            status: $data['status'],
            message: $data['message'],
            description: $data['description'],
        ), $this->parameters['data']);
    }
}
