<?php

namespace Przelewy24\Api\Responses\Transaction;

class TransactionRefundItem
{
    public function __construct()
    {
        //
    }

    public static function fromArray(array $data): self
    {
        return new self();
    }
}
