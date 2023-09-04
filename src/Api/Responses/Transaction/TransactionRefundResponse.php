<?php

namespace Przelewy24\Api\Responses\Transaction;

use Przelewy24\Api\Responses\AbstractResponse;

class TransactionRefundResponse extends AbstractResponse
{
    public function refunds(): array
    {
        return array_map(
            fn (array $data) => TransactionRefundItem::fromArray($data),
            $this->parameters['data']
        );
    }
}
